# ReliefNet - Disaster Management System

ReliefNet is a web-based disaster management system designed to track disaster events, manage resources, and coordinate relief efforts. This project has been migrated from MySQL to **SQLite** for easier setup and portability.

## Project Structure

The project is structured as follows:

- **`index.php`**: The main dashboard. Shows summary statistics and a list of active disaster events.
- **`login.php` & `logout.php`**: User authentication pages.
- **`process_login.php`**: Server-side logic for user login.
- **`signup.php`**: User registration page.
- **`process_signup.php`**: Server-side logic for user registration.
- **`add_event.php`**: Form for reporting new disaster events.
- **`process_event.php`**: Server-side logic for saving disaster events.
- **`db.php`**: Database connection configuration. Now uses **SQLite** via PDO with a MySQLi compatibility layer.
- **`database.sqlite`**: The SQLite database file containing all project data.
- **`schema_sqlite.sql`**: The SQL schema used to create the database.
- **`style.css`**: Modern CSS styles for the entire application.

## Database Connection (SQLite)

The project now uses SQLite. No external database server (like MySQL or MariaDB) is required.

- The connection is handled in `db.php` using **PDO**.
- A compatibility layer is included in `db.php` so that existing `mysqli` code continues to work without modification.
- Database file: `database.sqlite` (automatically loaded).

## How to Run

### Prerequisite
You must have **PHP** installed on your system with the **sqlite3** extension enabled.

---

### On Arch Linux

1. **Install PHP and SQLite**:
   ```bash
   sudo pacman -S php php-sqlite
   ```

2. **Configure PHP**:
   Ensure `extension=pdo_sqlite` and `extension=sqlite3` are uncommented in your `/etc/php/php.ini`.

3. **Start the PHP Server**:
   Navigate to the project directory and run:
   ```bash
   php -S localhost:8000
   ```

4. **Access the App**:
   Open your browser and go to `http://localhost:8000/login.php`.

---

### On Windows

#### Option 1: Using PHP directly (Recommended)
1. **Download PHP**: Get the "Thread Safe" version from [windows.php.net](https://windows.php.net/download/).
2. **Enable Extensions**: In your `php.ini`, uncomment `extension=pdo_sqlite` and `extension=sqlite3`.
3. **Run the Server**:
   Open Command Prompt (cmd) in the project folder and run:
   ```cmd
   php -S localhost:8000
   ```
4. **Access the App**: Go to `http://localhost:8000/login.php`.

#### Option 2: Using XAMPP
1. Move the `relief` folder into `C:\xampp\htdocs\`.
2. Start the **Apache** module from the XAMPP Control Panel.
3. Access the app at `http://localhost/relief/login.php`.

---

## Initial Setup & Seeding

1. **Populate the Database**:
   After starting the server, you can fill the database with sample data (including users **tanim** and **soumik**) by visiting:
   `http://localhost:8000/seed.php`

2. **Default Login Credentials**:
   - **User**: `tanim@reliefnet.com`
   - **Password**: `password123`

3. **Manual Registration**:
   You can also create a new account via the **Register** button on the login page.
