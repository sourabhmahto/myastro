<?php
/**
 * HomeController
 */

require_once __DIR__ . '/../models/Temple.php';
require_once __DIR__ . '/../models/PoojaService.php';
require_once __DIR__ . '/../models/Place.php';
require_once __DIR__ . '/../models/Hotel.php';
require_once __DIR__ . '/../models/BlogPost.php';
require_once __DIR__ . '/../models/Gallery.php';

class HomeController {
    public function index(): void {
        $temples = Temple::getAll(true);
        $poojas = PoojaService::getAll(true);
        $places = Place::getAll(true);
        $hotels = Hotel::getAll(true);
        $blogs = BlogPost::getRecent(3);
        $galleries = Gallery::getAll('all', true);

        // Page SEO
        $pageTitle = "Shree Omkareshwar Jyotirlinga Darshan & Yatra Seva | Official Pilgrimage Portal";
        $pageDescription = "Plan your sacred pilgrimage to Shree Omkareshwar Jyotirlinga. Book Vedic Rudrabhishek, Narmada Aarti, priority Darshan assistance, verified ashrams, and explore sacred Mandhata island.";

        require_once __DIR__ . '/../views/home.php';
    }
}
