# Laravel Category and Subcategory CRUD Application

Welcome to the GetProject world! This project serves as a basic guide for junior developers to understand how to perform CRUD operations (Create, Read, Update, Delete) for categories and subcategories using Laravel.

## Prerequisites

Before getting started, make sure you have the following installed on your machine:

- PHP (>= 7.3)
- Composer
- Laravel
- MySQL or any other database of your choice

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/getbuildfirst/assignment-task.git
   Navigate to the project directory:
   ```

### cd assignment-task

# Install dependencies:

## composer install

## Create a copy of the .env.example file and rename it to .env:

## cp .env.example .env

## Configure your database connection in the .env file:

## DB_CONNECTION=mysql

## DB_HOST=127.0.0.1

## DB_PORT=3306

## DB_DATABASE=your_database_name

## DB_USERNAME=your_database_username

## DB_PASSWORD=your_database_password

## Generate an application key:

## php artisan key:generate

## Migrate the database:

## php artisan migrate

## Start the development server:

## php artisan serve

## Now, you can access the application by visiting http://localhost:8000 in your browser.

# Features

## Category CRUD

### Create Category: Add new categories with a name and optional description.

### Read Category: View a list of all categories along with their details.

### Update Category: Edit the information of existing categories.

### Delete Category: Remove unwanted categories.

## Subcategory CRUD

### Create Subcategory: Add new subcategories under a specific category.

### Read Subcategory: View a list of all subcategories along with their parent category.

### Update Subcategory: Edit the information of existing subcategories.

### Delete Subcategory: Remove unwanted subcategories.

# Usage

## Visit the homepage to navigate to the Category and Subcategory sections.

## Use the provided forms to perform CRUD operations.
