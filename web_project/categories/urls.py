from django.urls import path
from . import views

app_name='categories'

urlpatterns=[
    path('<name>',views.Categoryblogs.as_view(),name="category_blogs"),
    path('subscribe/<name>',views.Subscribe,name="subscribe"),
    path('unsubscribe/<name>',views.Unsubscribe,name="unsubscribe"),
    path("cat_list/",views.CategoryList.as_view(),name="list"),
]
