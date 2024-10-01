E-Commerce Website
Overview

This is a fully functional e-commerce website where users can browse, search, and add products to their shopping cart. The website supports user registration, login, and management of shopping cart items. However, payments are not integrated, so users cannot connect to any bank accounts or make actual transactions. The website also includes an admin panel for the owner to manage products, categories, prices, and other product-related details.
Features
User Features:

    User Registration: Users can sign up with an email, name, address, and other basic details. Upon registration, a confirmation email is sent thanking the user for joining.
    Login System: Users can log in with their email and password, with credentials securely stored in a MySQL database.
    Product Browsing: Users can search and browse through the product catalog.
    Shopping Cart:
        Add, remove, and update products in the shopping cart.
        View the cart and proceed to place an order.
    Order Placement: Users can place an order, but since no payment integration is available, the process is simulated without any actual transactions.
    User Account: Users can view and update their information, and log out when done.

Admin Features:

    Admin Login: The website owner has a separate login with elevated privileges.
    Product Management:
        Add, update, or delete products and categories.
        Change product details such as name, price, description, and images.
    User Cart Management: The admin can view and modify user carts if necessary.
    Full Control Over Website: The admin has the ability to manage all content and data related to the products and users.

Tech Stack

    Frontend:
        HTML: Structure of the web pages.
        CSS: Styling and layout of the website.
        JavaScript: Client-side interaction and dynamic content updates.

    Backend:
        PHP: Handles server-side logic, managing user accounts, shopping carts, and admin functionality.
        Python: Some functionality may be supported by Python scripts (e.g., email handling).

    Database:
        MySQL (Localhost): Stores all user data, product information, categories, shopping cart details, and admin data.

Installation & Setup

    Clone the Repository:

    bash

    git clone https://github.com/yourusername/your-repo-name.git

    Set Up MySQL Database:
        Create a MySQL database locally and import the required database schema from the db_schema.sql file included in the repository.
        Update the database connection details in the PHP files (such as config.php or similar).

    Configure Email:
        Update the email handling logic in Python to work with your email provider (e.g., using SMTP for sending registration emails).

    Run the Server:
        You can use a local server environment like XAMPP or WAMP to run the website.
        Place the project files in the htdocs directory (for XAMPP) or equivalent, and start the Apache and MySQL services.

    Access the Website:
        Open your browser and go to https://github.com/AhmadS0099/WebDesign.

Usage

    Users can sign up, log in, and start adding products to their shopping carts.
    Admins can log in via the admin login page and manage products and users as necessary.

Future Enhancements

    Integrating a real payment gateway (e.g., PayPal, Stripe).
    Adding a user profile page for viewing order history.
    Improving security features like password hashing and SSL.
    Building RESTful APIs for more dynamic and responsive functionality.

Contributing

Feel free to submit issues and pull requests to improve the project. Contributions are welcome!
License

This project is licensed under the MIT License - see the LICENSE file for details.
