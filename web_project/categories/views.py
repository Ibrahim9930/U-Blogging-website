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

            yayed_blogs = self.request.user.yays.all()
            self.y_blogs=[]
            for yay in yayed_blogs:
                print(yay.yayed.id)
                self.y_blogs.append(yay.yayed.id)
            print("stage 1")
            nayed_blogs = self.request.user.nays.all()
            self.n_blogs=[]
            for nay in nayed_blogs:
                self.n_blogs.append(nay.nayed.id)

        except Category.DoesNotExist:
            raise Http404
        else:
            return self.blog_category.cat_blogs.all()

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        try:
            subscribed = Subscriber.objects.raw("SELECT id,category_id from categories_subscriber where member_id = %s",[self.request.user.id])
            subbed_categories=[]
            for sub in subscribed:
                subbed_categories.append(sub.category_id)
                print(sub.id)
            self.subbed_cats = Category.objects.filter(id__in=subbed_categories)
            print(self.subbed_cats)
            context["subbed_cats"]=self.subbed_cats
        except:
            pass
        context["cat"] = self.blog_category
        context["is_subscribed"] = self.is_subscribed
        context["trending"] = self.trending
        context["yayed_blogs"] = self.y_blogs
        context["nayed_blogs"] = self.n_blogs
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
