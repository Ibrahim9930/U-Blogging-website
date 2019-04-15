from django.contrib import messages
from django.contrib.auth.mixins import LoginRequiredMixin
from django.urls import reverse_lazy
from django.http import Http404
from django.views import generic

from braces.views import SelectRelatedMixin

from . import forms
from . import models

from django.contrib.auth import get_user_model
User = get_user_model()

# Create your views here.

class CreateBlog(LoginRequiredMixin, SelectRelatedMixin, generic.CreateView):

    form_class=forms.BlogForm
    template_name='blogs/blog_form.html'

    def form_valid(self,form):

        self.object = form.save(commit=False)
        self.object.author = self.request.user
        self.object.save()

        for file in self.request.FILES:
            image=models.Image()
            image.img = self.request.FILES[file]
            image.post  = self.object
            image.save()

        return super().form_valid(form)

class EditBlog(LoginRequiredMixin, generic.UpdateView):
    model=models.Blog
    form_class=forms.EditBlogForm
    template_name="blogs/edit_blog.html"

    def form_valid(self,form):

        self.object = form.save(commit=False)
        self.object.author = self.request.user
        self.object.save()

        for file in self.request.FILES:
            image=models.Image()
            image.img=self.request.FILES[file]
            image.post=self.object
            image.save()

        return super().form_valid(form)

class BlogDetails(generic.DetailView):
    model=models.Blog
    template_name="blogs/blog_details.html"

class Uerblogs(generic.ListView):

    model=models.Blog
    template_name="blogs/user_posts.html"

    def get_queryset(self):
        try:
            self.blog_user = User.objects.prefetch_related("blogs").get(
                username__iexact=self.kwargs.get("username")
            )
        except User.DoesNotExist:
            raise Http404
        else:
            return self.blog_user.blogs.all()

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["blog_user"] = self.blog_user
        return context
