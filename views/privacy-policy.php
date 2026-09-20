<?php
/**
 * Privacy Policy View
 */
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Privacy Policy</li>
            </ol>
        </nav>
        <h1>Privacy Policy</h1>
        <p class="mb-0">How we protect and handle devotee and pilgrimage information.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border text-slate" style="line-height:1.8;font-size:0.95rem;">
                    <h4 class="text-crimson mb-3">1. Information We Collect</h4>
                    <p>When you book a Pooja, Darshan pass, or submit an inquiry through our portal, we collect essential pilgrimage information such as your Name, Mobile Number (for WhatsApp/SMS confirmation), Email Address, Date of Visit, and optional ritual details like Gotra and Sankalp.</p>

                    <h4 class="text-crimson mb-3">2. How We Use Your Information</h4>
                    <p>Your information is used solely to:</p>
                    <ul>
                        <li>Generate and verify your official Darshan pass and booking number.</li>
                        <li>Communicate important temple updates, reporting guidelines, or time slot adjustments.</li>
                        <li>Coordinate with our certified Vedic Acharyas for personalized Sankalp ceremonies.</li>
                    </ul>

                    <h4 class="text-crimson mb-3">3. Data Security</h4>
                    <p>We implement industry-standard database security protocols, including parameterized PDO queries, secure session handling, CSRF defense, and strict access controls to safeguard devotee records against unauthorized disclosure.</p>

                    <h4 class="text-crimson mb-3">4. Third-Party Sharing</h4>
                    <p>We do not sell, rent, or lease devotee personal information to third parties. Information is only shared internally with the assigned priest coordinator facilitating your ritual on the day of darshan.</p>

                    <h4 class="text-crimson mb-3">5. Contact Regarding Privacy</h4>
                    <p>If you have any questions regarding your personal information, please contact our Seva Kendra administrator at <a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
