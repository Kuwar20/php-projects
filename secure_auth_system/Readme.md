# Secure Authentication System

Secure Authentication System is a PHP-based web application that provides secure user authentication functionalities, including user registration, login, password reset, and profile management. It utilizes PHP sessions, PDO for database interactions, and password hashing for enhanced security.

## Features

- User registration with input validation
- User login with email and password authentication
- Password hashing for secure storage
- Password reset functionality via email
- User profile management (update name and email)
- User deletion functionality

## Technologies Used

- PHP
- MySQL
- Bootstrap (for styling)
- SMTP2GO API (for sending emails)

## Setup

1. Clone the repository to your local machine.
2. Import the `database.sql` file into your MySQL database.
3. Update the `config.php` file with your database credentials and SMTP2GO API key.
4. Ensure that PHP and MySQL are installed and running on your server.
5. Navigate to the project directory in your terminal and start the PHP server (e.g., `php -S localhost:{PORT}`).
6. Open your web browser and go to `http://localhost:{PORT}` to access the application.

## Usage

- Register: Create a new account by providing your name, email, and password.
- Login: Access your account by entering your registered email and password.
- Forgot Password: Reset your password by providing your email address and following the instructions sent to your email.
- Profile: View and update your profile information, including your name and email.
- Logout: Sign out of your account to end the current session.
- Delete Account: Permanently delete your account and all associated data.

## Contributing

Contributions are welcome! If you find any bugs or have suggestions for improvements, feel free to open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).
