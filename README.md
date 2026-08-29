# QuickShip Courier Service Management System

A web-based courier service management system built for **QuickShip Pvt. Ltd**, designed to bring order management, delivery tracking, warehousing, fleet, and finance operations into a single platform — replacing manual, spreadsheet-based workflows with a centralized system.

> Final year dissertation project — Bachelor of Information Technology (External), University of Colombo School of Computing (UCSC).

## About

Small courier companies often manage orders, packages, deliveries, and payments manually or with basic spreadsheets, which leads to processing errors, delays, and poor visibility into operations. QuickShip addresses this by providing a centralized, module-based system covering the full courier workflow — from order intake to final delivery and financial reporting.

The system was built using a **plan-driven, object-oriented approach**, modeled with **UML**, and implemented using the **MVC (Model-View-Controller)** architecture to keep the codebase organized and maintainable.

## Features

The system is organized into nine interconnected modules:

- **Order Management** — Create, update, view, and confirm customer orders; track order status; maintain modification/cancellation logs.
- **Warehouse Management** — Manage warehouse details, check-in/check-out packages, track package counts per warehouse, and generate activity reports.
- **Delivery Management** — Assign delivery routes to drivers, update delivery status in real time, upload proof of delivery (signatures/photos), and monitor driver performance.
- **Package Management** — Register packages, track current status, and generate reports by type, destination, or status.
- **Driver Management** — Maintain driver records (licenses, NIC, etc.) and trip history, and balance workload across drivers.
- **Vehicle Management** — Track vehicle details, assignment status, service records, and related expenses.
- **User Management** — Manage user accounts, authentication, and role-based access control (Admin, Driver, Staff).
- **Customer Management** — Register and maintain customer profiles, order history, feedback, and complaints.
- **Financial Management** — Handle order payments, staff salaries, and other expenses; generate financial reports for cash flow and tax purposes.

## Tech Stack

**Front-end**
- HTML5, CSS3, JavaScript
- Bootstrap 3
- jQuery

**Back-end**
- PHP 8.0

**Database**
- MySQL

**Server / Environment**
- Apache (via XAMPP for local development)

**Other Libraries**
- FPDF — for generating PDF reports, invoices, and receipts

**Tools**
- Visual Studio Code
- XAMPP
- Git & GitHub

## Architecture

The application follows the **MVC (Model-View-Controller)** pattern:

- `Model/` — Database interactions and business logic
- `View/` — User interface / presentation layer
- `Controller/` — Handles user requests and coordinates between Model and View

### Project Folder Structure

```
quickship/
├── Commons/       # Reusable functions, configurations, and utilities
├── Controller/    # Request handling and application logic
├── CSS/           # Stylesheets
├── Images/        # Image assets
├── Includes/      # Shared/reusable PHP files
├── JS/            # JavaScript (form validation, events, animations)
├── Model/         # Database interaction and business logic
└── View/          # UI templates and pages
```

### Coding Conventions

| Element        | Convention   | Example                                   |
|----------------|-------------|--------------------------------------------|
| PHP file names | snake_case  | `customer_name.php`, `package_type.php`    |
| Class names    | PascalCase  | `CustomerDetails`, `OrderManagement`       |
| Variables/functions | camelCase | `customerId`, `packageType`, `userRole` |

## Security

- Passwords are hashed using **SHA-1** before storage.
- Input validation (including regular expressions) is applied to enforce correct data formats and prevent invalid or malicious input.
- Role-based access control restricts feature access by user type (Admin, Driver, Staff).

## System Requirements

**Development / Deployment**
- OS: Windows 7 or above (Linux/macOS also supported via XAMPP)
- IDE: Visual Studio Code
- Database: MySQL
- Web Server: Apache
- Browser: Any modern web browser

**Hardware (recommended minimum)**
- Intel Core i3 (3.5GHz) or above
- 4 GB RAM or above
- 1 TB hard disk (min. 200 GB free space)
- Internet connection

## Testing

The system was validated through multiple levels of testing:

- **Unit Testing** — Individual functions and components
- **Integration Testing** — Interactions between modules
- **System Testing** — End-to-end functionality
- **User Acceptance Testing (UAT)** — Validated against real user expectations via a structured questionnaire

## Roadmap

Planned future enhancements include:

- A mobile application to extend system access beyond the web
- SMS/email notifications for order and delivery updates
- GPS-based real-time tracking
- A customer-facing portal for self-service parcel tracking

## Author

**S. M. L. D. K. Sangakkara**
Bachelor of Information Technology (External), University of Colombo School of Computing

## License

This project was developed as an academic dissertation. Please contact the author regarding reuse or licensing.
