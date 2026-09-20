<?php
/**
 * PoojaController
 */

require_once __DIR__ . '/../models/PoojaService.php';

class PoojaController {
    public function index(): void {
        $poojas = PoojaService::getAll(true);

        $pageTitle = "Vedic Pooja & Darshan Services at Omkareshwar Jyotirlinga";
        $pageDescription = "Book authentic Vedic Rudrabhishek, Narmada Deep Daan, Kaal Sarp Dosh Nivaran, Bilvarchana, and VIP Darshan assistance by certified Brahmin pandits at Omkareshwar.";

        require_once __DIR__ . '/../views/pooja/index.php';
    }

    public function show(string $slug): void {
        $pooja = PoojaService::getBySlug($slug);
        if (!$pooja) {
            http_response_code(404);
            require_once __DIR__ . '/../views/404.php';
            return;
        }

        $allPoojas = PoojaService::getAll(true);

        $pageTitle = e($pooja['name']) . " - Ritual Details, Price & Online Booking";
        $pageDescription = "Book " . e($pooja['name']) . " at Omkareshwar Jyotirlinga. Vedic rituals performed with pure samagri. Duration: " . e($pooja['duration']) . ". Dakshina: " . format_currency($pooja['price']);

        require_once __DIR__ . '/../views/pooja/show.php';
    }
}
