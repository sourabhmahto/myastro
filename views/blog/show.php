<?php
/**
 * Single Blog Post View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="page-hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2" style="background:transparent;padding:0;">
                <li class="breadcrumb-item"><a href="<?= url() ?>" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= url('blog') ?>" class="text-white-50">Blog</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?= e(mb_substr($post['title'], 0, 30)) ?>…</li>
            </ol>
        </nav>
        <h1><?= e($post['title']) ?></h1>
        <p class="mb-0"><i class="bi bi-calendar3 me-1"></i>Published on <?= format_date($post['published_at']) ?> &nbsp;|&nbsp; By <?= e($post['author_name'] ?? 'Temple Seva Kendra') ?></p>
    </div>
</div>

<section class="section-py bg-ivory">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <article class="bg-white p-4 p-md-5 rounded-3 shadow-sm border">
                    <img src="<?= e(upload_url($post['featured_image'], 'default-temple.svg')) ?>" alt="<?= e($post['title']) ?>" class="rounded-3 w-100 mb-4 shadow-sm" style="max-height:420px;object-fit:cover;">

                    <div class="lead text-crimson fw-semibold mb-4" style="font-size:1.1rem;line-height:1.7;">
                        <?= e($post['excerpt']) ?>
                    </div>

                    <div class="text-slate blog-article-body" style="font-size:0.98rem;line-height:1.9;">
                        <?= nl2br(e($post['content'])) ?>
                    </div>

                    <div class="divider-om my-5"><span>ॐ</span></div>

                    <!-- Share CTA -->
                    <div class="p-3 bg-gold-pale rounded-3 border d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <span class="text-crimson fw-bold"><i class="bi bi-share-fill me-2"></i>Share this spiritual guide:</span>
                        <a href="https://api.whatsapp.com/send?text=<?= urlencode($post['title'] . ' ' . url('blog/' . $post['slug'])) ?>" target="_blank" class="btn-whatsapp text-decoration-none">
                            <i class="bi bi-whatsapp me-1"></i>Share on WhatsApp
                        </a>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm border mb-4" style="border-top:4px solid var(--color-crimson) !important;">
                    <h5 class="text-crimson mb-3"><i class="bi bi-calendar-check text-gold me-2"></i>Book Online Pooja</h5>
                    <p class="text-slate" style="font-size:0.9rem;">Planning a visit to Omkareshwar? Book your Vedic Rudrabhishek or VIP darshan slot in advance.</p>
                    <a href="<?= url('booking') ?>" class="btn-gold w-100 text-center text-decoration-none d-block">
                        Book Pooja Now
                    </a>
                </div>

                <div class="bg-white p-4 rounded-3 shadow-sm border">
                    <h6 class="text-crimson mb-3">Recent Guides &amp; Lore</h6>
                    <ul class="list-unstyled mb-0" style="font-size:0.88rem;">
                        <?php if (!empty($recentPosts)): foreach ($recentPosts as $rp): if ($rp['id'] !== $post['id']): ?>
                        <li class="py-2 border-bottom">
                            <a href="<?= url('blog/' . $rp['slug']) ?>" class="text-decoration-none text-slate d-block">
                                <strong class="d-block text-crimson mb-1"><?= e($rp['title']) ?></strong>
                                <small class="text-muted"><i class="bi bi-clock me-1"></i><?= format_date($rp['published_at']) ?></small>
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
