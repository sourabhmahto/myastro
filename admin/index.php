<?php
/**
 * Admin Panel Front Controller & Dispatcher
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../controllers/AdminController.php';

$controller = new AdminController();

// Parse admin route
$action = trim($_GET['action'] ?? 'dashboard');
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($action) {
    case 'login':
        $controller->login();
        break;

    case 'logout':
        $controller->logout();
        break;

    case 'dashboard':
        $controller->dashboard();
        break;

    case 'bookings':
        $controller->bookings();
        break;

    case 'booking_view':
        if ($id) {
            $controller->bookingView($id);
        } else {
            $controller->bookings();
        }
        break;

    case 'poojas':
        $controller->poojas();
        break;

    case 'pooja_form':
        $controller->poojaForm($id);
        break;

    case 'temples':
        $controller->temples();
        break;

    case 'temple_form':
        $controller->templeForm($id);
        break;

    case 'places':
        $controller->places();
        break;

    case 'place_form':
        $controller->placeForm($id);
        break;

    case 'hotels':
        $controller->hotels();
        break;

    case 'hotel_form':
        $controller->hotelForm($id);
        break;

    case 'gallery':
        $controller->gallery();
        break;

    case 'gallery_form':
        $controller->galleryForm($id);
        break;

    case 'blogs':
        $controller->blogs();
        break;

    case 'blog_form':
        $controller->blogForm($id);
        break;

    case 'messages':
        $controller->messages();
        break;

    case 'users':
        $controller->users();
        break;

    default:
        $controller->dashboard();
        break;
}
