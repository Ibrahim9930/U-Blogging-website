# Create your views here.
from django.urls import reverse
from django.http import HttpResponseRedirect,HttpResponse
from django.views.generic import TemplateView
from django.shortcuts import render
from django.contrib.auth import authenticate, login, logout
from .forms import UserCreateForm


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
                    return HttpResponse('logged in')#to be changed with the home page
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
                return HttpResponse("done")
            else:

                su_fail=True
    else:
        user_form=UserCreateForm()

    return render(request,'accounts/index.html',{'injected':injected
                                                ,'form':user_form
                                                ,'su_fail':su_fail
                                                ,'login_fail':login_fail})
