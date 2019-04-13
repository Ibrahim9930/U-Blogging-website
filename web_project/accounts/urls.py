from django.urls import path
from django.contrib.auth import views as auth_views
from . import views

app_name = 'accounts'
urlpatterns=[
    path('logout/',auth_views.LogoutView.as_view(),name='logout'),
    path("<int:pk>",views.UpdateUer.as_view(),name="update"),
]
