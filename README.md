### Project Description: HoldCompany Dashboard

#### Overview
The HoldCompany Dashboard is a PHP-based web application designed to manage customer and user data for a company. The application includes features for user authentication, customer management, and a floating menu button for easy navigation. The project is structured to allow for easy maintenance and scalability.

#### Features
1. **User Authentication**:
   - Login and logout functionality.
   - User session management.
   - User roles (admin and user).

2. **Customer Management**:
   - Add, update, and delete customer records.
   - Search functionality to find customers by name or code.
   - Display customer details including name, code, company name, and status.

3. **Floating Menu Button**:
   - A reusable floating menu button component that provides quick access to various actions such as adding a customer, logging out, and navigating to the dashboard.
   - The menu button is styled with CSS and includes interactive behavior using jQuery.

#### Directory Structure
```
descontin_holdcompany
├── assets
│   └── images
│       ├── logo-icon.png
│       └── logo.png
├── components
│   └── FloatingMenuButton.php
├── config
│   ├── db.php
│   └── hold_company.sql
├── controller
│   ├── Customer.php
│   └── User.php
├── style.css
├── script.js
├── dashboard.php
├── customer_form.php
├── index.php
├── login.php
├── logout.php
├── register.php
└── menu-item.php
```

#### Key Files
- **`config/db.php`**: Contains the database connection configuration using PDO.
- **`controller/User.php`**: Manages user-related operations such as login, create, update, and delete.
- **`controller/Customer.php`**: Manages customer-related operations such as create, update, and delete.
- **`components/FloatingMenuButton.php`**: Renders the floating menu button component.
- **`dashboard.php`**: The main dashboard page that displays customer data and includes the floating menu button.
- **`customer_form.php`**: A form for adding or editing customer details.
- **`index.php`**: The login page for the application.
- **`style.css`**: Contains the CSS styles for the application.
- **`script.js`**: Contains the jQuery script for the floating menu button behavior.

#### Technologies Used
- **PHP**: Server-side scripting language for building the application logic.
- **MySQL**: Database management system for storing user and customer data.
- **HTML/CSS**: Markup and styling for the user interface.
- **JavaScript (jQuery)**: For interactive elements such as the floating menu button.
- **Flowbite**: A CSS framework for styling components.

#### How to Use
1. **Setup Database**:
   - Import the hold_company.sql file into your MySQL database to create the necessary tables.

2. **Configure Database Connection**:
   - Update the database connection details in db.php.

3. **Run the Application**:
   - Start your PHP server and navigate to index.php to log in.
   - Use the dashboard to manage customers and utilize the floating menu button for quick actions.

This project provides a robust foundation for managing customer and user data within a company, with a focus on ease of use and maintainability.

MarceloStudies: create a readme with this description 

GitHub Copilot: ### README.md

# HoldCompany Dashboard

## Overview
The HoldCompany Dashboard is a PHP-based web application designed to manage customer and user data for a company. The application includes features for user authentication, customer management, and a floating menu button for easy navigation. The project is structured to allow for easy maintenance and scalability.

## Features
1. **User Authentication**:
   - Login and logout functionality.
   - User session management.
   - User roles (admin and user).

2. **Customer Management**:
   - Add, update, and delete customer records.
   - Search functionality to find customers by name or code.
   - Display customer details including name, code, company name, and status.

3. **Floating Menu Button**:
   - A reusable floating menu button component that provides quick access to various actions such as adding a customer, logging out, and navigating to the dashboard.
   - The menu button is styled with CSS and includes interactive behavior using jQuery.

## Directory Structure
```
descontin_holdcompany
├── assets
│   └── images
│       ├── logo-icon.png
│       └── logo.png
├── components
│   └── FloatingMenuButton.php
├── config
│   ├── db.php
│   └── hold_company.sql
├── controller
│   ├── Customer.php
│   └── User.php
├── style.css
├── script.js
├── dashboard.php
├── customer_form.php
├── index.php
├── login.php
├── logout.php
├── register.php
└── menu-item.php
```

## Key Files
- **`config/db.php`**: Contains the database connection configuration using PDO.
- **`controller/User.php`**: Manages user-related operations such as login, create, update, and delete.
- **`controller/Customer.php`**: Manages customer-related operations such as create, update, and delete.
- **`components/FloatingMenuButton.php`**: Renders the floating menu button component.
- **`dashboard.php`**: The main dashboard page that displays customer data and includes the floating menu button.
- **`customer_form.php`**: A form for adding or editing customer details.
- **`index.php`**: The login page for the application.
- **`style.css`**: Contains the CSS styles for the application.
- **`script.js`**: Contains the jQuery script for the floating menu button behavior.

## Technologies Used
- **PHP**: Server-side scripting language for building the application logic.
- **MySQL**: Database management system for storing user and customer data.
- **HTML/CSS**: Markup and styling for the user interface.
- **JavaScript (jQuery)**: For interactive elements such as the floating menu button.
- **Flowbite**: A CSS framework for styling components.

## How to Use
1. **Setup Database**:
   - Import the `hold_company.sql` file into your MySQL database to create the necessary tables.

2. **Configure Database Connection**:
   - Update the database connection details in db.php.

3. **Run the Application**:
   - Start your PHP server and navigate to index.php to log in.
   - Use the dashboard to manage customers and utilize the floating menu button for quick actions.

This project provides a robust foundation for managing customer and user data within a company, with a focus on ease of use and maintainability.