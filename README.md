# My Laravel + Livewire Project

This is a Laravel + Livewire project that includes the following features:

## Features

- **Authentication**: Login, Logout, Reset Password
- **Admin Management**: Manage admins and their permissions
- **Permissions Group**: Assign and manage permission groups
- **Layouts**: Dynamic and responsive layouts

## Requirements

- **PHP**: Version 8.1 or higher
- **Composer**: Version 2.7.2 or higher
- **Node.js** (with npm)
- **MySQL** or any other database supported by Laravel

## Installation Instructions
1. Install Dependencies
   Run the following command to install the PHP dependencies using Composer:
   composer install

2. Install Livewire v3 using Composer:
composer require livewire/livewire:^3.0

4. Install the Node.js dependencies using npm:
npm install
5. Generate the application key:
php artisan key:generate
6. Run Database Migrations
   php artisan migrate
7. Serve the Application
 php artisan serve
## Set Up Environment Variables
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_basic
DB_USERNAME=
DB_PASSWORD=

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/mhasaballah439/laravel_livewire.git
cd laravel_livewire
