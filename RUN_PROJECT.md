# Omkareshwar Jyotirlinga Pooja & Astro Seva — Project Execution Guide

A modern, mobile-first **Vue 3 application** (with Tailwind CSS 3.4, Pinia reactivity, Lucide icons, and bilingual Hindi/English localization) backed by clean **PHP PDO REST API endpoints** and MySQL database.

---

## 1. Quick Local Execution (Zero-Build / Instant Run)

This project is engineered to run **instantly** without needing complex build setups or Node.js compilers!

### Option A: Using PHP Built-in Web Server (Recommended & Fastest)
1. Open PowerShell or Terminal inside `d:\AppShyam`:
   ```bash
   php -S localhost:8000
   ```
2. Open your browser and navigate to:
   - **Frontend App:** [http://localhost:8000](http://localhost:8000)
   - **Admin Portal:** [http://localhost:8000/#/admin](http://localhost:8000/#/admin) (or click the Admin Shield icon in the top header)
   - **Default Admin Login:**
     - **Email:** `admin@omkareshwar.local`
     - **Password:** `Admin@Omkar2026!`

### Option B: Using XAMPP / WAMP / Apache
1. Copy or link this folder `d:\AppShyam` to `htdocs/AppShyam`.
2. Start Apache and MySQL in XAMPP.
3. Open: [http://localhost/AppShyam](http://localhost/AppShyam)

---

## 2. Database Setup & Non-Destructive Migration

1. In phpMyAdmin or MySQL CLI, select your database (e.g. `omkareshwar_db`).
2. Run the non-destructive schema script:
   - **File:** `database/migration_v2.sql`
3. Run the bilingual seed data script:
   - **File:** `database/seed_v2.sql`
4. Update your database connection in `api/config.php` (and `config/config.php`):
   ```php
   define('API_DB_HOST', 'localhost');
   define('API_DB_NAME', 'omkareshwar_db');
   define('API_DB_USER', 'root');
   define('API_DB_PASS', '');
   ```

---

## 3. Key Architecture & Features

### 🌟 1. 2026 Sacred UI/UX Design System
- **Color Palette:** Sacred Saffron (`#E06D14`), Temple Maroon (`#7A1C1C`), Warm Cream Surface (`#FDFBF7`), Midnight Temple Slate (`#111827`).
- **Divine Typography:** Cinzel / Rozha One / Noto Sans Devanagari headers with Outfit sans-serif body.
- **Mobile-First Touch Architecture:**
  - Sticky blurred bottom mobile navigation bar: `[Home, Pooja Seva, Adhyatmik Blogs, Contact Shastri]`.
  - Floating WhatsApp action button pinned above bottom navigation with dynamic custom message builder.

### 🌐 2. Bilingual Support (Hindi & English)
- 1-Click language toggle in the top announcement bar and main navigation.
- Automatically persists in `localStorage` and reactive state.
- Dynamic fallback: fetches Hindi (`name_hi`, `description_hi`, `title_hi`) and falls back cleanly to English if Hindi text is absent.

### 🪔 3. Dynamic Pooja Catalog & Variation Selector
- Category filter pills (All, Pooja, Astro, Vastu, Sanskar) ordered strictly by `categories.display_order`.
- Pooja cards ordered strictly by `poojas.display_order`.
- Dynamic Variation Modal with multiple priest & samagri packages (Simple, Standard, 5 Priests + Hawan).
- 1-Click WhatsApp Enquiry button pre-populating the exact pooja details.

### 📝 4. Sacred Sankalp Booking Flow
- Step-by-step form: Devotee Name, Mobile, WhatsApp, Gotra, Nakshatra, Preferred Date, Special Wishes.
- Saves record directly into database (`devotees_bookings`).
- Automatically opens WhatsApp with a formatted, ready-to-send Sankalp message for Shastri Ji.

### 📊 5. Admin Dashboard & Devotee CRM
- **Devotee CRM Table:** View devotee bookings with Gotra, preferred date, and status.
- **1-Click Actions:**
  - 📞 **"Call Devotee"** (`tel:`)
  - 💬 **"WhatsApp Message"** with personalized pre-filled greeting:
    *"हर हर महादेव [Devotee Name] जी! Regarding your [Pooja Name] booking at Omkareshwar Jyotirlinga, Shastri Ji is preparing your Sankalp. Please share your Gotra and family member names."*
- **Status Updater:** `Pending` ➔ `Sankalp Done` ➔ `Prasad Sent` ➔ `Completed` + internal admin notes.
- **Pooja & Category Manager:** Numerical display order sorting (`display_order`) controlling exactly what appears first on the frontend.
- **Adhyatmik Blog Publisher:** Bilingual daily spiritual updates.

---

## 4. API Endpoints Reference

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/categories.php` | Get all active categories ordered by `display_order` |
| `GET` | `/api/poojas.php` | Get poojas with nested variations and starting price |
| `GET` | `/api/blogs.php` | Get daily spiritual blogs & panchang updates |
| `POST` | `/api/bookings.php` | Submit devotee Sankalp booking & generate WhatsApp link |
| `GET` | `/api/bookings.php` | Devotee CRM list (Admin token required) |
| `PUT` | `/api/bookings.php?id={id}` | Update booking status & admin notes |
| `POST` | `/api/auth.php?action=login` | Admin authentication (`admin@omkareshwar.local`) |
| `GET` | `/api/stats.php` | Admin KPI dashboard metrics |
| `POST` | `/api/upload.php` | Image upload endpoint |

---

## 5. Deployment on GoDaddy cPanel Linux Shared Hosting
1. Upload all files to `public_html`.
2. Import `database/migration_v2.sql` and `database/seed_v2.sql` in cPanel phpMyAdmin.
3. Update `api/config.php` with cPanel database credentials.
4. Portal is immediately live at `https://yourdomain.com/`!
