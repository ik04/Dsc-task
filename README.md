## Task:
Create a web-based Library Catalog Management System that
allows librarians to manage their library's collection of books, magazines,
and other materials. The system will provide a RESTful API for performing
CRUD operations on library catalogue entries.
Make sure to design the API with clean and intuitive endpoints that
are easy to use, follow standard RESTful practices and comprehensive
documentation for all your endpoints.
All entries must be saved on any database (used: sqlite)

## Overview:
This is a simple library management system where you can add any type of material and assign it to a category, you can then manipulate the data in a few ways.

## 💻 Tech Stack:

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) ![SQLite](https://img.shields.io/badge/sqlite-%2307405e.svg?style=for-the-badge&logo=sqlite&logoColor=white)

## Download Composer and Laravel:
Windows:
- Install Php and xampp for windows [here](https://www.apachefriends.org/)

- Install Composer for windows [here](https://getcomposer.org/)
- to install Laravel, run the following after installing composer
```bash
composer global require laravel/installer
```

Linux:
- Run these commands:
```bash
sudo apt-get install -y php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath

sudo apt install composer

composer global require laravel/installer
```
- With this you'll have everything you'll need to run my project 

## Api Endpoints:
this api has been made in accordance to the task and so it dosen't store every detail so as to streamline the testing process, it has also been made to easily work with a frontend.

healthcheck and init:
- api/v1/healthcheck-and-init (route to check if the api is workign and to initialize the db with a few categories)

Category routes:
- api/v1/add-category (add categories using this route, will explain in usage) **POST**
- api/v1/get-categories (gets all existing categories present in the db) **GET**
- api/v1/delete-category (delete any particular category in the db, it also deletes all books associated with the category using cascade on delete) **POST**

Book routes:
- api/v1/add-book (add a book to the db) **POST**
- api/v1/get-books (gets all books in the db) **GET**
- api/v1/delete-book (delete books in the db) **POST**
- api/v1/update-book-category (update the category of any book, this is the only field since you can't change the name of a book in an actual library XD) **POST**
## Initialize:
- After installing and setting up laravel and composer run:
```bash
composer install
cp .env.example .env
php artisan migrate
php artisan serve
```

-  After this is done you can test out the routes by sending requests
-  The methods of each route are inscribed after the each of the mentioned routes

## Parameters for each route (Post routes):


![[Screenshot_20230912_001956.png]]

This Screenshot contains all the routes present in the api.php file inside of the routes folder.

You can refer the app/Controllers folder to check the controller code and get the params:
- For /add-category:
You need only add a name field (field name "name")
- For /delete-category:
Provide a category_uuid once you create some categories (field name "category_uuid")
- for /add-book:
Provide a name and category_uuid
- for /delete-book:
Provide a book_uuid
- for /update-book-category:
Provide the book_uuid and the new_category_uuid



