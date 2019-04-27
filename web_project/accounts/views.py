# Create your views here.
from django.urls import reverse,reverse_lazy
from django.http import HttpResponseRedirect,HttpResponse
from django.views.generic import TemplateView
from django.shortcuts import render
from django.contrib.auth import authenticate, login, logout
from .forms import UserCreateForm
from django.views import generic
from django.contrib.auth.models import User
from . import models
from django.contrib.auth import get_user_model
Usr = get_user_model()
def Home(request):
    login_fail=False
    su_fail=False
    injected=""
    if request.method=='POST':
        if 'login' in request.POST:

            username=request.POST['username']
            password=request.POST['password']
            user_form=UserCreateForm()
            user=authenticate(username=username,password=password)
            if user:
                if user.is_active:

                    login(request,user)
                    return HttpResponseRedirect(reverse_lazy("blogs:homepage"))#to be changed with the home page
                else:

                    injected="This User has been deactivated"
                    login_fail=True
            else:

                injected="Username and password don't match"
                login_fail=True
        elif 'signup' in request.POST:

            user_form=UserCreateForm(data=request.POST)
            if user_form.is_valid():

                user=user_form.save()
                psswd=request.POST['password1']
                user.set_password(psswd)
                user.save()
                login(request,user)
                return HttpResponseRedirect("http://127.0.0.1/U-Blogging-website/web_project/php/welcome.php?username="+request.POST['username'])
            else:

                su_fail=True
    else:
        user_form=UserCreateForm()


    return render(request,'accounts/index.html',{'injected':injected
                                                ,'form':user_form
                                                ,'su_fail':su_fail
                                                ,'login_fail':login_fail})
class UpdateUer(generic.UpdateView):
    model=models.Uer
    template_name="accounts/settings.html"
    fields=('bio',)

    def form_valid(self,form):
        if self.request.POST['fname']!="":
            self.object.user.first_name=self.request.POST['fname']
        if self.request.POST['lname']!="":
            self.object.user.last_name=self.request.POST['lname']
        if self.request.POST['email']!="":
            self.object.user.email=self.request.POST['email']
        if self.request.POST['bio']!="":
            self.object.bio=self.request.POST['bio']
        if self.request.POST['old_password']!="":
            psswd=self.request.POST['old_password']
            if self.object.user.check_password(psswd):
                if self.request.POST['password1']!=self.request.POST['password2']:
                    form.add_error('bio', 'Passwords don\'t match')
                    return self.form_invalid(form)
                elif self.request.POST['password1']!='':
                    self.object.user.set_password(self.request.POST["password1"])
            else :
                form.add_error('bio', 'Wrong Password')
                return self.form_invalid(form)
        if len(self.request.FILES)>0:
            self.object.profile_pic=self.request.FILES['pic']
        self.object.user.save()
        return super().form_valid(form)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["blog_user"] = self.object.user
        return context
