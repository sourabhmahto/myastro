<?php
/**
 * Homepage View
 */
require_once __DIR__ . '/../includes/header.php';
?>

<!-- ===== HERO SECTION ===== -->
<section class="hero-section">
    <img src="<?= e(SITE_URL) ?>/assets/images/default-temple.svg" alt="Shree Omkareshwar Jyotirlinga sacred illustration" class="hero-illustration">
    <div class="container">
        <div class="row align-items-center" style="min-height:88vh;">
            <div class="col-lg-6 col-xl-5 hero-content">
                <div class="hero-badge">
                    <span class="om-text">ॐ</span> &nbsp;12th Jyotirlinga of Lord Shiva
                </div>
                <h1 class="hero-title">
                    <span class="hero-om">ॐ नमः शिवाय</span>
                    Shree <span class="gold-word">Omkareshwar</span><br>
                    Jyotirlinga Darshan
                </h1>
                <p class="hero-subtitle">
                    Experience the divine presence at the sacred Mandhata island on holy river Narmada. Book authentic Vedic Rudrabhishek, priority Darshan, and Narmada Maha Aarti Seva with our verified pandit team.
                </p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="<?= url('booking') ?>" class="btn-gold text-decoration-none" style="border-radius:30px;padding:0.8rem 2rem;font-weight:700;">
                        <i class="bi bi-calendar-check me-2"></i>Book Pooja Now
                    </a>
                    <a href="<?= url('about') ?>" class="btn-outline-crimson text-decoration-none">
                        <i class="bi bi-info-circle me-1"></i>Learn More
                    </a>
                </div>
                <!-- Quick Booking Widget -->
                <div class="booking-widget">
                    <div class="widget-title"><i class="bi bi-search me-2 text-gold"></i>Find & Book a Pooja Service</div>
                    <form action="<?= url('booking') ?>" method="GET" class="row g-2">
                        <div class="col-12">
                            <select class="form-select" name="service" aria-label="Select Pooja">
                                <option value="">— Select Pooja / Darshan Service —</option>
                                <?php if (!empty($poojas)): foreach ($poojas as $p): ?>
                                    <option value="<?= e($p['slug']) ?>"><?= e($p['name']) ?> – <?= format_currency($p['price']) ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="col-8">
                            <input type="date" class="form-control" name="date" min="<?= date('Y-m-d') ?>" placeholder="Preferred Date" aria-label="Date">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn-crimson w-100 text-decoration-none border-0" style="padding:0.65rem;">
                                <i class="bi bi-arrow-right"></i> Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== STATS STRIP ===== -->
<section class="stats-strip">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="stat-number" data-count="12" data-suffix="th">12th</div>
                <div class="stat-label">Jyotirlinga of Lord Shiva</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number" data-count="50000" data-suffix="+">50,000+</div>
                <div class="stat-label">Monthly Pilgrims</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number" data-count="7" data-suffix=" km">7 km</div>
                <div class="stat-label">Sacred Mandhata Parikrama</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number" data-count="8" data-suffix="+">8+</div>
                <div class="stat-label">Vedic Pooja Services</div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TEMPLE INTRODUCTION ===== -->
