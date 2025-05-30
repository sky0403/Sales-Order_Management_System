# Sales-Order Management System

## Overview

This Sales-Order Management System is a web application designed to streamline the sales and order processing workflow. It provides a login (staff) interface (Home.html) and supports functionalities such as customer record management, product (item) management, order creation, order updates, and monthly reporting. The system is built using a combination of frontend (HTML, CSS, JavaScript (with Bootstrap, jQuery, and Owl Carousel)) and backend (PHP) technologies, and it uses a MySQL (or MariaDB) database for persistent storage. In addition, a Python API (Discount.py) is provided for discount calculations.

## Features

- **Staff Login:** Secure login via Home.html (using PHP/Login.php).
- **Customer Management:** View, add, update, and delete customer records (see CustomerRecord.php, CustomerDetail.php, DeleteCustomerRecords.php).
- **Product (Item) Management:** Add, update, view, and delete product (item) details (see AddProduct.php, UpdateProduct.php, ViewProduct.php, InsertItem.php, ItemInformation.php).
- **Order Management:** Create, update, view, and delete orders (see CreateOrder.php, UpdateOrder.php, ViewOrder.php, DelOrder.php, DeleteFromCart.php, CancelCreateOrder.php, addOrder2.php, Order.php).
- **Reporting:** Generate monthly reports (see MonthlyReport.php).
- **Discount API:** A Python API (Discount.py) is provided for discount calculations.

## Tech Stack

- **Frontend:** HTML, CSS (Bootstrap, custom stylesheets (style.css, NavigationBar.css, navbar.css)), JavaScript (jQuery, Bootstrap JS, Owl Carousel, custom scripts (disable.js, navBar.js, main.js)).
- **Backend:** PHP (scripts for business logic, database interactions, and session management).
- **API:** Python (Discount.py) for discount calculations.
- **Database:** MySQL (or MariaDB) (see createProjectDB.sql for schema and sample data).

## Local Setup Instructions

### Prerequisites

- A web server (e.g., XAMPP, WAMP, or MAMP) with PHP (version 8.0.2 or later) and MySQL (or MariaDB) installed.
- Python (for running the Discount API).

### Steps

1. **Clone the Repository**

   Clone (or download) the repository into your local web server's document root (for example, in XAMPP, place it under `htdocs`).

2. **Database Setup**

   - Open your MySQL client (e.g., phpMyAdmin) and create a new database (or use an existing one).
   - Import the provided SQL dump (createProjectDB.sql) to set up the database schema and sample data.

3. **Configure Database Connection**

   - In the PHP backend (for example, in `php/conn.php`), update the database connection parameters (host, username, password, database name) if necessary.

4. **Run the Python API (Optional)**

   - Navigate to the `api` folder and run the Discount API (e.g., using `python Discount.py`). Ensure that your Python environment is set up (and that any required dependencies are installed).

5. **Access the Application**

   - Open your web browser and navigate to the project's URL (for example, if using XAMPP, go to `http://localhost/Sales-Order_Management_System/Home.html`).
   - Log in using the provided staff credentials (for example, Staff ID: s0001, Password: a123).

## Deployment (Example Using XAMPP)

- **Install XAMPP:** Download and install XAMPP (or a similar stack) on your server.
- **Place Project Files:** Copy the entire project folder (Sales-Order_Management_System) into the `htdocs` folder of your XAMPP installation.
- **Start Services:** Start the Apache and MySQL services via the XAMPP Control Panel.
- **Import Database:** Use phpMyAdmin (or a MySQL client) to import the `createProjectDB.sql` file.
- **Configure (if needed):** Adjust the database connection parameters in your PHP files (e.g., in `php/conn.php`) if your database credentials differ.
- **Access the Application:** Open a browser and navigate to `http://localhost/Sales-Order_Management_System/Home.html`.

## Conclusion

This README is tailored for a company presentation, highlighting the project's overview, features, tech stack, and setup instructions (both for local development and deployment). It omits sections on contributors, license, or contact info as per your request.