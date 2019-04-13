from django.urls import path
from . import views

app_name='categotries'

urlpatterns=[
    path('<name>',views.Categoryblogs.as_view(),name="category_blogs")
]
