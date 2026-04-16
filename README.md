# ReliefNet - Disaster Management System

ReliefNet is a web-based disaster management system designed to track disaster events, manage resources, and coordinate relief efforts. This project has been migrated from MySQL to **SQLite** for easier setup and portability.

## Project Structure

- **`index.php`**: The main dashboard showing summary statistics.
- **`login.php` / `signup.php`**: User authentication forms.
- **`events.php` / `resources.php` / `donations.php`**: Data management pages.
- **`db.php`**: Database connection (SQLite PDO with MySQLi compatibility layer).
- **`database.sqlite`**: The local database file (contains all data).
- **`style.css`**: UI styling for the entire application.

---

## Detailed Setup for Windows

### Option 1: Using XAMPP (easiest for beginners)

1. **Install XAMPP**: Download and install from [apachefriends.org](https://www.apachefriends.org/).
2. **Move Project**: Copy your project folder into `C:\xampp\htdocs\relief`.
3. **Enable SQLite Extension**:
   - Open the **XAMPP Control Panel**.
   - Next to **Apache**, click the **Config** button and select `PHP (php.ini)`.
   - Press `Ctrl+F` and search for `pdo_sqlite`.
   - Remove the semicolon `;` from the beginning of these lines:
     ```ini
     extension=pdo_sqlite
     extension=sqlite3
     ```
   - Save the file and close it.
4. **Start Apache**: Click the **Start** button for Apache in the XAMPP Control Panel.
5. **Access the App**: Open your browser and go to: `http://localhost/relief/login.php`

---

### Option 2: Using PHP directly (Advanced/Lightweight)

1. **Download PHP**:
   - Go to [windows.php.net/download](https://windows.php.net/download/).
   - Download the **"VS16 x64 Thread Safe"** Zip file.
   - Extract the Zip to `C:\php`.
2. **Add PHP to Windows Path**:
   - Search for "Edit the system environment variables" in your Start Menu.
   - Click **Environment Variables**.
   - Under "System variables", find **Path**, select it, and click **Edit**.
   - Click **New** and add `C:\php`.
   - Click OK on all windows.
3. **Configure `php.ini`**:
   - Go to `C:\php` and rename `php.ini-development` to `php.ini`.
   - Open `php.ini` in Notepad.
   - Search for `extension_dir = "ext"` and remove the `;` at the start.
   - Search for `extension=pdo_sqlite` and remove the `;`.
   - Search for `extension=sqlite3` and remove the `;`.
   - Save and exit.
4. **Run the Server**:
   - Open **Command Prompt** (cmd) inside your project folder.
   - Run: `php -S localhost:8000`
5. **Access the App**: Go to `http://localhost:8000/login.php`

---

## Troubleshooting Windows Issues

- **"php is not recognized"**: You need to add `C:\php` (or your XAMPP php path) to your System Environment Variables (Step 2 in Option 2).
- **"Could not find driver"**: This means the `pdo_sqlite` extension is not enabled. Double-check your `php.ini` and make sure you removed the semicolon `;` and restarted your server.
- **"Permission Denied" (SQLite)**: Right-click the `database.sqlite` file, go to Properties > Security, and ensure the "Users" group has "Full Control" or "Modify" permissions.

---

## Initial Setup & Seeding

1. **Populate the Database**:
   Visit `http://localhost:8000/seed.php` (or `http://localhost/relief/seed.php` if using XAMPP) to fill the database with sample data.
2. **Default Credentials**:
   - **Email**: `tanim@reliefnet.com`
   - **Password**: `password123`

---

## Deployment (GitHub Pages)

This project includes a **Static Demo** version at `index.html`. 
1. Push all files to GitHub.
2. Go to **Settings > Pages** and enable deployment from the `main` branch.
3. Your live UI will be available at `https://<user>.github.io/<repo>/index.html`.
