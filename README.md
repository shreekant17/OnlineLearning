# Online Learning Platform

## Project Overview

The **Online Learning Platform** is a web-based educational system designed to provide students with a seamless learning experience while enabling instructors to efficiently manage and deliver their courses. This platform offers an intuitive interface for course browsing, enrollment, content management, and secure transactions.

## Features

- **For Students:**

  - Browse and enroll in courses.
  - Access structured lessons with videos and PDF notes.
  - Track progress and earn certificates.
  - Secure checkout for course purchases.

- **For Instructors:**

  - Upload and manage course content.
  - Organize materials into modules and lessons.
  - Share resources such as PDFs and assignments.
  - Set course prices and receive payments.

- **Admin Panel:**

  - Manage users (students & instructors).
  - Oversee course listings and payments.
  - Monitor platform activity.

## Technologies Used

- **Frontend:** HTML, CSS, Bootstrap, JavaScript, jQuery
- **Backend:** PHP (CodeIgniter Framework)
- **Database:** MySQL
- **Web Server:** XAMPP
- **Payment Gateway:** Razorpay

## Installation

### Prerequisites

- XAMPP (or any Apache server with PHP and MySQL support)
- Visual Studio Code (or any code editor)

### Setup Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/shreekant17/online-learning-platform.git
   ```
2. **Move to the project directory**:
   ```bash
   cd online-learning-platform
   ```
3. **Import the database**:
   - Open XAMPP and start MySQL.
   - Create a new database (`online_learning`).
   - Import the provided `database.sql` file.
   - Add API Keys for SMTP for OTP Use config/api_keys_example.php for format and create a new file config/api_keys.php
4. **Configure environment settings**:
   - Navigate to `application/config/database.php` and update database credentials.
   - Set up `base_url` in `application/config/config.php`.
5. **Start the server**:
   - Open XAMPP and start Apache.
   - Access the platform via `http://localhost/online-learning-platform/`.

## Usage

- **Students**: Sign up, enroll in courses, and start learning.
- **Instructors**: Create and upload courses with structured modules.
- **Admins**: Manage users and platform settings.

## Screenshots

- Login Page
- Dashboard (Student & Instructor)
- Course Page
- Admin Panel

## Contributing

If you want to contribute to this project:

1. Fork the repository.
2. Create a new branch (`feature-branch`).
3. Commit your changes and push.
4. Create a pull request.

## License

This project is licensed under the MIT License.

## Author

**Shreekant Kalwar**

## Contact

For any queries, reach out via email at [shreekantkalwar@gmail.com].
