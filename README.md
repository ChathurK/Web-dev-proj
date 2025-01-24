# Inventory Management System

This is a PHP-based Inventory Management System that allows users to manage inventory items, generate reports, and handle user authentication.

## Features

- User Authentication (Sign Up, Login)
- Add New Inventory Items
- Export Inventory Data to CSV
- Responsive Design using Bootstrap

## Folder Structure

- `php/`: Contains PHP scripts for various functionalities.
  - `add_item.php`: Script to add new inventory items.
  - `export_inventory_csv.php`: Script to export inventory data to a CSV file.
  - `signup.php`: Script for user registration.
  - `db_connect.php`: Script to connect to the database.
- `.github/workflows/`: Contains GitHub Actions workflows for CI/CD.
  - `deployment_inventsys.yml`: Workflow for deploying the app to Azure Web App.

## Setup

1. Clone the repository to your local machine.
2. Set up a local web server (e.g., XAMPP) and place the project files in the `htdocs` directory.
3. Create a MySQL database and import the provided SQL file to set up the necessary tables.
4. Update the `db_connect.php` file with your database credentials.
5. Start the local web server and navigate to the project URL (e.g., `http://localhost/WebProj`).

## Deployment

This project uses GitHub Actions for CI/CD. The workflow defined in `.github/workflows/deployment_inventsys.yml` will automatically deploy the app to Azure Web App on every push to the `deployment` branch.

## License

This project is licensed under the MIT License.
"# Inventory-Management-System" 
"# Inventory-Management-System" 
