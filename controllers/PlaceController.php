<?php
/**
 * PlaceController
 */

require_once __DIR__ . '/../models/Place.php';

class PlaceController {
    public function index(): void {
        $places = Place::getAll(true);

        $pageTitle = "Places to Visit in Omkareshwar | Island Parikrama & Attractions";
        $pageDescription = "Discover the holy places and sightseeing spots around Omkareshwar including Mandhata Island Parikrama, Jhula Pul, Narmada Sangam Ghat, and Kajal Rani Cave.";

        require_once __DIR__ . '/../views/places/index.php';
    }

    public function show(string $slug): void {
        $place = Place::getBySlug($slug);
        if (!$place) {
            http_response_code(404);
            require_once __DIR__ . '/../views/404.php';
            return;
        }

        $allPlaces = Place::getAll(true);

        $pageTitle = e($place['name']) . " - Omkareshwar Tourism & Pilgrimage";
        $pageDescription = e($place['description']);

        require_once __DIR__ . '/../views/places/show.php';
    }
}
