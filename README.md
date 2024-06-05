# Exam management App

The Exam Management App is a web-based platform designed to facilitate the management and conduct of exams for educational institutions. It provides functionalities for both teachers and students, allowing teachers to create and manage exams, and students to register for exams and take them within specified time frames.

## Table of Contents

-   [Installation](#installation)
-   [Usage](#usage)
-   [Configuration](#configuration)
-   [Contributing](#contributing)
-   [License](#license)
-   [Credits](#credits)

## Installation

### Prerequisites

-   PHP 8.1 or higher
-   Composer
-   MySQL
-   Node.js and npm

### Steps

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/suchithrashiju/exam-management-system.git
    cd exam-management-system
    ```
2.  **Install PHP dependencies:**

    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies:**

    ```bash
    npm install
    npm run dev
    npm run build
    ```

4.  **Copy the .env.example file to .env:**
    cp .env.example .env

5.  **Set up your .env file:**
    Update the .env file with your database credentials and other necessary configuration.

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

    ```

6.  **Generate an application key:**

```bash
 php artisan key:generate
```

7.  **Run database migrations:**

```bash
 php artisan migrate
```

8.  **Seed the database:**

Seed the database to include default users with roles assigned as both teachers and students, along with exam and question data for testing purposes.

```bash
 php artisan db:seed

```

9.  **Start the development server:**

```bash
php artisan serve
```

## Features

This app has two types of user roles: Teacher and Student.

### Teacher

    Teachers are responsible for creating and managing exams.
    They have the capability to add questions to exams, set exam durations and pass marks, and publish or archive exams.
    Teachers can also view exam results.

    Use the following teacher credentials to log in:
            Email: john.doe@example.com or jane.smith@example.com
            Password: password123

### Student

    Students can register for exams and take them within specified time frames.
    They are required to answer all questions in the exam.
    After completing the exam, students can view their pass/fail status and marks.
    Students can log in to the application to see the exams they have attended and their corresponding marks.

    Use the following student credentials to log in:
            Email: alice.johnson@example.com or bob.brown@example.com
            Password: password123

### Teacher Role Capabilities

    Create Exams: Teachers can create exams by providing exam names.
    Add Questions: For each exam, teachers can add questions along with four choices for answers. Each question carries one mark.
    Set Exam Duration and Pass Marks: Teachers can set the duration of the exam and specify the pass marks.
    Publish and Archive Exams: Teachers can publish exams for students to register and attend. They also have the option to archive exams.
    View Exam Results: Teachers can view the results of exams, including the marks obtained by students.

### Student Role Capabilities

    View Available Exams: Students can view details of the latest published exams on the website.
    Register for Exams: Students can register for exams they wish to attend.
    Take Exams: Students can attend exams within the predetermined time frame set by the teacher. The system automatically saves exam results once the timer ends.
    View Pass/Fail Status: After completing the exam, students can view their pass/fail status and marks.
    View Attended Exams and Marks: Students can log in to the application to see the exams they have attended and their corresponding marks.

### Technologies Used

    Frontend: HTML, CSS, JavaScript,Bootstrap,Jquery
    Backend: Laravel Framework 11
    Database: MySQL

### Configuration

-   Environment Variables

-   APP_NAME: The name of your application.
-   DB_CONNECTION: The database connection type (e.g., mysql).
-   DB_HOST: The database host.
-   DB_PORT: The database port.
-   DB_DATABASE: The database name.
-   DB_USERNAME: The database username.
-   DB_PASSWORD: The database password.

### Customizing the Application

Modify the configuration files in the config directory as needed. This includes database settings, caching, and other application-specific settings.

## Contributing

## How to Contribute

    Fork the repository.
    Create a new branch (git checkout -b feature/your-feature-name).
    Make your changes.
    Commit your changes (git commit -m 'Add some feature').
    Push to the branch (git push origin feature/your-feature-name).
    Open a pull request.

## Coding Standards

    Follow PSR-12 coding standards.
    Ensure all new features have corresponding tests.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

### Credits

    Author: Suchithra.S
    Contributors: List of contributors
