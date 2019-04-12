# from django.db import models
# from django.contrib.auth import User
# from django.utils import timezone
# from django.db.models.signals import post_save
# from django.dispatch import receiver
#
# # Create your models here.
# class Uer(models.Model):
#
#     user=models.OneToOneField(User,on_delete=models.CASCADE,parent_link=True)
#     profile_pic=models.ImageField(upload_to='profile_pictures/')
#     bio=models.CharField(max_length=200)
#
#     def __str__(self):
#         return "@{}".format(self.user.username)
#
#     @receiver(post_save, sender=auth.models.User)
#     def create_user_profile(sender, instance, created, **kwargs):
#         if created:
#             Uer.objects.create(user=instance)
#
#     @receiver(post_save, sender=auth.models.User)
#     def save_user_profile(sender, instance, **kwargs):
#         instance.uer.save()

from django.db import models
from django.contrib.auth.models import User
from django.db.models.signals import post_save
from django.dispatch import receiver

class Uer(models.Model):
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    bio = models.TextField(max_length=450, blank=True)
    profile_pic=models.ImageField(upload_to="profile_pictures/")

    def __str__(self):
        return "@{}".format(self.user.username)

@receiver(post_save, sender=User)
def create_user_uer(sender, instance, created, **kwargs):
    if created:
        Uer.objects.create(user=instance)

@receiver(post_save, sender=User)
def save_user_uer(sender, instance, **kwargs):
    instance.uer.save()
