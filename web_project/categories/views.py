from django.shortcuts import render
from .models import Category,Subscriber
from blogs import models as m
from django.http import Http404
from django.views import generic
from django.contrib.auth.mixins import LoginRequiredMixin
from django.contrib.auth.decorators import login_required
from django.utils.text import slugify
from django.urls import reverse_lazy
from django.http import HttpResponseRedirect

# Create your views here.
class Categoryblogs(LoginRequiredMixin, generic.ListView):

    model=m.Blog
    template_name="categories/category_blogs.html"

    def get_queryset(self):
        try:
            self.blog_category = Category.objects.prefetch_related("cat_blogs").get(
                name__iexact=self.kwargs.get("name")
            )
            name=slugify(self.kwargs.get("name"))
            category = Category.objects.get(slug=name)
            subscribed = Subscriber.objects.raw("SELECT id From categories_subscriber where member_id=%s and category_id=%s",[self.request.user.id,category.id])
            # for s in subscribed:
            #     self.subscribed=s
            if len(subscribed) == 1:
                self.is_subscribed = subscribed[0]
            else:
                self.is_subscribed = None
            self.trending = self.blog_category.cat_blogs.order_by("points")
        except Category.DoesNotExist:
            raise Http404
        else:
            return self.blog_category.cat_blogs.all()

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["cat"] = self.blog_category
        context["is_subscribed"] = self.is_subscribed
        context["trending"] = self.trending
        return context

@login_required
def Subscribe(request,name):

    subbed=Subscriber()
    subbed.member=request.user
    cat_name=slugify(name)
    subbed.category=Category.objects.get(slug=cat_name)
    subbed.save()

    return HttpResponseRedirect(reverse_lazy("categories:category_blogs",kwargs={"name":cat_name}))

@login_required
def Unsubscribe(request,name):

    cat_name=slugify(name)
    category=Category.objects.get(slug=cat_name)
    subbed=Subscriber.objects.get(member=request.user,category=category)
    subbed.delete()

    return HttpResponseRedirect(reverse_lazy("categories:category_blogs",kwargs={"name":cat_name}))
