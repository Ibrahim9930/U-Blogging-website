from django.urls import path
from django.contrib.auth import views as auth_views
from . import views

app_name = 'accounts'
urlpatterns=[
    path('logout/',views.user_logout,name='logout'),
    path("<int:pk>",views.UpdateUer.as_view(),name="update"),
]
