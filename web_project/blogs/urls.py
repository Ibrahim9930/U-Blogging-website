from django.urls import path
from . import views

app_name='blogs'

urlpatterns=[
    path('createblog/', views.CreateBlog.as_view(), name='create'),
    path('<username>',views.Uerblogs.as_view(),name='uerblogs'),
]