<section class="section-py bg-ivory">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="pe-lg-4">
                    <div class="section-header text-start mb-3">
                        <div class="section-kicker justify-content-start">
                            <span></span>Sacred Jyotirlinga
                        </div>
                        <h2>The Divine Om-Shaped Island of Mandhata</h2>
                    </div>
                    <p class="text-slate mb-3">Nestled in the sacred lap of Mother Narmada, Omkareshwar is one of the most revered pilgrimage destinations of Sanatana Dharma. The Mandhata hill, surrounded by the holy river from all sides, forms the exact shape of the Sanskrit sacred syllable <strong class="om-text text-gold fs-5">ॐ</strong> — a divine miracle of nature.</p>
                    <p class="text-slate mb-3">The Omkareshwar Jyotirlinga, worshipped since Dvapara Yuga by King Mandhata, emanates an indescribable spiritual vibration that pilgrims describe as an awakening of the innermost consciousness.</p>
                    <p class="text-slate mb-4">The sacred island hosts over 68 ancient temples, most notably Shree Omkareshwar and Shree Mamleshwar, whose combined darshan is considered a complete Jyotirlinga pilgrimage.</p>
                    <div class="divider-om"><span>ॐ</span></div>
                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:36px;height:36px;background:rgba(217,119,6,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="bi bi-clock-fill text-gold"></i>
                                </div>
                                <div>
                                    <div style="font-size:0.72rem;color:var(--color-slate);font-weight:600;">MORNING</div>
                                    <div style="font-size:0.9rem;font-weight:700;color:var(--color-crimson);">5:00 – 12:00</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:36px;height:36px;background:rgba(217,119,6,0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="bi bi-moon-fill text-gold"></i>
                                </div>
                                <div>
                                    <div style="font-size:0.72rem;color:var(--color-slate);font-weight:600;">EVENING</div>
                                    <div style="font-size:0.9rem;font-weight:700;color:var(--color-crimson);">4:30 – 9:30 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="<?= e(SITE_URL) ?>/assets/images/default-temple.svg" alt="Sacred Omkareshwar Jyotirlinga temple on Mandhata Island Narmada" class="rounded-3 shadow-lg w-100" style="border-top:4px solid var(--color-gold);" loading="lazy">
                    <div class="position-absolute" style="bottom:20px;left:20px;background:white;border-radius:12px;padding:12px 16px;box-shadow:0 4px 20px rgba(0,0,0,0.15);border-left:4px solid var(--color-gold);">
                        <div class="d-flex align-items-center gap-2">
                            <span class="om-text text-gold" style="font-size:1.8rem;line-height:1;">ॐ</span>
                            <div>
                                <div style="font-size:0.75rem;color:var(--color-slate);font-weight:600;">SACRED ISLAND</div>
                                <div style="font-size:0.9rem;font-weight:700;color:var(--color-crimson);">Mandhata, Narmada</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== AARTI SCHEDULE ===== -->
<section class="section-py bg-gold-pale">
    <div class="container">
        <div class="section-header">
            <div class="section-kicker">Daily Schedule</div>
            <h2>Darshan & Aarti Timings</h2>
            <p class="lead-sub">Sacred rituals are performed at precise auspicious moments throughout the day at Shree Omkareshwar.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive rounded-3 overflow-hidden shadow-sm">
                    <table class="table aarti-schedule-table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col"><i class="bi bi-sunrise me-2"></i>Ritual / Aarti</th>
                                <th scope="col" class="text-center">Timing</th>
                                <th scope="col">Notes for Pilgrims</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Mangal Aarti</strong> <span class="aarti-badge ms-1">Dawn</span></td>
                                <td class="text-center fw-bold text-crimson">5:00 AM – 5:30 AM</td>
                                <td>Most spiritually potent aarti. Arrive by 4:45 AM to secure space.</td>
                            </tr>
                            <tr>
                                <td><strong>Morning Darshan Opens</strong></td>
                                <td class="text-center fw-bold text-crimson">5:30 AM</td>
                                <td>Sacred snan (bathing) in Narmada recommended before entering sanctum.</td>
                            </tr>
                            <tr>
                                <td><strong>Madhyahna Bhog (Afternoon)</strong></td>
                                <td class="text-center fw-bold text-slate">12:00 PM – 1:15 PM</td>
                                <td>Temple sanctum closed. Explore parikrama route during this period.</td>
                            </tr>
                            <tr>
                                <td><strong>Afternoon Darshan</strong></td>
                                <td class="text-center fw-bold text-crimson">1:15 PM – 3:30 PM</td>
                                <td>Relatively peaceful; ideal for senior citizens and families.</td>
                            </tr>
                            <tr>
                                <td><strong>Narmada Deep Daan Seva</strong> <span class="aarti-badge ms-1">Dusk</span></td>
                                <td class="text-center fw-bold text-crimson">7:00 PM – 7:45 PM</td>
                                <td>Sacred oil lamp offering ceremony at main ghats. Pre-booking recommended.</td>
                            </tr>
                            <tr>
                                <td><strong>Sandhya Aarti</strong></td>
                                <td class="text-center fw-bold text-crimson">8:30 PM – 9:00 PM</td>
                                <td>Evening devotional ceremony with conch shells and sacred chants.</td>
                            </tr>
                            <tr>
                                <td><strong>Shayan Aarti (Dice Ritual)</strong></td>
                                <td class="text-center fw-bold text-gold">9:00 PM – 9:30 PM</td>
                                <td>The mystical bedtime ritual where Lord Shiva and Goddess Parvati are offered the game of Chausar. Sanctum closes for the night thereafter.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-center">
                    <a href="<?= url('booking') ?>" class="btn-crimson text-decoration-none d-inline-block">
                        <i class="bi bi-calendar-check me-2"></i>Reserve Your Pooja Slot
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== POPULAR POOJA SERVICES ===== -->
<section class="section-py bg-ivory">
    <div class="container">
        <div class="section-header">
            <div class="section-kicker">Vedic Rituals</div>
            <h2>Popular Pooja & Darshan Services</h2>
            <p class="lead-sub">Authentic Vedic ceremonies performed with pure samagri by certified Brahmin pandits with deep traditional knowledge.</p>
        </div>
        <div class="row g-4">
            <?php if (!empty($poojas)): foreach (array_slice($poojas, 0, 6) as $pooja): ?>
            <div class="col-lg-4 col-md-6">
                <div class="pooja-card">
                    <div class="pooja-card-img-wrap">
                        <img src="<?= e(upload_url($pooja['image'], 'default-pooja.svg')) ?>" alt="<?= e($pooja['name']) ?> Pooja ritual at Omkareshwar" loading="lazy">
                        <div class="pooja-price-badge"><?= format_currency($pooja['price']) ?></div>
                    </div>
                    <div class="pooja-card-body">
                        <h4><?= e($pooja['name']) ?></h4>
                        <div class="pooja-meta">
                            <span><i class="bi bi-clock me-1 text-teal"></i><?= e($pooja['duration']) ?></span>
                        </div>
                        <p><?= e(mb_substr($pooja['description'], 0, 120)) ?>…</p>
                        <div class="d-flex gap-2 mt-auto">
                            <a href="<?= url('pooja-services/' . $pooja['slug']) ?>" class="btn-outline-crimson text-decoration-none flex-fill text-center" style="padding:0.5rem 0.8rem;font-size:0.84rem;">
                                View Details
                            </a>
                            <a href="<?= url('booking?service=' . $pooja['slug']) ?>" class="btn-crimson text-decoration-none flex-fill text-center" style="padding:0.5rem 0.8rem;font-size:0.84rem;">
                                <i class="bi bi-calendar-check me-1"></i>Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= url('pooja-services') ?>" class="btn-outline-crimson text-decoration-none">View All Pooja Services <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

<!-- ===== PLACES TO VISIT ===== -->
<section class="section-py bg-gold-pale">
    <div class="container">
        <div class="section-header">
            <div class="section-kicker">Mandhata Island</div>
            <h2>Sacred Places to Visit Around Omkareshwar</h2>
            <p class="lead-sub">The Om-shaped island of Mandhata is dotted with ancient shrines, scenic ghats, and historic caves to explore during your yatra.</p>
        </div>
        <div class="row g-4">
            <?php if (!empty($places)): foreach (array_slice($places, 0, 4) as $place): ?>
            <div class="col-lg-3 col-md-6">
                <div class="place-card">
                    <div class="place-card-img">
                        <img src="<?= e(upload_url($place['image'], 'default-place.svg')) ?>" alt="<?= e($place['name']) ?> near Omkareshwar" loading="lazy">
                    </div>
                    <div class="place-card-body">
                        <span class="distance-pill"><i class="bi bi-geo-alt-fill me-1"></i><?= e($place['distance_from_temple']) ?></span>
                        <h5><?= e($place['name']) ?></h5>
                        <p class="text-slate" style="font-size:0.87rem;"><?= e(mb_substr($place['description'], 0, 100)) ?>…</p>
                        <a href="<?= url('places/' . $place['slug']) ?>" class="read-more-link">Explore <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= url('places') ?>" class="btn-outline-crimson text-decoration-none">Explore All Places <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

<!-- ===== ACCOMMODATION ===== -->
<section class="section-py bg-ivory">
    <div class="container">
        <div class="section-header">
            <div class="section-kicker">Where to Stay</div>
            <h2>Pilgrim Accommodation in Omkareshwar</h2>
            <p class="lead-sub">From peaceful ashrams to comfortable riverside guesthouses, find accommodation that supports your spiritual journey.</p>
        </div>
        <div class="row g-4">
            <?php if (!empty($hotels)): foreach (array_slice($hotels, 0, 3) as $hotel): ?>
            <div class="col-lg-4 col-md-6">
                <div class="hotel-card">
                    <div class="hotel-card-img">
                        <img src="<?= e(upload_url($hotel['image'], 'default-place.svg')) ?>" alt="<?= e($hotel['name']) ?> in Omkareshwar" loading="lazy">
                    </div>
                    <div class="hotel-card-body p-3">
                        <h5 class="text-crimson fw-bold mb-1"><?= e($hotel['name']) ?></h5>
                        <div class="hotel-price mb-1"><i class="bi bi-currency-rupee me-1"></i><?= e($hotel['price_range']) ?></div>
                        <p class="text-slate" style="font-size:0.86rem;"><?= e(mb_substr($hotel['description'], 0, 100)) ?>…</p>
                        <div class="hotel-amenities"><i class="bi bi-check2-all me-1 text-teal"></i><?= e(mb_substr($hotel['amenities'] ?? '', 0, 80)) ?></div>
                        <a href="<?= url('hotels/' . $hotel['slug']) ?>" class="btn-outline-crimson d-inline-block text-decoration-none mt-2" style="padding:0.45rem 1.2rem;font-size:0.84rem;">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= url('hotels') ?>" class="btn-outline-crimson text-decoration-none">All Accommodations <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

<!-- ===== GALLERY PREVIEW ===== -->
<section class="section-py bg-gold-pale">
    <div class="container">
        <div class="section-header">
            <div class="section-kicker">Sacred Moments</div>
            <h2>Photo Gallery of Omkareshwar</h2>
            <p class="lead-sub">Glimpses of spiritual splendour, sacred rituals, and the tranquil beauty of Mandhata island and river Narmada.</p>
        </div>
        <div class="row g-3">
            <?php if (!empty($galleries)): foreach (array_slice($galleries, 0, 8) as $g): ?>
            <div class="col-6 col-md-3">
                <div class="gallery-item rounded-3 overflow-hidden" data-category="<?= e($g['category']) ?>" style="height:180px;">
                    <img src="<?= e(upload_url($g['image'], 'default-temple.svg')) ?>" alt="<?= e($g['alt_text']) ?>" style="width:100%;height:100%;object-fit:cover;" loading="lazy">
                    <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= url('gallery') ?>" class="btn-crimson text-decoration-none d-inline-block">View Full Gallery <i class="bi bi-images ms-1"></i></a>
        </div>
    </div>
</section>

<!-- ===== BLOG SECTION ===== -->
<section class="section-py bg-ivory">
    <div class="container">
        <div class="section-header">
            <div class="section-kicker">Pilgrimage Guides</div>
            <h2>Latest from the Yatra Blog</h2>
            <p class="lead-sub">Insightful articles on Omkareshwar pilgrimage routes, Narmada Parikrama, festival schedules, and Vedic ritual significance.</p>
        </div>
        <div class="row g-4">
            <?php if (!empty($blogs)): foreach ($blogs as $post): ?>
            <div class="col-lg-4 col-md-6">
                <div class="blog-card">
                    <div class="blog-card-img">
                        <img src="<?= e(upload_url($post['featured_image'], 'default-temple.svg')) ?>" alt="<?= e($post['title']) ?>" loading="lazy">
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-card-date"><i class="bi bi-calendar3 me-1"></i><?= format_date($post['published_at']) ?></div>
                        <h5><?= e($post['title']) ?></h5>
                        <p><?= e(mb_substr($post['excerpt'], 0, 130)) ?>…</p>
                        <a href="<?= url('blog/' . $post['slug']) ?>" class="read-more-link">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?= url('blog') ?>" class="btn-outline-crimson text-decoration-none">All Articles <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

<!-- ===== FAQ SECTION ===== -->
<section class="section-py bg-gold-pale">
    <div class="container">
        <div class="section-header">
            <div class="section-kicker">Common Questions</div>
            <h2>Pilgrimage FAQ</h2>
            <p class="lead-sub">Answers to the most common questions from devotees planning their Omkareshwar pilgrimage.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion faq-accordion" id="homeFaq">
                    <?php
                    $faqs = [
                        ['q' => 'What is the best time to visit Omkareshwar Jyotirlinga?', 'a' => 'October to March is the most comfortable season. The Shravan month (July-August) and Mahashivratri (February-March) are the most spiritually potent but extremely crowded periods. Weekday visits are recommended for a peaceful darshan experience.'],
                        ['q' => 'How do I reach Omkareshwar from Indore or Ujjain?', 'a' => 'Omkareshwar is 78 km from Indore (approx. 2.5 hours by road). Regular state buses (MPSRTC) and private taxis/cabs are available from Indore, Ujjain, and Khandwa. The nearest railway junction is Khandwa (70 km south).'],
                        ['q' => 'Is prior booking required for Pooja services?', 'a' => 'While walk-in pooja assistance is available, advance online booking through our portal guarantees your preferred time slot, dedicated pandit coordinator, and avoids long waiting queues — especially during festival seasons and weekends.'],
                        ['q' => 'What is the dress code for entering the Jyotirlinga sanctum?', 'a' => 'Men are required to enter the inner sanctum bare-chested (traditional pitambar/dhoti recommended). Women should wear saree, salwar-kameez, or other modest traditional Indian attire. Shorts, skirts, and revealing clothing are not permitted.'],
                        ['q' => 'Is the Mandhata Island Parikrama accessible for senior citizens?', 'a' => 'The 7 km parikrama path has some inclines and uneven surfaces. Senior citizens and differently-abled devotees are advised to opt for our VIP Darshan Seva which includes wheelchair/palanquin assistance on request. Boat parikrama is also available seasonally.'],
                        ['q' => 'Are luggage lockers and cloak rooms available at the temple?', 'a' => 'Yes, paid cloak room facilities are available near both the main island entry gate and the Mamleshwar temple on the south bank. Mobile phones and cameras are not permitted inside the main sanctum.']
                    ];
                    foreach ($faqs as $i => $faq):
                    ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $i ?>" aria-expanded="false">
                                <?= e($faq['q']) ?>
                            </button>
                        </h3>
                        <div id="faq<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#homeFaq">
                            <div class="accordion-body"><?= e($faq['a']) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-4">
                    <a href="<?= url('faq') ?>" class="read-more-link">View All FAQ <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== BOOKING CTA STRIP ===== -->
<section class="bg-crimson section-py-sm">
    <div class="container text-center">
        <h2 style="color:#fff;font-size:1.9rem;margin-bottom:0.6rem;">Ready to Begin Your Sacred Pilgrimage?</h2>
        <p style="color:rgba(255,255,255,0.8);max-width:520px;margin:0 auto 1.8rem;">Reserve your Pooja slot and receive an instant digital Darshan pass — delivered directly to your phone and email.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="<?= url('booking') ?>" class="btn-gold text-decoration-none" style="border-radius:30px;padding:0.85rem 2.4rem;font-size:1rem;font-weight:700;">
                <i class="bi bi-calendar-check me-2"></i>Book Pooja & Darshan
            </a>
            <a href="<?= url('contact') ?>" class="btn-outline-gold text-decoration-none">
                <i class="bi bi-headset me-2"></i>Speak to Coordinator
            </a>
        </div>
    </div>
</section>

<!-- Lightbox Container -->
<div class="gallery-lightbox" role="dialog" aria-modal="true" aria-label="Photo lightbox">
    <button class="lightbox-close" aria-label="Close lightbox">&times;</button>
    <img src="" alt="" style="max-width:90vw;max-height:85vh;border-radius:12px;object-fit:contain;">
    <p class="lightbox-caption" style="color:rgba(255,255,255,0.75);margin-top:1rem;font-size:0.9rem;"></p>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
