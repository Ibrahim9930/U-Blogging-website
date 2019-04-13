from django.shortcuts import render
from .models import Category
from blogs import models as m
from django.views import generic

# Create your views here.
class Categoryblogs(generic.ListView):

    model=m.Blog
    template_name="categories/category_blogs.html"

    def get_queryset(self):
        try:
            self.blog_category = Category.objects.prefetch_related("cat_blogs").get(
                name__iexact=self.kwargs.get("name")
            )
        except Category.DoesNotExist:
            raise Http404
        else:
            return self.blog_category.cat_blogs.all()

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["cat"] = self.blog_category
        return context
