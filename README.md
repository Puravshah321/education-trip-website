# Edu Trip – Educational Travel Management Website

> A PHP and MySQL-based educational travel management platform designed to help educational institutions explore, plan, and book educational trips.

## Overview

**Edu Trip** is a web-based educational travel management system that combines educational trip discovery with itinerary planning and institutional booking.

The platform is designed primarily for **schools, colleges, and other educational institutions**. Institutions can register on the platform, browse available educational trip packages, view detailed itineraries, review frequently asked questions, and submit bookings. The system also includes an administrative section for managing trip-related information.

The project uses a traditional server-rendered web architecture built with **PHP, MySQL/MariaDB, HTML, CSS, JavaScript, and Bootstrap**, with additional frontend libraries such as Swiper and Font Awesome.

---

## Key Features

### 1. Educational Trip Packages

The platform provides a collection of educational travel packages containing information such as:

- Package name
- Package type
- Educational category
- State
- Target grade/education level
- Suitable season/month
- Duration
- Available dates
- Package price
- Destination imagery

The package data is stored in MySQL and rendered dynamically using PHP.

### 2. Package Filtering

Packages contain multiple attributes that can be used to organize trips according to educational requirements, including:

- Package type
- Category
- State
- Grade level
- Month/season

This makes it easier for institutions to identify trips that match their students' educational needs.

### 3. Detailed Itineraries

Each package can be opened to view a detailed itinerary.

An itinerary can contain:

- Day number
- Route
- Distance
- Planned activities
- Associated activities
- Hotel information
- Images

The itinerary is linked to the selected package through the package ID.

### 4. Institution Registration and Login

Educational institutions can create accounts containing:

- Institution name
- Email address
- Password
- Address
- Phone number

Sessions are used to maintain the logged-in institution's state throughout the website.

### 5. Trip Booking

Registered institutions can submit trip booking information, including:

- Institution details
- Selected package
- Number of students
- Arrival date
- Leaving date
- Contact information
- Address

The booking is stored in the database and receives a unique booking ID.

### 6. Booking Confirmation and Receipt

The system includes pages for:

- Booking confirmation
- Booking receipt
- Viewing previous bookings through the institution profile

This provides institutions with a record of their submitted trips.

### 7. FAQ Section

The website provides a dedicated FAQ section addressing common questions related to:

- What participants should bring
- Meals
- Transportation
- Planned activities
- Free time
- Itineraries
- Emergency contacts
- Expected participant behavior

FAQ data is stored in the database and can be managed as part of the application.

### 8. Activity Management

The database contains an activity catalogue with information such as:

- Activity name
- Activity location
- Activity price

Examples include:

- Jungle safari
- Museum visits
- Art activities
- Music concerts
- Camping
- Rock climbing
- Zip lining
- River rafting

### 9. Hotel Information

The system maintains hotel information associated with educational trips, including:

- Hotel name
- State
- City
- Price
- Rating

### 10. Tour Guide Information

Guide records contain:

- Guide name
- Phone number
- State
- City
- Work experience

This allows trip-related guide information to be maintained in a structured manner.

### 11. Feedback and Ratings

The database supports institutional feedback with:

- Feedback ID
- Institution ID
- Remarks
- Rating

Ratings allow trip experiences to be recorded and evaluated.

### 12. Admin Section

The project includes a separate `admin` directory for administrative functionality.

The database contains an `admin_login` table and supports management of trip-related records.

### 13. CAPTCHA Support

The project includes `generate_captcha.php`, which is used as part of the CAPTCHA functionality for forms that require verification.

### 14. Responsive and Interactive UI

The frontend combines:

- Custom CSS
- Bootstrap
- Font Awesome
- Swiper.js
- JavaScript

The homepage includes an automatically rotating image slider and responsive content sections.

---

## Technology Stack

| Technology | Purpose |
|---|---|
| **PHP** | Server-side application logic and dynamic page rendering |
| **MySQL / MariaDB** | Database management |
| **HTML5** | Page structure |
| **CSS3** | Custom styling and responsive layout |
| **JavaScript** | Client-side interactions |
| **Bootstrap 5** | Responsive UI components and layout |
| **Swiper.js** | Homepage image carousel |
| **Font Awesome** | Icons |
| **phpMyAdmin** | Database administration during development |

