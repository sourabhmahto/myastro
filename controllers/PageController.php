<?php
/**
 * PageController
 */

class PageController {
    public function about(): void {
        $pageTitle = "About Shree Omkareshwar Jyotirlinga | History, Puranic Legends & Geography";
        $pageDescription = "Learn the sacred history of Omkareshwar, the 4th Jyotirlinga on Mandhata island, the Om-shaped topography of river Narmada, and the legacy of Adi Shankaracharya.";

        require_once __DIR__ . '/../views/about.php';
    }

    public function faq(): void {
        $pageTitle = "Frequently Asked Questions (FAQ) | Omkareshwar Jyotirlinga Pilgrimage";
        $pageDescription = "Find answers to frequently asked questions about Omkareshwar darshan timings, online pooja booking, dress code, locker facilities, boat rides, and senior citizen assistance.";

        require_once __DIR__ . '/../views/faq.php';
    }

    public function privacy(): void {
        $pageTitle = "Privacy Policy | Shree Omkareshwar Jyotirlinga Darshan Seva";
        $pageDescription = "Privacy policy explaining how pilgrim personal details and booking information are securely protected and managed.";

        require_once __DIR__ . '/../views/privacy-policy.php';
    }

    public function terms(): void {
        $pageTitle = "Terms & Conditions | Shree Omkareshwar Jyotirlinga Darshan Seva";
        $pageDescription = "Terms and conditions for online pooja reservations, darshan coordination, cancellation guidelines, and temple decorum.";

        require_once __DIR__ . '/../views/terms-and-conditions.php';
    }

    public function notFound(): void {
        http_response_code(404);
        $pageTitle = "Page Not Found | 404 - Shree Omkareshwar Jyotirlinga";
        $pageDescription = "The page you are looking for does not exist. Please return to the homepage or check our temple guides.";

        require_once __DIR__ . '/../views/404.php';
    }
}
