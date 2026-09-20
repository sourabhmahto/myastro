<?php
/**
 * TempleController
 */

require_once __DIR__ . '/../models/Temple.php';
require_once __DIR__ . '/../models/PoojaService.php';

class TempleController {
    public function index(): void {
        $temples = Temple::getAll(true);

        $pageTitle = "Sacred Temples of Omkareshwar & Mandhata | Jyotirlinga Darshan";
        $pageDescription = "Explore the sacred shrines of Omkareshwar, including Shree Omkareshwar Jyotirlinga, Mamleshwar Amareshwar, Siddhanath Temple, and Gauri Somnath.";

        require_once __DIR__ . '/../views/temples/index.php';
    }

    public function show(string $slug): void {
        $temple = Temple::getBySlug($slug);
        if (!$temple) {
            http_response_code(404);
            require_once __DIR__ . '/../views/404.php';
            return;
        }

        $allTemples = Temple::getAll(true);
        $relatedPoojas = PoojaService::getAll(true);

        $pageTitle = e($temple['name']) . " - Darshan Timings, History & Significance";
        $pageDescription = e($temple['short_description']);

        require_once __DIR__ . '/../views/temples/show.php';
    }
}
