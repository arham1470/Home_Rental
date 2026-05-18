# Home Renting System

A beginner-friendly, secure, and scalable **Home Renting System Web Application** built with:

- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5
- **Backend:** Core PHP
- **Database:** MySQL
- **Environment:** XAMPP

---

## Features

### Tenant
- Register/Login
- Manage profile
- Search and filter properties
- View property details
- Save favorites
- Send rental requests
- Send inquiries/contact landlord

### Landlord
- Register/Login
- Manage profile
- Add/manage property listings
- View and manage booking requests
- View tenant inquiries

### Admin
- Dashboard overview
- Manage users
- Manage properties
- Monitor bookings
- View summary reports

---

## Security Practices Included

- Password hashing (`password_hash`, `password_verify`)
- Prepared statements (PDO)
- Input validation/sanitization
- Role-based access control
- Session-based authentication
- XSS-safe output helper (`e()`)

---

## Project Structure

```text
Home_Rental/
├── index.php
├── login.php
├── register.php
├── logout.php
├── search.php
├── property-details.php
├── contact.php
├── README.md
├── TODO.md
│
├── config/
│   ├── app.php
│   ├── db.php
│   └── auth.php
│
├── includes/
│   ├── header.php
│   ├── navbar.php
│   ├── footer.php
│   ├── flash.php
│   └── sidebar.php
│
├── assets/
│   ├── css/style.css
│   ├── js/app.js
│   ├── images/
│   └── uploads/
│
├── actions/
│   ├── register_action.php
│   ├── login_action.php
│   ├── profile_action.php
│   ├── property_action.php
│   ├── favorite_action.php
│   ├── booking_action.php
│   └── inquiry_action.php
│
├── tenant/
│   ├── dashboard.php
│   ├── profile.php
│   ├── favorites.php
│   ├── requests.php
│   └── inquiries.php
│
├── landlord/
│   ├── dashboard.php
│   ├── add-property.php
│   ├── manage-properties.php
│   ├── bookings.php
│   └── inquiries.php
│
├── admin/
│   ├── dashboard.php
│   ├── users.php
│   ├── properties.php
│   ├── bookings.php
│   └── reports.php
│
└── database/
    └── home_renting.sql
```

---

## Setup Instructions (XAMPP)

1. **Copy project folder** into:
   - `C:/xampp/htdocs/Home_Rental`

2. **Start Apache and MySQL** from XAMPP Control Panel.

3. **Create database and import SQL**
   - Open `http://localhost/phpmyadmin`
   - Create database: `home_renting`
   - Import file: `database/home_renting.sql`

4. **Update DB config if needed**
   - File: `config/db.php`
   - Default values:
     - host: `localhost`
     - db: `home_renting`
     - user: `root`
     - pass: `` (empty)

5. **Run project**
   - Open: `http://localhost/Home_Rental`

---

## Default Admin

SQL seed includes default admin:

- **Email:** `admin@homerenting.com`
- **Password:** `Admin@123`

If login fails, re-import SQL and ensure users table seed inserted.

---

## Notes

- Current implementation includes core full-stack flow and role modules.
- You can extend next with:
  - CSRF protection tokens in all forms
  - Property image upload module with stricter MIME checks
  - Messaging/reply threads
  - Advanced reports/charts
  - Pagination and sorting
