# Human Resource Management System (HRMS)

This repository contains the implementation of a **Human Resource Management System (HRMS)** developed using Laravel. The system aims to simplify and automate HR processes such as employee management, leave tracking, payroll generation, and more.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Database Schema](#database-schema)
- [Contributing](#contributing)
- [License](#license)

## Overview

The HRMS is designed to:

1. Streamline HR processes within an organization.
2. Provide an intuitive user interface for admins and employees.
3. Ensure efficient management of employee data, leave policies, and payroll.

## Features

- **Employee Management:**
  - Add, edit, and delete employee records.
  - Assign roles and departments.

- **Leave Management:**
  - Apply for and approve leave requests.
  - Track leave balances.

- **Payroll Management:**
  - Generate monthly payrolls.
  - Track salary components and deductions.

- **Attendance Tracking:**
  - Record daily attendance.
  - Generate attendance reports.

- **Localization:**
  - Support for multiple languages for a diverse workforce.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/youssefelzahar/HRMS.git
   ```

2. Navigate to the project directory:
   ```bash
   cd HRMS
   ```

3. Install dependencies using Composer:
   ```bash
   composer install
   ```

4. Install Node.js dependencies:
   ```bash
   npm install
   ```

5. Set up the environment variables:
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Configure your database and other environment variables in the `.env` file.

6. Run the migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

8. Compile assets:
   ```bash
   npm run dev
   ```

## Usage

1. Access the application at `http://localhost:8000`.
2. Log in using the default admin credentials provided in the seeder (if applicable).
3. Manage employees, leaves, payroll, and more through the admin dashboard.

## Database Schema

The application uses the following core tables:

- **Employees:** Stores employee information such as name, role, department, and contact details.
- **Departments:** Organizes employees into departments.
- **Leaves:** Tracks leave applications and statuses.
- **Payroll:** Manages salary components and payment history.
- **Attendance:** Records daily attendance data.

## Contributing

Contributions are welcome! Follow these steps:

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature-branch
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add feature"
   ```
4. Push to the branch:
   ```bash
   git push origin feature-branch
   ```
5. Open a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
