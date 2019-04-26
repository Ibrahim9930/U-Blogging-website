from django.urls import path
from . import views

app_name='blogs'

urlpatterns=[
    path('createblog/', views.CreateBlog.as_view(), name='create'),
    path('<username>',views.Uerblogs.as_view(),name='uerblogs'),
    path('edit/<int:pk>',views.EditBlog.as_view(),name='edit'),
    path('<int:pk>/',views.BlogDetails.as_view(),name="details"),
    path('delete/<int:pk>',views.DeleteBlog.as_view(),name="delete"),
    path('home/',views.HomePage.as_view(),name="homepage"),
    path('yay/<int:pk>/',views.yay,name="yay"),
    path('nay/<int:pk>/',views.nay,name="nay"),

]
