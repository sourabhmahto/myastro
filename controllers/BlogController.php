<?php
/**
 * BlogController
 */

require_once __DIR__ . '/../models/BlogPost.php';

class BlogController {
    public function index(): void {
        $posts = BlogPost::getAll(true);
        $recentPosts = BlogPost::getRecent(4);

        $pageTitle = "Omkareshwar Yatra Blog: Pilgrimage Guides, Aarti Timings & Spiritual Stories";
        $pageDescription = "Read authentic pilgrimage travel guides, darshan tips, legend of King Mandhata, Narmada Snan rules, and festival celebrations at Omkareshwar.";

        require_once __DIR__ . '/../views/blog/index.php';
    }

    public function show(string $slug): void {
        $post = BlogPost::getBySlug($slug);
        if (!$post) {
            http_response_code(404);
            require_once __DIR__ . '/../views/404.php';
            return;
        }

        $recentPosts = BlogPost::getRecent(4);

        $pageTitle = e($post['title']) . " | Omkareshwar Pilgrimage Guide";
        $pageDescription = e($post['excerpt']);

        require_once __DIR__ . '/../views/blog/show.php';
    }
}
