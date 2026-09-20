<?php
/**
 * Pooja Service Detail View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('pooja-services') ?>" class="text-white-50">Pooja Services</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?= e($pooja['name']) ?></li>
            </ol>
        </nav>
        <h1><?= e($pooja['name']) ?></h1>
        <p class="mb-0">Dakshina: <?= format_currency($pooja['price']) ?> &nbsp;|&nbsp; Duration: <?= e($pooja['duration']) ?></p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-5">
            <!-- Left Column: Details -->
            <div class="col-lg-8">
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm border mb-4">
                    <img src="<?= e(upload_url($pooja['image'], 'default-pooja.svg')) ?>" alt="<?= e($pooja['name']) ?>" class="rounded-3 w-100 mb-4 shadow-sm" style="max-height:400px;object-fit:cover;">

                    <h3 class="text-crimson mb-3">Ritual Significance & Overview</h3>
                    <div class="text-slate mb-4" style="line-height:1.8;font-size:0.95rem;">
                        <?= nl2br(e($pooja['description'])) ?>
                    </div>

                    <?php if (!empty($pooja['benefits'])): ?>
                    <div class="p-4 bg-gold-pale rounded-3 border mb-4">
                        <h5 class="text-crimson mb-2"><i class="bi bi-stars text-gold me-2"></i>Spiritual Benefits</h5>
                        <p class="text-slate mb-0" style="font-size:0.92rem;line-height:1.7;"><?= nl2br(e($pooja['benefits'])) ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($pooja['samagri_included'])): ?>
                    <div class="p-4 bg-white rounded-3 border mb-4">
                        <h5 class="text-crimson mb-2"><i class="bi bi-box-seam text-teal me-2"></i>Sacred Samagri Included</h5>
                        <p class="text-slate mb-0" style="font-size:0.92rem;line-height:1.7;"><?= nl2br(e($pooja['samagri_included'])) ?></p>
                    </div>
                    <?php endif; ?>

                    <div class="divider-om my-4"><span>ॐ</span></div>

                    <h4 class="text-crimson mb-3">What You Need to Know</h4>
                    <ul class="text-slate" style="font-size:0.92rem;line-height:1.7;">
                        <li><strong>Reporting Time:</strong> Please report to the Seva Kendra counter 30 minutes before your scheduled slot.</li>
                        <li><strong>Sankalp:</strong> Our certified Acharya will take your Gotra, Name, and Nakshatra for individualized Sankalp.</li>
                        <li><strong>Prasadam:</strong> Consecrated Mahaprasad, Belpatra, and sacred thread (Raksha Sutra) will be handed over post completion.</li>
                        <li><strong>Attire:</strong> Devotees should come dressed in traditional Indian attire.</li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Booking Card -->
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm border mb-4 sticky-top" style="top:90px;border-top:4px solid var(--color-crimson) !important;">
                    <h5 class="text-crimson mb-3"><i class="bi bi-bookmark-check-fill text-gold me-2"></i>Book This Pooja</h5>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom mb-2">
                        <span class="text-slate">Ritual:</span>
                        <strong class="text-end"><?= e($pooja['name']) ?></strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom mb-2">
                        <span class="text-slate">Duration:</span>
                        <strong><?= e($pooja['duration']) ?></strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom mb-3">
                        <span class="text-slate">Dakshina (Fee):</span>
                        <strong class="text-crimson fs-4"><?= format_currency($pooja['price']) ?></strong>
                    </div>

                    <a href="<?= url('booking?service=' . $pooja['slug']) ?>" class="btn-gold w-100 text-center text-decoration-none d-block py-2 mb-2" style="font-size:1rem;font-weight:700;">
                        <i class="bi bi-calendar-check me-2"></i>Proceed to Book
                    </a>
                    <a href="tel:<?= e(CONTACT_PHONE) ?>" class="btn-outline-crimson w-100 text-center text-decoration-none d-block py-2">
                        <i class="bi bi-telephone me-1"></i>Helpline Inquiry
                    </a>

                    <hr class="my-3">

                    <h6 class="text-crimson mb-2">Other Recommended Poojas</h6>
                    <ul class="list-unstyled mb-0" style="font-size:0.88rem;">
                        <?php if (!empty($allPoojas)): foreach (array_slice($allPoojas, 0, 5) as $ap): if ($ap['id'] !== $pooja['id']): ?>
                        <li class="py-1">
                            <a href="<?= url('pooja-services/' . $ap['slug']) ?>" class="text-decoration-none text-slate d-flex justify-content-between">
                                <span><?= e($ap['name']) ?></span>
                                <span class="text-gold fw-bold"><?= format_currency($ap['price']) ?></span>
                            </a>
                        </li>
                        <?php endif; endforeach; endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
