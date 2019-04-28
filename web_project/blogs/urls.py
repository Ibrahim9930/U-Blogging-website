from django.urls import path
from . import views

app_name='blogs'

urlpatterns=[
    path('createblog/', views.CreateBlog.as_view(), name='create'),
    path('edit/<int:pk>', views.EditBlog.as_view(), name='edit'),
    path('<int:pk>/', views.BlogDetails.as_view(), name="details"),
    path('delete/<int:pk>', views.DeleteBlog.as_view(), name="delete"),
    path('home/', views.HomePage.as_view(), name="homepage"),
    path('<username>', views.Uerblogs.as_view(), name='uerblogs'),
    path("explore/", views.ExploreBlogs.as_view(), name="explore"),
    path('yay/', views.yay, name="yay"),
    path('unyay/', views.unyay, name="unyay"),
    path('nay/', views.nay, name="nay"),
    path("unnay/", views.unnay, name="unnay"),

]
