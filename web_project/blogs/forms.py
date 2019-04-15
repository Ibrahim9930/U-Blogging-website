from django import forms
from .models import Blog,Comment


class BlogForm(forms.ModelForm):

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.fields['category'].widget.attrs.update({'class': 'special'})
    class Meta:
        model=Blog
        fields={
                'title',
                'content',
                'category',
        }
        widgets = {
            'title': forms.TextInput(attrs={'class': 'textinputclass'}),
            'content': forms.Textarea(attrs={'class': 'editable medium-editor-textarea postcontent'}),
        }

class EditBlogForm(forms.ModelForm):

    class Meta:
        model=Blog
        fields={
            'title',
            'content',
        }
        widgets = {
            'title': forms.TextInput(attrs={'class': 'textinputclass'}),
            'content': forms.Textarea(attrs={'class': 'editable medium-editor-textarea postcontent'}),
        }