The included database dump was generated using phpMyAdmin and identifies PHP 8.2.12 and MariaDB 10.4.32 in the development environment.

---

## Project Structure

```text
education-trip-website/
│
├── project/
│   │
│   ├── admin/
│   │   └── Administrative pages and resources
│   │
│   ├── css/
│   │   └── Custom stylesheets
│   │
│   ├── images/
│   │   └── Website images, icons and trip assets
│   │
│   ├── js/
│   │   └── Client-side JavaScript
│   │
│   ├── SimpleExcel/
│   │   └── Spreadsheet-related project resources
│   │
│   ├── about.php
│   ├── book.php
│   ├── book_form.php
│   ├── booking_confirmed.php
│   ├── faq.php
│   ├── generate_captcha.php
│   ├── get_activity_details.php
│   ├── home.php
│   ├── index.php
│   ├── insert_question.php
│   ├── itinerary.php
│   ├── itinerary_data.php
│   ├── logout.php
│   ├── package.php
│   ├── package_details.php
│   ├── profile.php
│   ├── receipt.php
│   ├── Itinerary_data.txt
│   ├── Book1.csv
│   ├── Book2.csv
│   ├── Book3.csv
│   ├── Book4.csv
│   ├── project (1).sql
│   └── LICENSE
│
└── README.md
```

---

## Main Application Pages

### `index.php`

The main landing page of Edu Trip.

It provides:

- Navigation
- Hero image slider
- Services
- About section
- Featured/top destinations
- Package previews
- Footer/contact information

Packages displayed on the homepage are retrieved dynamically from the database.

### `about.php`

Provides information about the Edu Trip platform and its educational travel concept.

### `package.php`

Displays available educational trip packages and allows users to explore available options.

### `package_details.php`

Provides additional information about an individual package.

### `itinerary.php`

Displays the itinerary associated with a selected package.

### `book.php`

Handles booking-related functionality.

### `book_form.php`

Provides the form through which an institution can enter booking information.

### `booking_confirmed.php`

Displays confirmation after a successful booking.

### `receipt.php`

Provides booking receipt information.

### `profile.php`

Allows a logged-in institution to access information related to its bookings.

### `faq.php`

Displays frequently asked questions and their answers.

### `logout.php`

Terminates the current institution session.

### `generate_captcha.php`

Generates CAPTCHA content used to help verify form submissions.

### `get_activity_details.php`

Provides activity-related information used by the application.

---

## Database Design

The project uses a MySQL/MariaDB database named:

```text
project
```

The SQL database dump is available at:

```text
project/project (1).sql
```

### Main Tables

#### `registration`

Stores educational institution accounts.

Important fields include:

- `institute_id`
- `institute_name`
- `institute_email`
- `institute_password`
- `institute_address`
- `institute_phone_number`

#### `booking`

Stores trip booking records.

Important fields include:

- `booking_id`
- `booking_date`
- `institute_id`
- `package_id`
- `institution_name`
- `institution_email`
- `institution_phone_no`
- `institution_address`
- `number_of_student`
- `arrival_date`
- `leaving_date`

#### `package`

Stores educational trip packages.

Important fields include:

- `package_id`
- `package_type`
- `filter_category`
- `filter_state`
- `filter_grade`
- `filter_month`
- `package_name`
- `package_duration`
- `package_date1`
- `package_date2`
- `package_date3`
- `package_price`
- `image_id`

#### `itinerary`

Stores the day-by-day information associated with packages.

It contains information such as:

- Route
- Day number
- Distance
- Activities
- Activity ID
- Hotel ID
- Image ID

#### `activity`

Stores activities available for educational trips.

#### `hotel`

Stores hotel information and ratings.

#### `guide`

Stores tour guide information and work experience.

#### `images`

Stores image paths associated with trip packages.

#### `faq`

Stores frequently asked questions and answers.

#### `feedback`

Stores feedback and ratings submitted for trips.

#### `admin_login`

Stores administrative login records.

---

## Database Relationships

The main application can be understood through the following relationships:

