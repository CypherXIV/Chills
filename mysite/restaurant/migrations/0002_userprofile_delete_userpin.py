# Generated by Django 4.2.5 on 2023-10-04 18:25

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
        ('restaurant', '0001_initial'),
    ]

    operations = [
        migrations.CreateModel(
            name='UserProfile',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('custom_user_id', models.CharField(max_length=10, unique=True)),
                ('pin', models.CharField(max_length=4)),
                ('role', models.CharField(choices=[('Manager', 'Manager'), ('Staff', 'Staff'), ('Client', 'Client')], max_length=10)),
                ('user', models.OneToOneField(on_delete=django.db.models.deletion.CASCADE, to=settings.AUTH_USER_MODEL)),
            ],
        ),
        migrations.DeleteModel(
            name='UserPin',
        ),
    ]
