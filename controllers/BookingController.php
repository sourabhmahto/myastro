<?php
/**
 * BookingController
 */

require_once __DIR__ . '/../models/PoojaService.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../includes/helpers.php';

class BookingController {
    /**
     * Display booking wizard form
     */
    public function form(): void {
        $poojas = PoojaService::getAll(true);
        $selectedServiceSlug = trim($_GET['service'] ?? '');
        $selectedPooja = null;

        if (!empty($selectedServiceSlug)) {
            $selectedPooja = PoojaService::getBySlug($selectedServiceSlug);
        }

        $pageTitle = "Book Online Pooja & Darshan Assistance | Omkareshwar Jyotirlinga";
        $pageDescription = "Reserve your Vedic Pooja and priority Darshan time slot at Shree Omkareshwar Jyotirlinga. Fast instant confirmation with printable booking slip.";

        require_once __DIR__ . '/../views/booking/form.php';
    }

    /**
     * Process booking form submission
     */
    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . url('booking'));
            exit;
        }

        if (!csrf_verify()) {
            set_flash('danger', 'Security token expired. Please reload the page and submit the form again.');
            header('Location: ' . url('booking'));
            exit;
        }

        $poojaServiceId = (int)($_POST['pooja_service_id'] ?? 0);
        $bookingDate = trim($_POST['booking_date'] ?? '');
        $bookingTime = trim($_POST['booking_time'] ?? '');
        $customerName = trim($_POST['customer_name'] ?? '');
        $customerPhone = trim($_POST['customer_phone'] ?? '');
        $customerEmail = trim($_POST['customer_email'] ?? '');
        $paymentMethod = trim($_POST['payment_method'] ?? 'cash_at_temple');
        $specialRequests = trim($_POST['special_requests'] ?? '');

        // Validation errors collection
        $errors = [];

        $pooja = PoojaService::getById($poojaServiceId);
        if (!$pooja || $pooja['status'] !== 'active') {
            $errors[] = 'Please select a valid and active Pooja service.';
        }

        if (empty($customerName) || mb_strlen($customerName) < 3) {
            $errors[] = 'Please enter your full name (at least 3 characters).';
        }

        if (empty($customerPhone) || !preg_match('/^[0-9+\-\s]{10,16}$/', $customerPhone)) {
            $errors[] = 'Please provide a valid 10-digit mobile number for Darshan SMS/WhatsApp updates.';
        }

        if (empty($customerEmail) || !filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please provide a valid email address to receive your printable booking pass.';
        }

        $today = date('Y-m-d');
        if (empty($bookingDate) || $bookingDate < $today) {
            $errors[] = 'Booking date must be today or a future date.';
        }

        if (empty($bookingTime)) {
            $errors[] = 'Please select a preferred darshan / pooja time slot.';
        }

        if (!empty($errors)) {
            set_flash('danger', implode('<br>', $errors));
            header('Location: ' . url('booking' . ($pooja ? '?service=' . $pooja['slug'] : '')));
            exit;
        }

        // Automatic user account association
        $userId = User::findOrCreateByContact($customerName, $customerEmail, $customerPhone);

        // Payment status assignment
        $paymentStatus = ($paymentMethod === 'online') ? 'paid' : 'cash_at_temple';

        $bookingData = [
            'user_id'          => $userId,
            'pooja_service_id' => $poojaServiceId,
            'booking_date'     => $bookingDate,
            'booking_time'     => $bookingTime,
            'customer_name'    => $customerName,
            'customer_phone'   => $customerPhone,
            'customer_email'   => $customerEmail,
            'amount'           => (float)$pooja['price'],
            'payment_status'   => $paymentStatus,
            'booking_status'   => 'confirmed',
            'special_requests' => $specialRequests
        ];

        $result = Booking::create($bookingData);

        if (!$result['success']) {
            set_flash('danger', $result['error']);
            header('Location: ' . url('booking?service=' . $pooja['slug']));
            exit;
        }

        // Success - redirect to confirmation receipt
        set_flash('success', 'Har Har Mahadev! Your pilgrimage booking has been confirmed.');
        header('Location: ' . url('booking/confirmation?booking_number=' . urlencode($result['booking_number'])));
        exit;
    }

    /**
     * Display printable confirmation receipt voucher
     */
    public function confirmation(): void {
        $bookingNumber = trim($_GET['booking_number'] ?? '');
        if (empty($bookingNumber)) {
            header('Location: ' . url('booking'));
            exit;
        }

        $booking = Booking::getByBookingNumber($bookingNumber);
        if (!$booking) {
            set_flash('danger', 'The requested booking number was not found.');
            header('Location: ' . url('booking/track'));
            exit;
        }

        $pageTitle = "Booking Confirmation #" . e($booking['booking_number']) . " | Omkareshwar Jyotirlinga";
        $pageDescription = "Official Darshan Pass and Pooja Confirmation for " . e($booking['customer_name']);

        require_once __DIR__ . '/../views/booking/confirmation.php';
    }

    /**
     * Public booking tracking portal
     */
    public function track(): void {
        $searched = false;
        $booking = null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_verify()) {
                $error = "Session expired. Please try again.";
            } else {
                $bookingNumber = trim($_POST['booking_number'] ?? '');
                $contact = trim($_POST['contact'] ?? '');

                if (empty($bookingNumber) || empty($contact)) {
                    $error = "Please provide both your Booking Reference Number and Registered Mobile/Email.";
                } else {
                    $searched = true;
                    $booking = Booking::findByNumberAndContact($bookingNumber, $contact);
                    if (!$booking) {
                        $error = "No booking found matching the provided reference number and contact information. Please double check and try again.";
                    }
                }
            }
        }

        $pageTitle = "Track Pilgrimage Booking & Darshan Pass | Omkareshwar";
        $pageDescription = "Check the live status of your Omkareshwar Jyotirlinga pooja reservation or reprint your official Darshan pass.";

        require_once __DIR__ . '/../views/booking/track.php';
    }
}