```text
                    ┌─────────────────┐
                    │   Registration  │
                    │   Institution   │
                    └────────┬────────┘
                             │
                             │ institute_id
                             ▼
                    ┌─────────────────┐
                    │     Booking     │
                    └────────┬────────┘
                             │
                             │ package_id
                             ▼
                    ┌─────────────────┐
                    │     Package     │
                    └────────┬────────┘
                             │
                             │ package_id
                             ▼
                    ┌─────────────────┐
                    │    Itinerary    │
                    └───┬────┬────┬──┘
                        │    │    │
             activity_id│    │    │image_id
                        │    │    │
                        ▼    │    ▼
                  ┌────────┐ │ ┌────────┐
                  │Activity│ │ │ Images │
                  └────────┘ │ └────────┘
                             │
                         hotel_id
                             ▼
                        ┌────────┐
                        │ Hotel  │
                        └────────┘
```

The SQL dump also contains database triggers that automatically generate formatted IDs for several entities.

---

## Automatic ID Generation

The database uses triggers to generate IDs automatically.

Examples include:

```text
Activity       A00001
Admin          AD0001
Booking        B00001
Feedback       FD0001
Guide          G00001
Hotel          H00001
Image          IMG001
Itinerary      I00001
Package        P00001
```

This reduces the need to manually generate unique identifiers when inserting new records.

---

## Application Flow

A typical institution workflow is:

```text
Visit Edu Trip
      │
      ▼
Explore Home Page
      │
      ▼
Browse Packages
      │
      ▼
Select a Package
      │
      ▼
View Package Details
      │
      ▼
View Itinerary
      │
      ▼
Register / Login
      │
      ▼
Enter Booking Details
      │
      ▼
Submit Booking
      │
      ▼
Booking Confirmation
      │
      ▼
View Receipt / Previous Bookings
```

---

## Requirements

Before running the project locally, install the following:

- PHP 8.x
- MySQL or MariaDB
- Apache web server
- XAMPP / WAMP / LAMP (recommended for local development)
- phpMyAdmin (recommended for importing and managing the database)
- A modern web browser

The included SQL dump was originally generated in an environment using PHP 8.2.12 and MariaDB 10.4.32.

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Puravshah321/education-trip-website.git
```

Move into the project:

```bash
cd education-trip-website
```

### 2. Locate the Application

The main application is inside:

```text
project/
```

If you are using XAMPP, copy the project into your Apache web root:

```text
C:\xampp\htdocs\
```

For example:

```text
C:\xampp\htdocs\education-trip-website\
```

### 3. Start Apache and MySQL

Open the XAMPP Control Panel and start:

- Apache
- MySQL

Make sure both services are running before opening the application.

### 4. Create the Database

Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
project
```

### 5. Import the SQL File

Select the `project` database and import:

```text
project/project (1).sql
```

The SQL dump creates the required tables, triggers, and sample records.

### 6. Verify Database Configuration

The PHP application currently uses a local MySQL configuration similar to:

```php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project";
```

If your local MySQL credentials are different, update the database configuration in the relevant PHP files.

> **Security note:** Do not use default credentials in production. Use environment-specific credentials and keep secrets outside publicly accessible source code.

### 7. Run the Website

Open:

```text
http://localhost/education-trip-website/project/
```

Depending on your folder structure, the URL may differ slightly.

---

## Configuration

The application currently follows a simple PHP configuration approach.

Typical local configuration:

```text
Database Host: localhost
Database Name: project
Database User: root
Database Password: <your-local-password>
```

Before deployment, it is recommended to move database credentials into a secure configuration file or environment variables.

---

## Frontend Libraries

The project uses external CDN resources for several frontend dependencies.

### Bootstrap

Used for:

- Responsive layouts
- Dropdowns
- UI components

### Swiper.js

Used for the homepage image carousel.

The homepage configures the slider with:

- Continuous looping
- Pagination
- Automatic slide changes
- Approximately 3-second autoplay delay

### Font Awesome

Used for interface icons such as:

- User
- Phone
- Email
- Navigation
- Social media icons

---

## Security Considerations

This project is intended primarily as an academic/web-development project. Before using it in a production environment, several security improvements should be considered.

### Password Security

Passwords should be stored using secure password hashing such as:

```php
password_hash()
```

and verified using:

```php
password_verify()
```

Plain-text passwords should not be stored in a production database.

### SQL Injection Protection

Database queries should use prepared statements with parameterized values rather than directly concatenating user input into SQL queries.

### Session Security

Production deployments should use:

- Secure session cookies
- HTTPS
- Session regeneration after authentication
- Proper session expiration

### Input Validation

All user-supplied fields should be validated on the server side, including:

