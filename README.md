# Online Library Management System

An Online Library Management System built using PHP and MySQL. This system allows users to browse books, register, log in, borrow books, and more.

## How does it work??
-the `grub.php` file works by scraping the gallery of a website called [Standard Ebooks](https://standardebooks.org) and storing it into a database.
-the `book_gallery.php` gets data from the db and visualises it in the form of a catalogue.
-the `read.php` gets the data from whichever book the user clicked and prints it to read.


## Features

- **Book Gallery**: View all available books in a gallery format.
- **Search Functionality**: Search for books by title or author. // NOT IMPLEMENTED
- **User Authentication**: Users can sign up, log in, and manage their accounts. // SEMI-IMPELEMENTED
- **Borrowing System**: Users can borrow books, with a record of borrow and return dates. // NOT IMPELEMENTED
- **Admin Panel**: Admins can add, edit, or delete books from the library catalog. // NOT IMPELEMENTED
  
## Tech Stack

- **Frontend**: HTML, CSS (Bootstrap)
- **Backend**: PHP
- **Database**: MySQL
- **Libraries/Frameworks**:
  - Bootstrap (for responsive design)
  - PDO (for database interaction)
  - JavaScript (for interactivity)

## Installation

### Prerequisites

- **PHP**: Ensure you have PHP installed (version 7.0+).
- **MySQL**: Ensure MySQL is installed and running.

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/Cppchamp/Library_Management_System.git
    ```

2. Place the project folder in the **htdocs** or **www** directory of your local server (e.g., WAMP, XAMPP, or MAMP).

3. Create a MySQL database using the `library_management_db.sql` file included in the project.

4. Update your database connection settings in the `db.php` file:
    ```php
    $host = 'localhost';
    $dbname = 'library_management_db';
    $username = 'root';
    $password = '';
    ```

5. Navigate to the project folder and open the index file in your browser:
    ```bash
    http://localhost/Library_Management_System
    ```

## Usage

1. **Sign up**: Users can create an account to borrow books.
2. **Log in**: After registering, users can log in with their credentials.
3. **Browse Books**: Users can browse the available books in the library.
4. **Borrow Books**: Users can borrow books for a specified period.

## Database Schema

The database consists of the following tables:

1. **users**: Stores user information.
   - `id`: INT (Primary Key)
   - `username`: VARCHAR
   - `email`: VARCHAR
   - `password`: VARCHAR
   - `role`: ENUM ('admin', 'user')

2. **books**: Stores book information.
   - `id`: INT (Primary Key)
   - `title`: VARCHAR
   - `author`: VARCHAR
   - `imageUrl`: VARCHAR
   - `bookUrl`: VARCHAR

3. **borrowed_books**: Stores records of books borrowed by users.
   - `id`: INT (Primary Key)
   - `user_id`: INT (Foreign Key referencing `users.id`)
   - `book_id`: INT (Foreign Key referencing `books.id`)
   - `borrow_date`: DATE
   - `return_date`: DATE

## Contact

For any questions, feel free to reach out to the repository owner or email at [simon.kostov@gmail.com].

