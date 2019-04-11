from django.db import models
from django.contrib import auth
from django.utils import timezone
from django.db.models.signals import post_save
from django.dispatch import receiver

# Create your models here.
class Uer(models.Model):

    user=models.OneToOneField(auth.models.User,on_delete=models.CASCADE,parent_link=True)
    profile_pic=models.ImageField(upload_to='profile_pictures/')
    bio=models.CharField(max_length=200)

    def __str__(self):
        return "@{}".format(self.user.username)

    @receiver(post_save, sender=auth.models.User)
    def create_user_profile(sender, instance, created, **kwargs):
        if created:
            Uer.objects.create(user=instance)

    @receiver(post_save, sender=auth.models.User)
    def save_user_profile(sender, instance, **kwargs):
        instance.uer.save()
