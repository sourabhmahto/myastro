<?php
/**
 * Blog Listing View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Yatra Blog</li>
            </ol>
        </nav>
        <h1>Omkareshwar Yatra Blog &amp; Pilgrimage Guides</h1>
        <p class="mb-0">Comprehensive pilgrimage guides, temple timings, ritual advice, and spiritual lore.</p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($posts)): foreach ($posts as $post): ?>
            <div class="col-lg-4 col-md-6">
                <div class="blog-card">
                    <div class="blog-card-img">
                        <img src="<?= e(upload_url($post['featured_image'], 'default-temple.svg')) ?>" alt="<?= e($post['title']) ?>" loading="lazy">
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-card-date"><i class="bi bi-calendar3 me-1"></i><?= format_date($post['published_at']) ?></div>
                        <h5><?= e($post['title']) ?></h5>
                        <p><?= e(mb_substr($post['excerpt'], 0, 140)) ?>…</p>
                        <a href="<?= url('blog/' . $post['slug']) ?>" class="read-more-link">Read Full Guide <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-slate">No blog posts published yet.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
