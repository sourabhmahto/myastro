<?php
/**
 * HotelController
 */

require_once __DIR__ . '/../models/Hotel.php';

class HotelController {
    public function index(): void {
        $hotels = Hotel::getAll(true);

        $pageTitle = "Hotels & Dharamshalas in Omkareshwar | Pilgrim Accommodations";
        $pageDescription = "Find peaceful pilgrim accommodations in Omkareshwar: MP Tourism riverside resorts, serene ashrams, clean dharamshalas, and family guest houses.";

        require_once __DIR__ . '/../views/hotels/index.php';
    }

    public function show(string $slug): void {
        $hotel = Hotel::getBySlug($slug);
        if (!$hotel) {
            http_response_code(404);
            require_once __DIR__ . '/../views/404.php';
            return;
        }

        $allHotels = Hotel::getAll(true);

        $pageTitle = e($hotel['name']) . " - Omkareshwar Pilgrim Stay";
        $pageDescription = e($hotel['description']);

        require_once __DIR__ . '/../views/hotels/show.php';
    }
}