- Email addresses
- Phone numbers
- Dates
- Student counts
- Package IDs
- Institution details

### File and Image Security

Uploaded or referenced files should be validated to prevent malicious file uploads or path traversal.

### Credentials

Database and administrator credentials should never be committed to a public repository.

---

## Testing Checklist

Before deploying or submitting the project, test the following:

### Authentication

- [ ] Institution registration works
- [ ] Institution login works
- [ ] Invalid login is rejected
- [ ] Logout destroys the session
- [ ] Profile is accessible only to authenticated users

### Packages

- [ ] Packages load correctly
- [ ] Package details open correctly
- [ ] Package images display correctly
- [ ] Package dates are displayed correctly
- [ ] Package prices are displayed correctly

### Itinerary

- [ ] Correct itinerary loads for the selected package
- [ ] Day-wise information is displayed
- [ ] Activities are displayed
- [ ] Hotel information is displayed
- [ ] Images load correctly

### Booking

- [ ] Booking form loads
- [ ] Required fields are validated
- [ ] Booking is stored in the database
- [ ] Booking ID is generated
- [ ] Confirmation page displays
- [ ] Receipt can be viewed
- [ ] Previous bookings are visible in the profile

### FAQ

- [ ] FAQ page loads
- [ ] Questions and answers are displayed correctly

### Admin

- [ ] Admin login works
- [ ] Administrative pages are protected
- [ ] Package/activity/guide/hotel information can be managed as intended

---

## Troubleshooting

### Database Connection Failed

If the application reports a database connection error:

1. Make sure MySQL/MariaDB is running.
2. Confirm the database is named `project`.
3. Verify the username and password.
4. Check the hostname.
5. Confirm that the SQL dump was imported successfully.

### Images Are Not Displaying

Check that:

- The `images/` directory exists.
- Image paths stored in the database are correct.
- File names match exactly.
- The application is being accessed through Apache rather than opening PHP files directly in the browser.

### PHP Code Is Displayed Instead of Executed

Make sure:

- Apache is running.
- PHP is installed/configured.
- The project is inside the Apache web root.
- You are accessing it through `http://localhost/...`.

Do not open `.php` files directly from the filesystem.

### Unknown Table Error

If you see an error such as:

```text
Table 'project.package' doesn't exist
```

import the provided SQL file:

```text
project/project (1).sql
```

into the `project` database.

---

## Development Notes

The project follows a server-rendered PHP architecture:

```text
Browser
   │
   ▼
Apache
   │
   ▼
PHP Pages
   │
   ├── HTML/CSS/JavaScript
   │
   └── MySQL/MariaDB
            │
            ▼
        Project Database
```

Most application pages combine PHP logic with HTML templates. Database queries retrieve application data and dynamically generate sections of the webpage.

---

## Future Enhancements

Potential improvements for future versions include:

- Secure password hashing
- Prepared SQL statements throughout the application
- Role-based authorization
- Environment-based configuration
- REST API integration
- Online payment integration
- Email booking confirmations
- SMS notifications
- Advanced package search and filtering
- Google Maps integration
- Real-time trip availability
- Automated invoice generation
- Improved booking cancellation workflow
- Admin dashboard with analytics
- Better mobile-first UI
- Automated testing
- Deployment using a production PHP hosting platform
- Docker-based development environment
- Improved accessibility and WCAG compliance

---

## Project Highlights

Edu Trip demonstrates several practical web-development concepts:

- Server-side PHP development
- Relational database design
- CRUD-oriented application workflows
- Session-based authentication
- Dynamic database-driven webpages
- Form handling
- Booking management
- Database triggers
- Responsive frontend development
- Third-party frontend libraries
- File/image management
- Administrative workflows

---

## License

The repository includes a **GNU General Public License v3.0 (GPL-3.0)** license file.

See the [`LICENSE`](LICENSE) file in the repository for the complete license terms.

---

## Repository

**GitHub Repository:**

https://github.com/Puravshah321/education-trip-website

---

## Acknowledgements

This project was developed as an educational web-development project demonstrating how a travel-management concept can be implemented for educational institutions using PHP, MySQL/MariaDB, HTML, CSS, and JavaScript.

---

## Disclaimer

This README documents the project based on the current repository structure and source/database files. Some features or administrative workflows may require additional configuration or may be intended for academic/demo use rather than production deployment.
