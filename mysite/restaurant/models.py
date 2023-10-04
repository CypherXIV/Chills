from django.contrib.auth.models import User
from django.db import models

class UserRole(models.TextChoices):
    MANAGER = 'Manager'
    STAFF = 'Staff'
    CLIENT = 'Client'

class UserProfile(models.Model):
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    custom_user_id = models.CharField(max_length=10, unique=True)  # Renamed field
    pin = models.CharField(max_length=4)
    role = models.CharField(max_length=10, choices=UserRole.choices)  # Updated to use UserRole.choices
