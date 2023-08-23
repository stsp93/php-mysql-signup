# php-mysql-signup
This is a PHP & MySQL web application that includes user registration, login functionality, profile management

## Getting Started

1. Install XAMPP

2. Clone the repository to xampp\htdocs\

3. Configure Project Folder (optional):
- Open the config/db.php file and update the $projectFolder variable with the corresponding folder name on your local server (if needed).
- Open the .htaccess in the main directory and change RewriteBase /php-mysql-signup/ with the corresponding folder name on your local server (if needed).

4. Database Configuration:
- Create database
- Open the config/db.php file and update the hostname, db_name, username, and password variables to match your MySQL server configuration.

5. Import Database Schema:
- You can find the schema of the users table in the users.sql file located in the main directory. Import this SQL file into your database using a tool like phpMyAdmin or the command line.

### Running the Project

1.  Start XAMPP and ensure Apache and MySQL services are running.
2.  Open your web browser and navigate to http://localhost/php-mysql-signup
