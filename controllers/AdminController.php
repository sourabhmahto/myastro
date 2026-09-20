<?php
/**
 * AdminController
 * Central Administrative Operations & Content Management
 */

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/PoojaService.php';
require_once __DIR__ . '/../models/Temple.php';
require_once __DIR__ . '/../models/Place.php';
require_once __DIR__ . '/../models/Hotel.php';
require_once __DIR__ . '/../models/Gallery.php';
require_once __DIR__ . '/../models/BlogPost.php';
require_once __DIR__ . '/../models/ContactMessage.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Admin.php';

class AdminController {
    /**
     * Admin login page and submission handler
     */
    public function login(): void {
        if (Auth::checkAdmin()) {
            header('Location: ' . url('admin'));
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verify()) {
                $error = 'Security session expired. Please reload and try again.';
            } else {
                $email = trim($_POST['email'] ?? '');
                $password = trim($_POST['password'] ?? '');

                if (empty($email) || empty($password)) {
                    $error = 'Please enter both administrator email and password.';
                } else {
                    $result = Auth::attemptAdmin($email, $password);
                    if ($result['success']) {
                        set_flash('success', 'Welcome back, ' . e($result['admin']['name']) . '!');
                        header('Location: ' . url('admin'));
                        exit;
                    } else {
                        $error = $result['error'];
                    }
                }
            }
        }

