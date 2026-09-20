<?php
/**
 * About Omkareshwar Page
 */
require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">About Omkareshwar</li>
            </ol>
        </nav>
        <h1>About Shree Omkareshwar Jyotirlinga</h1>
        <p class="mb-0">The sacred Om-shaped Mandhata island, ancient Puranic legends, holy Narmada River, and spiritual significance.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <span class="pill-badge mb-2">Sacred Geography</span>
                <h2 class="text-crimson mb-3">The Island Shaped Like "ॐ" (OM)</h2>
                <p class="text-slate">Omkareshwar is situated on the Mandhata (Shivpuri) island in the Narmada River, Khandwa district of Madhya Pradesh. In an extraordinary geographical phenomenon, the holy river Narmada divides into two channels around the lofty sandstone hill, creating an island that perfectly resembles the sacred Hindu glyph <strong>ॐ (OM)</strong>.</p>
                <p class="text-slate">The island measures approximately 4 km in length and 2 km in width, bordered by steep cliffs that plunge into the deep, emerald-green waters of the holy river. Devotees from all over the world undertake the sacred 7 km Mandhata Parikrama (circumambulation) to absorb the immense spiritual energy emanating from this holy land.</p>
                <div class="divider-om my-4"><span>ॐ</span></div>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="p-3 bg-white rounded-3 border">
                            <h6 class="text-crimson mb-1"><i class="bi bi-geo-alt-fill text-gold me-2"></i>Location</h6>
                            <small class="text-slate">Khandwa District, Madhya Pradesh, India (78 km from Indore)</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-white rounded-3 border">
                            <h6 class="text-crimson mb-1"><i class="bi bi-water text-teal me-2"></i>Holy River</h6>
                            <small class="text-slate">Mother Narmada (Reva) and Kaveri Confluence</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?= e(SITE_URL) ?>/assets/images/default-place.svg" alt="Omkareshwar Island Topography" class="rounded-3 shadow-lg w-100" style="border-top:4px solid var(--color-gold);">
            </div>
        </div>

        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6 order-lg-2">
                <span class="pill-badge mb-2">Puranic Legend</span>
                <h2 class="text-crimson mb-3">King Mandhata and Divine Penance</h2>
                <p class="text-slate">According to the <em>Shiva Purana</em> and <em>Skanda Purana</em>, the great Ikshvaku King Mandhata (ancestor of Lord Rama) performed severe penance on this island to please Lord Shiva. Delighted with the king's unshakeable devotion, Lord Shiva manifested in the form of a Jyotirlinga and agreed to reside here eternally.</p>
                <p class="text-slate">Another celebrated legend narrates the penance of Narada Muni and Vindhya Parvat. When Vindhya mountain sought the grace to grow without ego, Lord Shiva blessed him and consecrated the two sanctums: <strong>Omkareshwar</strong> on the island and <strong>Mamleshwar (Amareshwar)</strong> on the southern bank.</p>
                <blockquote class="p-3 bg-gold-pale rounded-3 border-start border-4 border-warning my-3 text-slate font-italic">
                    "Narmada Darshanat Punyam, Ganga Snanat Tu Muktaye."<br>
                    <small>— Just beholding the sacred Narmada bestows merit equal to bathing in holy rivers.</small>
                </blockquote>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="<?= e(SITE_URL) ?>/assets/images/default-temple.svg" alt="King Mandhata Temple Lore" class="rounded-3 shadow-lg w-100" style="border-top:4px solid var(--color-crimson);">
            </div>
        </div>

        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="pill-badge mb-2">Spiritual Heritage</span>
                <h2 class="text-crimson mb-3">Adi Shankaracharya & Guru Govinda Bhagavatpada</h2>
                <p class="text-slate">Omkareshwar holds supreme importance for Advaita Vedanta followers. It was here, inside a cave below the Omkareshwar temple, that young <strong>Adi Shankaracharya</strong> met his Guru, <strong>Govinda Bhagavatpada</strong>.</p>
                <p class="text-slate">Guru Govinda Bhagavatpada initiated Shankara into the four Mahavakyas and taught him the deep esoteric meaning of the Upanishads. Today, the sacred cave remains a sanctum of deep meditation, preserved reverently for seekers and sadhakas.</p>
                <a href="<?= url('booking') ?>" class="btn-crimson text-decoration-none mt-2 d-inline-block">
                    <i class="bi bi-calendar-check me-2"></i>Book Your Pilgrimage
                </a>
            </div>
            <div class="col-lg-6">
                <img src="<?= e(SITE_URL) ?>/assets/images/default-pooja.svg" alt="Adi Shankaracharya Cave Heritage" class="rounded-3 shadow-lg w-100" style="border-top:4px solid var(--color-teal);">
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
