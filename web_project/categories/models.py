from django.db import models
from django.contrib.auth import get_user_model
from django.utils.text import slugify
from django.contrib.auth import get_user_model
from accounts.models import Uer

User = get_user_model()
# Create your models here.

class Category(models.Model):
    name=models.CharField(max_length=25,unique=True)
    info=models.TextField(max_length=255,blank=True,default="")
    slug = models.SlugField(allow_unicode=True, unique=True)
    Members=models.ManyToManyField(User,related_name="members")
    pic=models.ImageField(upload_to="categories_photos" ,null=True)
    def __str__(self):
        return self.name

    def save(self,*args,**kwargs):

        self.slug = slugify(self.name)
        super().save(self,*args,**kwargs)

    def get_absolute_url(self):
        return reverse("groups:single", kwargs={"slug": self.slug})