        $pageTitle = "Administrator Sign In | Omkareshwar Portal";
        require_once __DIR__ . '/../admin/views/login.php';
    }

    /**
     * Admin logout handler
     */
    public function logout(): void {
        Auth::logoutAdmin();
        set_flash('info', 'You have been securely logged out.');
        header('Location: ' . url('admin/login'));
        exit;
    }

    /**
     * Dashboard Overview
     */
    public function dashboard(): void {
        Auth::requireAdmin();

        $bookingStats = Booking::getStats();
        $recentBookings = Booking::getAll(['limit' => 6]);
        $recentMessages = ContactMessage::getAll();
        $unreadMessagesCount = ContactMessage::getUnreadCount();
        $totalTemples = count(Temple::getAll(false));
        $totalPoojas = count(PoojaService::getAll(false));
        $totalBlogs = count(BlogPost::getAll(false));

        $pageTitle = "Dashboard Overview | Admin Panel";
        require_once __DIR__ . '/../admin/views/dashboard.php';
    }

    /**
     * Manage Bookings
     */
    public function bookings(): void {
        Auth::requireAdmin();

        // Handle quick status update
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
            if (!csrf_verify()) {
                set_flash('danger', 'Security validation failed.');
            } else {
                $bookingId = (int)($_POST['booking_id'] ?? 0);
                $bookingStatus = trim($_POST['booking_status'] ?? '');
                $paymentStatus = trim($_POST['payment_status'] ?? '');

                if ($bookingId > 0 && in_array($bookingStatus, ['confirmed', 'pending', 'completed', 'cancelled'])) {
                    Booking::updateStatus($bookingId, $bookingStatus, $paymentStatus ?: null);
                    set_flash('success', 'Booking status updated successfully.');
                }
            }
            header('Location: ' . url('admin/bookings'));
            exit;
        }

        $filters = [
            'status' => trim($_GET['status'] ?? ''),
            'date'   => trim($_GET['date'] ?? ''),
            'search' => trim($_GET['search'] ?? '')
        ];

        $bookings = Booking::getAll($filters);
        $bookingStats = Booking::getStats();

        $pageTitle = "Manage Pilgrimage Bookings | Admin";
        require_once __DIR__ . '/../admin/views/bookings/index.php';
    }

    /**
     * View Booking Detail
     */
    public function bookingView(int $id): void {
        Auth::requireAdmin();

        $booking = Booking::getById($id);
        if (!$booking) {
            set_flash('danger', 'Booking record not found.');
            header('Location: ' . url('admin/bookings'));
            exit;
        }

        $pageTitle = "Booking #" . e($booking['booking_number']) . " Details | Admin";
        require_once __DIR__ . '/../admin/views/bookings/view.php';
    }

    /**
     * Manage Pooja Services (List & Actions)
     */
    public function poojas(): void {
        Auth::requireAdmin();

        // Handle Delete
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if (csrf_verify($_GET['token'] ?? '')) {
                PoojaService::delete($id);
                set_flash('success', 'Pooja ritual service removed successfully.');
            } else {
                set_flash('danger', 'Invalid security token.');
            }
            header('Location: ' . url('admin/poojas'));
            exit;
        }

        $poojas = PoojaService::getAll(false);
        $pageTitle = "Manage Pooja Services | Admin";
        require_once __DIR__ . '/../admin/views/poojas/index.php';
    }

    /**
     * Create or Edit Pooja Service
     */
    public function poojaForm(?int $id = null): void {
        Auth::requireAdmin();

        $pooja = $id ? PoojaService::getById($id) : null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verify()) {
                $error = 'Security session expired. Please submit again.';
            } else {
                $name = trim($_POST['name'] ?? '');
                $slug = trim($_POST['slug'] ?? '') ?: slugify($name);
                $description = trim($_POST['description'] ?? '');
                $benefits = trim($_POST['benefits'] ?? '');
                $samagri = trim($_POST['samagri_included'] ?? '');
                $price = (float)($_POST['price'] ?? 0);
                $duration = trim($_POST['duration'] ?? '45 mins');
                $status = trim($_POST['status'] ?? 'active');

                // Handle optional image upload
                $imageFilename = $pooja['image'] ?? null;
                if (!empty($_FILES['image']['name'])) {
                    $uploadResult = handle_file_upload($_FILES['image']);
                    if ($uploadResult['success'] && $uploadResult['filename']) {
                        $imageFilename = $uploadResult['filename'];
                    } elseif (!$uploadResult['success']) {
                        $error = $uploadResult['error'];
                    }
                }

                if (!$error) {
                    $data = [
                        'name' => $name,
                        'slug' => $slug,
                        'description' => $description,
                        'benefits' => $benefits,
                        'samagri_included' => $samagri,
                        'price' => $price,
                        'duration' => $duration,
                        'image' => $imageFilename,
                        'status' => $status
                    ];

                    if ($id) {
                        PoojaService::update($id, $data);
                        set_flash('success', 'Pooja service updated successfully.');
                    } else {
                        PoojaService::create($data);
                        set_flash('success', 'New Pooja service added successfully.');
                    }
                    header('Location: ' . url('admin/poojas'));
                    exit;
                }
            }
        }

        $pageTitle = ($id ? "Edit Pooja Service" : "Add New Pooja Service") . " | Admin";
        require_once __DIR__ . '/../admin/views/poojas/form.php';
    }

    /**
     * Manage Temples
     */
    public function temples(): void {
        Auth::requireAdmin();

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if (csrf_verify($_GET['token'] ?? '')) {
                Temple::delete($id);
                set_flash('success', 'Temple record deleted successfully.');
            } else {
                set_flash('danger', 'Invalid security token.');
            }
            header('Location: ' . url('admin/temples'));
            exit;
        }

        $temples = Temple::getAll(false);
        $pageTitle = "Manage Temples & Sanctums | Admin";
        require_once __DIR__ . '/../admin/views/temples/index.php';
    }

    /**
     * Create or Edit Temple
     */
    public function templeForm(?int $id = null): void {
        Auth::requireAdmin();

        $temple = $id ? Temple::getById($id) : null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verify()) {
                $error = 'Security session expired. Please try again.';
            } else {
                $name = trim($_POST['name'] ?? '');
                $slug = trim($_POST['slug'] ?? '') ?: slugify($name);
                $shortDesc = trim($_POST['short_description'] ?? '');
                $description = trim($_POST['description'] ?? '');
                $address = trim($_POST['address'] ?? '');
                $latitude = trim($_POST['latitude'] ?? '');
                $longitude = trim($_POST['longitude'] ?? '');
                $openingTime = trim($_POST['opening_time'] ?? '05:00:00');
                $closingTime = trim($_POST['closing_time'] ?? '21:30:00');
                $status = trim($_POST['status'] ?? 'active');

                $imageFilename = $temple['featured_image'] ?? null;
                if (!empty($_FILES['featured_image']['name'])) {
                    $uploadResult = handle_file_upload($_FILES['featured_image']);
                    if ($uploadResult['success'] && $uploadResult['filename']) {
                        $imageFilename = $uploadResult['filename'];
                    } elseif (!$uploadResult['success']) {
                        $error = $uploadResult['error'];
                    }
                }

                if (!$error) {
                    $data = [
                        'name' => $name,
                        'slug' => $slug,
                        'short_description' => $shortDesc,
                        'description' => $description,
                        'address' => $address,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'opening_time' => $openingTime,
                        'closing_time' => $closingTime,
                        'featured_image' => $imageFilename,
                        'status' => $status
                    ];

                    if ($id) {
                        Temple::update($id, $data);
                        set_flash('success', 'Temple record updated successfully.');
                    } else {
                        Temple::create($data);
                        set_flash('success', 'New temple added successfully.');
                    }
                    header('Location: ' . url('admin/temples'));
                    exit;
                }
            }
        }

        $pageTitle = ($id ? "Edit Temple" : "Add New Temple") . " | Admin";
        require_once __DIR__ . '/../admin/views/temples/form.php';
    }

    /**
     * Manage Places
     */
    public function places(): void {
        Auth::requireAdmin();

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if (csrf_verify($_GET['token'] ?? '')) {
                Place::delete($id);
                set_flash('success', 'Place removed successfully.');
            }
            header('Location: ' . url('admin/places'));
            exit;
        }

        $places = Place::getAll(false);
        $pageTitle = "Manage Places & Attractions | Admin";
        require_once __DIR__ . '/../admin/views/places/index.php';
    }

    /**
     * Create or Edit Place
     */
    public function placeForm(?int $id = null): void {
        Auth::requireAdmin();

        $place = $id ? Place::getById($id) : null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verify()) {
                $error = 'Security session expired.';
            } else {
                $name = trim($_POST['name'] ?? '');
                $slug = trim($_POST['slug'] ?? '') ?: slugify($name);
                $description = trim($_POST['description'] ?? '');
                $location = trim($_POST['location'] ?? '');
                $distance = trim($_POST['distance_from_temple'] ?? 'Nearby');
                $status = trim($_POST['status'] ?? 'active');

                $imageFilename = $place['image'] ?? null;
                if (!empty($_FILES['image']['name'])) {
                    $uploadResult = handle_file_upload($_FILES['image']);
                    if ($uploadResult['success'] && $uploadResult['filename']) {
                        $imageFilename = $uploadResult['filename'];
                    }
                }

                $data = [
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $description,
                    'location' => $location,
                    'distance_from_temple' => $distance,
                    'image' => $imageFilename,
                    'status' => $status
                ];

                if ($id) {
                    Place::update($id, $data);
                    set_flash('success', 'Place details updated.');
                } else {
                    Place::create($data);
                    set_flash('success', 'New place added.');
                }
                header('Location: ' . url('admin/places'));
                exit;
            }
        }

        $pageTitle = ($id ? "Edit Place" : "Add New Place") . " | Admin";
        require_once __DIR__ . '/../admin/views/places/form.php';
    }

    /**
     * Manage Hotels
     */
    public function hotels(): void {
        Auth::requireAdmin();

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if (csrf_verify($_GET['token'] ?? '')) {
                Hotel::delete($id);
                set_flash('success', 'Accommodation removed.');
            }
            header('Location: ' . url('admin/hotels'));
            exit;
        }

        $hotels = Hotel::getAll(false);
        $pageTitle = "Manage Hotels & Ashrams | Admin";
        require_once __DIR__ . '/../admin/views/hotels/index.php';
    }

    /**
     * Create or Edit Hotel
     */
    public function hotelForm(?int $id = null): void {
        Auth::requireAdmin();

        $hotel = $id ? Hotel::getById($id) : null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verify()) {
                $error = 'Security session expired.';
            } else {
                $name = trim($_POST['name'] ?? '');
                $slug = trim($_POST['slug'] ?? '') ?: slugify($name);
                $description = trim($_POST['description'] ?? '');
                $address = trim($_POST['address'] ?? '');
                $phone = trim($_POST['phone'] ?? '');
                $priceRange = trim($_POST['price_range'] ?? '₹800 - ₹2,500 / night');
                $amenities = trim($_POST['amenities'] ?? '');
                $status = trim($_POST['status'] ?? 'active');

                $imageFilename = $hotel['image'] ?? null;
                if (!empty($_FILES['image']['name'])) {
                    $uploadResult = handle_file_upload($_FILES['image']);
                    if ($uploadResult['success'] && $uploadResult['filename']) {
                        $imageFilename = $uploadResult['filename'];
                    }
                }

                $data = [
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $description,
                    'address' => $address,
                    'phone' => $phone,
                    'price_range' => $priceRange,
                    'amenities' => $amenities,
                    'image' => $imageFilename,
                    'status' => $status
                ];

                if ($id) {
                    Hotel::update($id, $data);
                    set_flash('success', 'Hotel details updated.');
                } else {
                    Hotel::create($data);
                    set_flash('success', 'New hotel/ashram added.');
                }
                header('Location: ' . url('admin/hotels'));
                exit;
            }
        }

        $pageTitle = ($id ? "Edit Hotel" : "Add New Hotel") . " | Admin";
        require_once __DIR__ . '/../admin/views/hotels/form.php';
    }

    /**
     * Manage Photo Gallery
     */
    public function gallery(): void {
        Auth::requireAdmin();

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if (csrf_verify($_GET['token'] ?? '')) {
                Gallery::delete($id);
                set_flash('success', 'Gallery photo deleted.');
            }
            header('Location: ' . url('admin/gallery'));
            exit;
        }

        $galleries = Gallery::getAll('all', false);
        $pageTitle = "Manage Photo Gallery | Admin";
        require_once __DIR__ . '/../admin/views/gallery/index.php';
    }

    /**
     * Create or Edit Gallery Item
     */
    public function galleryForm(?int $id = null): void {
        Auth::requireAdmin();

        $item = $id ? Gallery::getById($id) : null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verify()) {
                $error = 'Security session expired.';
            } else {
                $title = trim($_POST['title'] ?? '');
                $altText = trim($_POST['alt_text'] ?? '') ?: $title;
                $category = trim($_POST['category'] ?? 'temples');
                $status = trim($_POST['status'] ?? 'active');

                $imageFilename = $item['image'] ?? null;
                if (!empty($_FILES['image']['name'])) {
                    $uploadResult = handle_file_upload($_FILES['image']);
                    if ($uploadResult['success'] && $uploadResult['filename']) {
                        $imageFilename = $uploadResult['filename'];
                    } elseif (!$uploadResult['success']) {
                        $error = $uploadResult['error'];
                    }
                } elseif (!$id) {
                    $imageFilename = 'gallery-temple-sunrise.svg'; // Default placeholder
                }

                if (!$error) {
                    $data = [
                        'title' => $title,
                        'alt_text' => $altText,
                        'category' => $category,
                        'image' => $imageFilename,
                        'status' => $status
                    ];

                    if ($id) {
                        Gallery::update($id, $data);
                        set_flash('success', 'Gallery photo updated.');
                    } else {
                        Gallery::create($data);
                        set_flash('success', 'Photo added to gallery.');
                    }
                    header('Location: ' . url('admin/gallery'));
                    exit;
                }
            }
        }

        $pageTitle = ($id ? "Edit Gallery Photo" : "Add Photo to Gallery") . " | Admin";
        require_once __DIR__ . '/../admin/views/gallery/form.php';
    }

    /**
     * Manage Blog Articles
     */
    public function blogs(): void {
        Auth::requireAdmin();

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if (csrf_verify($_GET['token'] ?? '')) {
                BlogPost::delete($id);
                set_flash('success', 'Article deleted.');
            }
            header('Location: ' . url('admin/blogs'));
            exit;
        }

        $posts = BlogPost::getAll(false);
        $pageTitle = "Manage Blog Articles | Admin";
        require_once __DIR__ . '/../admin/views/blogs/index.php';
    }

    /**
     * Create or Edit Blog Post
     */
    public function blogForm(?int $id = null): void {
        Auth::requireAdmin();

        $post = $id ? BlogPost::getById($id) : null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verify()) {
                $error = 'Security session expired.';
            } else {
                $title = trim($_POST['title'] ?? '');
                $slug = trim($_POST['slug'] ?? '') ?: slugify($title);
                $excerpt = trim($_POST['excerpt'] ?? '');
                $content = trim($_POST['content'] ?? '');
                $status = trim($_POST['status'] ?? 'published');

                $imageFilename = $post['featured_image'] ?? null;
                if (!empty($_FILES['featured_image']['name'])) {
                    $uploadResult = handle_file_upload($_FILES['featured_image']);
                    if ($uploadResult['success'] && $uploadResult['filename']) {
                        $imageFilename = $uploadResult['filename'];
                    }
                }

                $adminUser = Auth::user();
                $data = [
                    'title' => $title,
                    'slug' => $slug,
                    'excerpt' => $excerpt,
                    'content' => $content,
                    'featured_image' => $imageFilename,
                    'author_id' => $adminUser['id'] ?? 1,
                    'status' => $status
                ];

                if ($id) {
                    BlogPost::update($id, $data);
                    set_flash('success', 'Article updated.');
                } else {
                    BlogPost::create($data);
                    set_flash('success', 'New article published.');
                }
                header('Location: ' . url('admin/blogs'));
                exit;
            }
        }

        $pageTitle = ($id ? "Edit Article" : "Write New Article") . " | Admin";
        require_once __DIR__ . '/../admin/views/blogs/form.php';
    }

    /**
     * Manage Inquiries / Contact Messages
     */
    public function messages(): void {
        Auth::requireAdmin();

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if (csrf_verify($_GET['token'] ?? '')) {
                ContactMessage::delete($id);
                set_flash('success', 'Inquiry deleted.');
            }
            header('Location: ' . url('admin/messages'));
            exit;
        }

        if (isset($_GET['action']) && $_GET['action'] === 'status' && isset($_GET['id'], $_GET['set'])) {
            $id = (int)$_GET['id'];
            $newStatus = trim($_GET['set']);
            if (in_array($newStatus, ['unread', 'read', 'replied'])) {
                ContactMessage::updateStatus($id, $newStatus);
                set_flash('success', 'Message marked as ' . $newStatus . '.');
            }
            header('Location: ' . url('admin/messages'));
            exit;
        }

        $messages = ContactMessage::getAll();
        $pageTitle = "Contact Inquiries Inbox | Admin";
        require_once __DIR__ . '/../admin/views/messages/index.php';
    }

    /**
     * Manage Devotees & Admin Staff
     */
    public function users(): void {
        Auth::requireAdmin();

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_admin') {
            if (!csrf_verify()) {
                $error = 'Security session expired.';
            } else {
                $name = trim($_POST['name'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $password = trim($_POST['password'] ?? '');
                $role = trim($_POST['role'] ?? 'manager');

                if (empty($name) || empty($email) || mb_strlen($password) < 6) {
                    set_flash('danger', 'Please enter a valid name, email, and minimum 6-character password.');
                } else {
                    Admin::create([
                        'name' => $name,
                        'email' => $email,
                        'password' => $password,
                        'role' => $role
                    ]);
                    set_flash('success', 'New administrator account created.');
                }
            }
            header('Location: ' . url('admin/users'));
            exit;
        }

        $admins = Admin::getAll();
        $users = User::getAll();

        $pageTitle = "Devotees & Administrators | Admin";
        require_once __DIR__ . '/../admin/views/users/index.php';
    }
}
