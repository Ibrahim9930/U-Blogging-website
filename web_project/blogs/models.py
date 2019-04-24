from django.db import models
from categories.models import Category
from django.contrib.auth import get_user_model
from django.urls import reverse
from django.http import HttpResponseRedirect,HttpResponse

User = get_user_model()
# Create your models here.

class Blog(models.Model):

    points=models.IntegerField(default=0)
    title=models.CharField(max_length=255, unique=False, blank=True, default="")
    author=models.ForeignKey(User,on_delete=models.CASCADE,related_name="blogs")
    category=models.ForeignKey(Category,on_delete=models.CASCADE,related_name="cat_blogs")
    time_written=models.DateTimeField(auto_now=True)
    # images=models.ManyToManyField('Image',related_name="blog_images")
    # yays=models.ManyToManyField('Yay',related_name="post_yays")
    # nays=models.ManyToManyField('Nay',related_name="post_nays")
    # comments=models.ManyToManyField('Comment',related_name="post_comments")
    content=models.TextField()
    # photo=models.ImageField(upload_to="images/")

    def __str__(self):
        return "{} by {}".format(self.title,self.author)

    def get_absolute_url(self):
        return reverse('Home')

class Image(models.Model):

    post=models.ForeignKey(Blog,on_delete=models.CASCADE,related_name="blog_images")
#for some reason its refusing to take the title of the post
    img=models.ImageField(upload_to="images/")




class Yay(models.Model):

    yayer=models.ForeignKey(User,on_delete=models.CASCADE,related_name="yays")
    yayed=models.ForeignKey(Blog,on_delete=models.CASCADE,related_name="blog_yays")

    def __str__(self):
        return "{} yayed {}".format(self.yayer.username,self.yayed.title)

class Nay(models.Model):

    nayer=models.ForeignKey(User,on_delete=models.CASCADE,related_name="nays")
    nayed=models.ForeignKey(Blog,on_delete=models.CASCADE,related_name="blog_nays")

    def __str__(self):
        return "{} nayed {}".format(self.nayer.username,self.nayed.title)

class Comment(models.Model):

    author=models.ForeignKey(User,on_delete=models.CASCADE)#may cause the comment to be poseted by the active user
    post=models.ForeignKey(Blog,on_delete=models.CASCADE,related_name="blog_comments")
    content=models.TextField(max_length=280)

    def __str__(self):
        return "comment by {}".format(self.author.username)
