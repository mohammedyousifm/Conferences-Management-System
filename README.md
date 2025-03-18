<<<<<<< HEAD

# Conferences-Management-System

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Overview

The **Conference Management System** is a web-based platform designed to streamline the process of managing academic and professional conferences. It allows users to register, submit research papers, review submissions, and track the status of papers efficiently.

## Features

### 1. User Roles

-   **Author**:
    -   Register on the system.
    -   Submit papers for review.
    -   Track paper status.
    -   View comments and feedback from reviewers.
-   **Reviewer**:
    -   Register on the system.
    -   Receive papers assigned by the Controller.
    -   Review and provide feedback.
    -   Submit reviews.
-   **Controller**:
    -   Register on the system.
    -   Allocate papers to reviewers based on expertise.
    -   Monitor the status of paper reviews.
    -   Generate reports on review progress.

### 2. Main Functionalities

-   **User Registration**: Authors, Reviewers, and Controllers create accounts.
-   **Paper Submission**: Authors upload research papers.
-   **Paper Allocation**: Controllers assign papers to reviewers.
-   **Review Process**: Reviewers evaluate and provide feedback.
-   **Tracking & Monitoring**: Authors check paper status, Controllers oversee progress.
-   **Feedback System**: Reviewers submit comments, and Authors receive feedback.

## Data Flow Diagram (DFD)

### Level 1 DFD Overview

#### Entities:

-   **Author**: Submits papers, views status, receives feedback.
-   **Reviewer**: Reviews papers, submits feedback.
-   **Controller**: Allocates papers, monitors progress.

#### Processes:

1. **Paper Submission (P1)**: Authors submit their papers.
2. **Paper Allocation (P2)**: Controller assigns papers to reviewers.
3. **Paper Review (P3)**: Reviewers provide feedback.
4. **Paper Status Management (P4)**: Tracks paper and reviewer progress.

#### Data Stores:

-   **D1**: Author Database (Stores author details and submissions).
-   **D2**: Reviewer Database (Stores reviewer information and reviews).
-   **D3**: Paper Database (Stores paper details and status).
-   **D4**: Review Status Database (Stores feedback and progress data).

## Technologies Used

-   **Laravel**: Backend framework.
-   **Bootstrap**: Frontend styling.
-   **MySQL**: Database management.
-   **JavaScript, AJAX**: Dynamic UI interactions.

## Installation & Setup

1. Clone the repository:
    ```sh
    git clone https://github.com/your-username/conference-management-system.git
    ```
2. Navigate to the project directory:
    ```sh
    cd conference-management-system
    ```
3. Install dependencies:
    ```sh
    composer install
    npm install
    ```
4. Configure environment variables:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```
5. Migrate database:
    ```sh
    php artisan migrate
    ```
6. Start the server:
    ```sh
    php artisan serve
    ```

## License

This project is open-source and available under the [MIT License](LICENSE).

## contact me

https:://mohammedyousif.com
