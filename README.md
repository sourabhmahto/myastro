# Shree Omkareshwar Jyotirlinga — Pilgrimage & Temple Tourism Portal

A complete, production-ready, standalone **PHP 8.2+ & MySQL** web portal for Shree Omkareshwar Jyotirlinga pilgrimage and tourism services. 

Features an original spiritual visual identity (warm temple crimson, sacred marigold gold, and holy Narmada teal), interactive online booking engine with duplicate prevention and printable pass vouchers, administrative dashboard with full CRUD capabilities, and 100% compatibility with standard GoDaddy cPanel shared Linux hosting.

---

## Key Features

### 1. Devotee & Public Portal
- **Devotional Homepage**: Sacred Om-themed hero banner, live Darshan & Aarti daily schedule, popular Pooja rituals catalog, Mandhata island Parikrama guide, pilgrim accommodations, photo gallery with lightbox, latest yatra articles, and interactive FAQ.
- **Online Pooja Booking Engine**: Multi-step wizard allowing devotees to select Vedic rituals, choose pilgrimage dates & auspicious time slots, provide Sankalp/Gotra information, receive an instant unique booking reference code (e.g. `OMK-2026-8491`), and print/save an official Darshan pass.
- **Booking Duplicate Prevention**: Prevents double-booking for the same devotee contact on the same date and time slot.
- **Self-Service Booking Tracker (`/booking/track`)**: Allows pilgrims to verify booking status and reprint vouchers anytime using their booking number and registered phone/email.
- **Comprehensive Pilgrimage Guides**: Detailed information for Omkareshwar Jyotirlinga, Mamleshwar Amareshwar, Siddhanath Temple, Narmada Sangam, Kajal Rani Cave, and riverside Ashrams.
- **SEO & Social Sharing Ready**: Open Graph meta tags, Twitter Cards, JSON-LD Schema.org (`TouristAttraction`, `PlaceOfWorship`), XML Sitemap (`/sitemap.xml`), and WhatsApp instant sharing.

### 2. Administrative Panel (`/admin`)
- **Secure Authentication**: Protected admin login using `password_hash()` and `password_verify()` with brute-force delays and CSRF tokens.
- **Live KPI Dashboard**: Real-time counters for Total Bookings, Confirmed Darshans, Pending Inquiries, and Total Seva Revenue (₹).
- **Manage Bookings**: Filter by status/date/search, view devotee Sankalp details, update statuses (`Pending`, `Confirmed`, `Completed`, `Cancelled`), and print receipts.
- **Manage Pooja Services**: Add, edit, price, set duration, describe rituals, and toggle active status.
- **Manage Temples & Shrines**: Manage opening/closing timings, coordinates, descriptions, and guidelines.
- **Manage Places & Accommodations**: Full CRUD for attractions, ashrams, hotels, tariffs, and direct contact numbers.
- **Photo Gallery & Blog Manager**: Categorized photo uploads and full markdown/HTML rich yatra guides.
- **Inquiry Inbox**: Receive devotee inquiries with 1-click status toggles and direct email reply links.
- **Admin User Management**: Add administrators and view registered devotee accounts.

---

## Technology Stack
- **Backend:** PHP 8.2+ (Pure PDO, Prepared Statements, Zero external dependencies)
- **Database:** MySQL 8.0+ / MariaDB 10.4+
- **Frontend:** HTML5, CSS3, Bootstrap 5.3, Vanilla JavaScript
- **Icons & Fonts:** Bootstrap Icons, Google Fonts (*Cinzel*, *Poppins*, *Noto Sans Devanagari*)
- **Graphics:** 100% Original Vector SVGs (Custom Logo, Favicon, Devotional category graphics)
- **Hosting Compatibility:** Standard GoDaddy Linux / cPanel Apache shared hosting (`public_html`)

---

## Quick Start & Installation

1. **Import Database:**
   - In phpMyAdmin, create a database and import `database/schema.sql`, followed by `database/seed.sql`.
2. **Configure Database Credentials:**
   - Edit `config/config.php` with your database name, user, and password.
3. **Deploy:**
   - Upload all files to your web root (`public_html`).
4. **Default Admin Login:**
   - **URL:** `https://yourdomain.com/admin`
   - **Email:** `admin@omkareshwar.local`
   - **Password:** `Admin@Omkar2026!`

For step-by-step cPanel instructions, please see [DEPLOYMENT.md](DEPLOYMENT.md).

---

## License & Commercial Use
This codebase, design, and content are 100% original and free from copyrighted reference materials, making it suitable for commercial production use.
# myastro
# myastro
