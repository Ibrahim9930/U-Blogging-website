import os
# Configure settings for project
# Need to run this before calling models from application!
os.environ.setdefault('DJANGO_SETTINGS_MODULE','web_project.settings')
import django
# Import settings
django.setup()

import random
from blogs.models import *
from categories.models import *
from accounts.models import *
from django.contrib.auth.models import User

import random
from faker import Faker
from faker.providers import lorem,person,misc,internet
fakegen = Faker()
fakegen.add_provider(lorem)
fakegen.add_provider(person)
fakegen.add_provider(misc)
fakegen.add_provider(internet)

def populate_users(n=30):
    for entry in range(n):
        print(entry)
        user = User()
        user.username = fakegen.user_name()
        user.first_name = fakegen.first_name()
        user.last_name = fakegen.last_name()
        user.password = fakegen.password(length=15, special_chars=True, digits=True, upper_case=True, lower_case=True)
        user.email = fakegen.email()
        user.save()
        user.uer.profile_pic = fakegen.image_url()
        user.uer.bio = fakegen.paragraph(nb_sentences=3, variable_nb_sentences=True, ext_word_list=None)
        user.uer.visited = True
        user.save()
    print("User population done")

def populate_subscriber(n=40):
    cats = Category.objects.all()
    users = User.objects.all()
    for entry in range(n):
        sub = Subscriber.objects.get_or_create(member = random.choice(users), category = random.choice(cats))[0]
        sub.save()
    print("Sub population done")

def populate_cat_blogs(name="nth",n=15):
    cats = Category.objects.all()
    users = User.objects.all()

    if name!= "nth":
        cat = Category.objects.get(slug=name)
        for entry in range(n):
            print(entry)
            author = random.choice(users)
            title = fakegen.sentence(nb_words=6, variable_nb_words=True, ext_word_list=None)
            content = fakegen.text(max_nb_chars=600, ext_word_list=None)
            blog = Blog.objects.get_or_create(author = author,content = content, title=title, category = cat)[0]
            blog.save()
            for i in range(random.randint(0,5)):
                src = "C:\\xampp\\htdocs\\U-Blogging-website\\web_project\\media\\images\\"+cat.name+str(i)+"."+"jpg"
                img = Image.objects.get_or_create(post = blog , img = src)[000]
                img.save()
            for i in range(random.randint(0,10)):
                yay = Yay.objects.get_or_create(yayer = random.choice(users), yayed = blog)[0]
                yay.save()
            for i in range(random.randint(0,10)):
                nay = Nay.objects.get_or_create(nayer = random.choice(users), nayed = blog)[0]
                nay.save()
    else:
        for entry in range(30):
            print(entry)
            author = random.choice(users)
            title = fakegen.sentence(nb_words=6, variable_nb_words=True, ext_word_list=None)
            content = fakegen.text(max_nb_chars=600, ext_word_list=None)
            cat = random.choice(cats)
            blog = Blog.objects.get_or_create(author = author,content = content, title=title, category =cat)[0]
            blog.save()
            for i in range(random.randint(0,5)):
                src = src = "C:\\xampp\\htdocs\\U-Blogging-website\\web_project\\media\\images\\"+cat.name+str(i)+"."+"jpg"
                img = Image.objects.get_or_create(post = blog , img = src)[0]
                img.save()
            for i in range(random.randint(0,10)):
                yay = Yay.objects.get_or_create(yayer = random.choice(users), yayed = blog)[0]
                yay.save()
            for i in range(random.randint(0,10)):
                nay = Nay.objects.get_or_create(nayer = random.choice(users), nayed = blog)[0]
                nay.save()
    print("Blog population done")
if __name__ == '__main__':
    populate_users()
    populate_cat_blogs("culture",15)
    populate_cat_blogs()
    populate_subscriber()
