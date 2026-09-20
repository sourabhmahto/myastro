<?php
/**
 * GalleryController
 */

require_once __DIR__ . '/../models/Gallery.php';

class GalleryController {
    public function index(): void {
        $selectedCategory = trim($_GET['category'] ?? 'all');
        $validCategories = ['all', 'temples', 'aarti', 'river_narmada', 'parikrama', 'rituals'];
        if (!in_array($selectedCategory, $validCategories)) {
            $selectedCategory = 'all';
        }

        $galleries = Gallery::getAll($selectedCategory, true);

        $pageTitle = "Photo Gallery of Shree Omkareshwar Jyotirlinga & River Narmada";
        $pageDescription = "View high quality spiritual photos of Omkareshwar Jyotirlinga, evening Narmada Maha Aarti, ancient temples, and the sacred island Parikrama.";

        require_once __DIR__ . '/../views/gallery/index.php';
    }
}
