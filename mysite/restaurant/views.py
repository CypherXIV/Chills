from django.shortcuts import render, redirect
from django.contrib.auth import authenticate, login, logout
from django.contrib import messages
from restaurant.models import UserProfile
from django.contrib.auth.models import User
from django.contrib.auth.models import *
from .models import UserRole

def custom_admin_login(request):
    if request.method == 'POST':
        username = request.POST.get('username')
        password = request.POST.get('password')
        entered_pin = request.POST.get('pin')
        user_id = request.POST.get('user_id')  # Retrieve the user ID from the POST data

        user = authenticate(request, username=username, password=password)
        if user is not None:
            try:
                user_profile = UserProfile.objects.get(user=user, user_id=user_id)  # Use the user ID in the query
                if user_profile.pin == entered_pin:
                    login(request, user)
                    return redirect('admin:index')
                else:
                    messages.error(request, 'Invalid PIN.')
            except UserProfile.DoesNotExist:
                messages.error(request, 'Invalid User ID or PIN not set up for this user.')
        else:
            messages.error(request, 'Invalid username or password.')
    return render(request, 'custom_admin_login.html', {'UserRole': UserRole})


def create_user(request):
    if request.method == 'POST':
        user_id = request.POST.get('user_id')
        username = request.POST.get('username')
        password = request.POST.get('password')
        pin = request.POST.get('pin')
        role = request.POST.get('role')  # Assuming you have a role field in your form

        # Check if the user already exists
        if User.objects.filter(username=username).exists():
            messages.error(request, 'Username already exists.')
            return redirect('custom_admin_login')

        # Create the User instance
        user = User.objects.create_user(username=username, password=password)
        
        # Create the UserProfile instance
        UserProfile.objects.create(user=user, custom_user_id=user_id, pin=pin, role=role)

        messages.success(request, 'User created successfully!')
        return redirect('custom_admin_login')

    return redirect('custom_admin_login')