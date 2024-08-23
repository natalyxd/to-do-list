# to-do-list
# To-Do List Application

## Overview

This is a simple To-Do List application built using PHP, MySQL, HTML, CSS, and JavaScript. It allows users to manage tasks, including adding, editing, deleting, and marking tasks as completed. The application uses a MySQL database to store task information and provides a user-friendly interface for managing tasks.

## Features

- Add new tasks with a title, description, and due date.
- Edit existing tasks.
- Delete tasks.
- Mark tasks as completed or incomplete.
- View a list of all tasks with their details.

## Requirements

- PHP (version 7.4 or higher)
- MySQL (version 5.7 or higher)
- A web server such as Apache or Nginx
- A browser for viewing the application

## Setup

### 1. Database Setup

1. Create the Database:
   - Open your MySQL client and create a new database:
     ```sql
     CREATE DATABASE todo_list;
     ```

2. Create the Tasks Table:
   - Use the following SQL to create the `tasks` table:
     ```sql
     USE todo_list;

     CREATE TABLE tasks (
         id INT AUTO_INCREMENT PRIMARY KEY,
         title VARCHAR(255) NOT NULL,
         description TEXT,
         due_date DATETIME NOT NULL,
         is_completed BOOLEAN DEFAULT FALSE
     );
     ```

### 2. Application Files

1. Download or Clone the Repository:
   - Ensure you have all the following files in your project directory:
     - `index.php` - Main application file containing the form and task list.
     - `style.css` - CSS file for styling the application.
     - `app.js` - JavaScript file for handling the edit functionality.

### 3. Running the Application

1. Access the Application:
   - Open your web browser and navigate to `http://localhost/index.php`.

## Usage

- Add a Task:
  - Enter the task title, description, and due date in the form and click "Add Task."

- Edit a Task:
  - Click the "Edit" button next to the task you want to modify. Update the task details in the form and click "Update Task."

- Delete a Task:
  - Click the "Delete" button next to the task you want to remove.

- Mark as Completed:
  - Click on the checkbox next to the task to mark it as completed or incomplete.

## Files Description

- `index.php`: Main PHP file for handling form submissions and displaying tasks.
- `style.css`: CSS file for styling the application’s layout and design.
- `app.js`: JavaScript file for handling the edit functionality and interacting with the form.


