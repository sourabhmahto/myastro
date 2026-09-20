<?php
/**
 * 404 Not Found View
 */
require_once __DIR__ . '/../includes/header.php';
?>

<section class="section-py bg-ivory text-center" style="min-height:70vh;display:flex;align-items:center;">
    <div class="container">
        <div class="om-text text-gold mb-2" style="font-size:5rem;line-height:1;">ॐ</div>
        <h1 class="text-crimson display-4 fw-bold mb-2">404 - Sanctum Not Found</h1>
        <p class="text-slate fs-5 mb-4" style="max-width:550px;margin:0 auto;">The page or sacred guide you are looking for may have been moved, renamed, or is temporarily unavailable.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="<?= url() ?>" class="btn-crimson text-decoration-none">
                <i class="bi bi-house-door me-1"></i>Return to Homepage
            </a>
            <a href="<?= url('pooja-services') ?>" class="btn-gold text-decoration-none">
                <i class="bi bi-flower1 me-1"></i>Explore Pooja Services
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
