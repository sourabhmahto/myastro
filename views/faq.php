<?php
/**
 * FAQ View
 */
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">FAQ</li>
            </ol>
        </nav>
        <h1>Frequently Asked Questions (FAQ)</h1>
        <p class="mb-0">Everything you need to know about Omkareshwar Jyotirlinga darshan rules, pooja booking, and pilgrimage amenities.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion faq-accordion" id="fullFaq">
                    <?php
                    $allFaqs = [
                        [
                            'cat' => 'Darshan & Timings',
                            'q'   => 'What are the daily temple opening and closing timings?',
                            'a'   => 'The temple opens at 05:00 AM for Mangal Aarti. Morning darshan is available from 05:30 AM to 12:00 PM. The temple closes for Madhyahna Bhog from 12:00 PM to 01:15 PM. Afternoon darshan is open from 01:15 PM to 03:30 PM. Evening darshan resumes from 04:30 PM to 09:30 PM with Shayan Aarti concluding at 09:30 PM.'
                        ],
                        [
                            'cat' => 'Darshan & Timings',
                            'q'   => 'Why are both Omkareshwar and Mamleshwar visited together?',
                            'a'   => 'According to sacred Puranic tradition, Lord Shiva divided the Jyotirlinga into two reciprocal halves upon the prayers of the devas: Omkareshwar on the Mandhata island and Mamleshwar (Amareshwar) on the south mainland bank. Visiting both shrines is essential to complete the 4th Jyotirlinga pilgrimage.'
                        ],
                        [
                            'cat' => 'Pooja & Online Booking',
                            'q'   => 'How does online pooja booking work on this portal?',
                            'a'   => 'Select your desired pooja service (e.g. Maha Rudrabhishek, Narmada Deep Daan), pick your preferred date and time slot, enter devotee details, and submit. You will immediately receive a digital Darshan pass with a unique reference number. Show this pass at the Seva Kendra counter upon arrival.'
                        ],
                        [
                            'cat' => 'Pooja & Online Booking',
                            'q'   => 'Is samagri provided, or do devotees need to bring items?',
                            'a'   => 'All essential ritual samagri (pure cow milk, curd, honey, desi ghee, bilva leaves, gangajal/narmada jal, sandalwood, sacred thread, and prasad) is arranged and provided by our Vedic pandit coordinator. Devotees do not need to carry raw items.'
                        ],
                        [
                            'cat' => 'Dress Code & Conduct',
                            'q'   => 'What is the required dress code for entering the Garbhagriha (Sanctum)?',
                            'a'   => 'For men performing abhishek inside the inner sanctum, traditional attire (dhoti/pitambar with bare upper body) is customary. Women should wear traditional sarees or salwar suits. Western casuals such as shorts, skirts, or sleeveless clothes are strictly prohibited inside the inner sanctum.'
                        ],
                        [
                            'cat' => 'Travel & Amenities',
                            'q'   => 'How do I reach Mandhata island from the south bank?',
                            'a'   => 'Devotees can walk across the scenic pedestrian suspension bridge (Jhula Pul) or take a traditional motorboat ride across River Narmada (nominal government-regulated fare).'
                        ],
                        [
                            'cat' => 'Travel & Amenities',
                            'q'   => 'Are luggage locker and shoe stand facilities available?',
                            'a'   => 'Yes, secure shoe keeping stands and luggage cloakrooms are available near the Jhula Pul entrance gate and near Mamleshwar Temple. Please note that mobile phones and cameras are not permitted inside the sanctum sanctorum.'
                        ],
                        [
                            'cat' => 'Senior Citizens',
                            'q'   => 'Are wheelchairs or assistance available for elderly pilgrims?',
                            'a'   => 'Yes, our VIP Darshan Seva provides dedicated coordinator support. Wheelchairs, ramp access where available, and palanquin (doli) services operated by local porters can be arranged at the base of the hill.'
                        ]
                    ];

                    foreach ($allFaqs as $i => $item):
                    ?>
                    <div class="accordion-item mb-3">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem<?= $i ?>" aria-expanded="false">
                                <span class="badge bg-gold text-white me-2" style="font-size:0.7rem;"><?= e($item['cat']) ?></span>
                                <?= e($item['q']) ?>
                            </button>
                        </h3>
                        <div id="faqItem<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#fullFaq">
                            <div class="accordion-body">
                                <?= e($item['a']) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="text-center mt-5 p-4 bg-white rounded-3 shadow-sm border">
                    <h5 class="text-crimson mb-2">Still have questions?</h5>
                    <p class="text-slate mb-3">Our temple seva team is happy to assist you with customized yatra itineraries and pooja arrangements.</p>
                    <a href="<?= url('contact') ?>" class="btn-crimson text-decoration-none">
                        <i class="bi bi-chat-dots-fill me-1"></i>Contact Seva Desk
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
