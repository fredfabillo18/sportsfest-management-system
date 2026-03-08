# Sportsfest Management System

A simple **sportsfest dashboard** built for managing school intramurals.
This project was originally created as a **high school Web Development class project** and is now archived here as a legacy project.

The system allows administrators to manage players, teams, sports events, and game schedules through a web interface, while anonymous users can view public information such as directories and schedules.

## Features

### Admin Login

Administrators can log in to manage the sportsfest data, including:

* Player directory
* Team directory
* Sports directory
* Game schedules

Admins can **view, add, edit, and modify entries** within these directories.

### Anonymous Access

Anonymous users can log in with limited permissions and can only:

* View player directory
* View team directory
* View sports directory
* View game schedules

This allows participants and spectators to check information without modifying any data.

## Tech Stack

* **PHP**
* **MySQL**
* **MySQLi (mysqli)**
* **Bootstrap** (template-based UI)

The system uses **MySQLi for database connectivity** between PHP and the MySQL database.

## Screenshots

Screenshots of the interface are included in this repository.
These were captured from the original demo video of the project.

## Project Structure

The main entry point of the application is:

```
login.php
```

found in the **folder**

```
src
```

From there, users can log in either as an **admin** or **anonymous user** and navigate the system.

## Database

⚠️ **Important Note**

The original **MySQL database backup is no longer available**, so the repository only contains the application code.

To run the system locally, a database schema would need to be recreated manually based on the queries used in the PHP files.

## Background

This project was developed as part of a **high school Web Development class**. It served as a simple exercise in:

* CRUD web applications
* user authentication
* PHP–MySQL integration
* basic dashboard design using Bootstrap

The code is preserved here primarily for **archival and learning purposes**.
