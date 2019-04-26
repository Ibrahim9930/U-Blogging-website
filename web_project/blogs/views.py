from django.contrib import messages
from django.contrib.auth.mixins import LoginRequiredMixin
from django.http import ( HttpResponseRedirect,
                          HttpResponse,
                          JsonResponse,
                          )
from django.urls import reverse_lazy
from django.http import Http404
from django.views import generic

from braces.views import SelectRelatedMixin

from . import forms
from . import models
from categories.models import Category,Subscriber
from django.contrib.auth import get_user_model
User = get_user_model()

# Create your views here.

# ----class based view----
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

class HomePage(generic.ListView):

    model=models.Blog
    template_name = "blogs/home.html"

    def get_queryset(self):
        try:
            cats=[]
            i=0
            categories = Subscriber.objects.raw("select id,category_id FROM categories_subscriber WHERE member_id=%s",[self.request.user.id])
            for cat in categories:
                cats.append(cat.category)
            print(cats)
            self.blogs=models.Blog.objects.filter(category__in=cats).order_by("time_written")
            self.trending=models.Blog.objects.order_by("points")
        except User.DoesNotExist:
            raise Http404
        return self.blogs.all()

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["blogs"] = self.blogs
        context["trending"]=self.trending
        return context

class DeleteBlog(generic.DeleteView):

    model=models.Blog
    template_name="blogs/bye_blog.html"

    def get_success_url(self):
        return reverse_lazy("blogs:homepage")

class Uerblogs(generic.ListView):

    model=models.Blog
    template_name="blogs/user_posts.html"

    def get_queryset(self):
        try:
            self.blog_user = User.objects.prefetch_related("blogs").get(
                username__iexact=self.kwargs.get("username")
            )
            self.trending = self.blog_user.blogs.order_by("points")

            yayed_blogs = self.request.user.yays.all()
            self.y_blogs=[]
            for yay in yayed_blogs:
                print(yay.yayed.id)
                self.y_blogs.append(yay.yayed.id)

            nayed_blogs = self.request.user.nays.all()
            self.n_blogs=[]
            for nay in nayed_blogs:
                self.n_blogs.append(nay.nayed.id)
        except User.DoesNotExist:
            raise Http404
        else:
            return self.blog_user.blogs.all()

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["blog_user"] = self.blog_user
        context["trending"]  = self.trending
        context["yayed_blogs"] = self.y_blogs
        context["nayed_blogs"] = self.n_blogs
        return context

# ----function based views----

def yay(request,pk):

    id = pk
    print(id)
    yay = models.Yay()
    blog = models.Blog.objects.get(id=id)
    yay.yayed = blog
    yay.yayer = request.user
    yay.save()
    try:
        prev_nay = request.user.nays.get(nayed = blog)
        perv_nay.delete()
    except models.Nay.DoesNotExist:
        pass
    data = {
        "points":blog.points
    }
    return JsonResponse(data)

def unyay(request,pk):

    blog = models.Blog.objects.get(id=pk)
    models.Yay.objects.get(yayer = request.user, yayed = blog).delete()
    data = {
        "points":blog.points
    }
    return JsonResponse(data)

def nay(request,pk):

    id = pk
    print(id)
    nay = models.Nay()
    blog = models.Blog.objects.get(id=id)
    nay.nayed = blog
    nay.nayer = request.user
    nay.save()
    try:
        prev_yay = request.user.yays.get(yayed = blog)
        perv_yay.delete()
    except models.Yay.DoesNotExist:
        pass
    data = {
        "points":blog.points
    }
    print(data["points"])
    return JsonResponse(data)

def unnay(request,pk):

    blog = models.Blog.objects.get(id=pk)
    models.Nay.objects.get(nayer = request.user, nayed = blog).delete()
    data = {
        "points":blog.points
    }
    return JsonResponse(data)
