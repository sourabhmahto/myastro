<?php
/**
 * ContactController
 */

require_once __DIR__ . '/../models/ContactMessage.php';
require_once __DIR__ . '/../includes/helpers.php';

class ContactController {
    public function index(): void {
        $pageTitle = "Contact Shree Omkareshwar Jyotirlinga Seva Kendra | Pilgrimage Helpline";
        $pageDescription = "Get in touch with the Omkareshwar Jyotirlinga pilgrimage assistance team. Temple office address, helpline numbers, priest coordination, and directions.";

        require_once __DIR__ . '/../views/contact.php';
    }

    public function send(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . url('contact'));
            exit;
        }

        if (!csrf_verify()) {
            set_flash('danger', 'Security token expired. Please reload and try again.');
            header('Location: ' . url('contact'));
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $message = trim($_POST['message'] ?? '');

        $errors = [];

        if (empty($name) || mb_strlen($name) < 3) {
            $errors[] = 'Please enter your full name (at least 3 characters).';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        if (empty($phone) || !preg_match('/^[0-9+\-\s]{10,16}$/', $phone)) {
            $errors[] = 'Please provide a valid 10-digit mobile number.';
        }

        if (empty($message) || mb_strlen($message) < 10) {
            $errors[] = 'Please write your message or inquiry (at least 10 characters).';
        }

        if (!empty($errors)) {
            set_flash('danger', implode('<br>', $errors));
            header('Location: ' . url('contact'));
            exit;
        }

        $saved = ContactMessage::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ]);

        if ($saved) {
            set_flash('success', 'Pranam! Your message has been received. Our temple seva coordinator will get back to you shortly.');
        } else {
            set_flash('danger', 'Unable to submit your inquiry at this moment. Please call our helpline directly.');
        }

        header('Location: ' . url('contact'));
        exit;
    }
}
