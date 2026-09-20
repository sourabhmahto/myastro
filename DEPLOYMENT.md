# GoDaddy cPanel & Linux Shared Hosting Deployment Guide

This portal is built using native **PHP 8.2+ PDO** and **MySQL 8.0 / MariaDB** with **zero server-side build steps**. You do **NOT** require Node.js, Docker, Redis, Python, Composer, or VPS-only services.

---

## Quick Summary of Folder Deployment

All files in this repository are designed to be deployed directly inside your web server's public document root (typically `/public_html/` on GoDaddy cPanel):

```
public_html/
├── .htaccess                 <-- Handles routing & security
├── index.php                 <-- Front controller
├── robots.txt
├── sitemap.xml
├── config/
│   ├── config.php            <-- Database & site credentials
│   └── database.php
├── includes/
├── controllers/
├── models/
├── views/
├── admin/                    <-- Admin portal (/admin)
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── uploads/                  <-- Uploads directory (auto-secured)
└── database/                 <-- SQL files (import via phpMyAdmin)
    ├── schema.sql
    └── seed.sql
```

---

## Step-by-Step GoDaddy cPanel Setup

### Step 1: Create MySQL Database & User in cPanel
1. Log in to your **GoDaddy cPanel Dashboard**.
2. Under the **Databases** section, click **MySQL® Databases** (or *MySQL Database Wizard*).
3. **Create New Database**: E.g., `cpaneluser_omkardb`. Click *Create Database*.
4. **Create New User**: E.g., `cpaneluser_dbuser` and generate a strong password. Click *Create User*.
5. **Add User to Database**: Select the user and database, click *Add*, check **ALL PRIVILEGES**, and click *Make Changes*.

---

### Step 2: Import Database via phpMyAdmin
1. In cPanel, click **phpMyAdmin**.
2. Select your newly created database (`cpaneluser_omkardb`) from the left sidebar.
3. Click the **Import** tab on the top menu.
4. Click **Choose File**, select `database/schema.sql`, and click **Go** / **Import**.
5. After schema import succeeds, click **Import** again, select `database/seed.sql`, and click **Go** / **Import**.

---

### Step 3: Update `config/config.php`
Open `config/config.php` via cPanel File Manager Code Editor (or in your local editor before uploading):

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'cpaneluser_omkardb');       // Your cPanel DB name
define('DB_USER', 'cpaneluser_dbuser');       // Your cPanel DB username
define('DB_PASSWORD', 'YourStrongPassword');  // Your cPanel DB password
```

*(Optional)* You can also update the contact phone numbers, email, and Google Maps embed URL inside `config/config.php`.

---

### Step 4: Upload Application Files to `public_html`
1. In cPanel, open **File Manager**.
2. Navigate into the **`public_html`** directory.
3. If deploying to your primary domain, upload the project files directly into `public_html`. (If deploying to a subdomain or subfolder like `public_html/omkareshwar/`, upload files there).
4. Ensure `.htaccess` is uploaded and visible (enable "Show Hidden Files (dotfiles)" in File Manager Settings).
5. Ensure the `uploads/` directory has write permissions (chmod `0755` or `0777`).

---

### Step 5: Verify Deployment & Admin Login

#### 1. Public Portal
Visit your domain (e.g. `https://yourdomain.com/`):
- Verify homepage renders hero, aarti schedule, pooja catalog, parikrama guide, and accommodations.
- Test online booking flow: select ritual -> choose date/time -> fill details -> receive booking pass.
- Test booking tracking: verify search by booking reference number (e.g. `OMK-2026-8491`).

#### 2. Administrative Dashboard
Visit `https://yourdomain.com/admin`:
- **Default Email:** `admin@omkareshwar.local`
- **Default Password:** `Admin@Omkar2026!`
- *(Upon first login, you can change your password or add new administrators under the Devotees & Admins module).*

---

## Security Verification Checklist
- [x] PDO prepared statements protect all queries against SQL injection.
- [x] Form submissions require valid CSRF security tokens.
- [x] `uploads/.htaccess` disables script execution within upload directories.
- [x] Passwords use PHP `password_hash()` and `password_verify()`.
- [x] Input data is sanitized and HTML escaped (`htmlspecialchars` via `e()`).
- [x] Sessions are hardened with `httponly`, `use_only_cookies`, and `samesite=Lax`.
