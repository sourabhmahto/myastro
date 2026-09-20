<?php
/**
 * Admin Login View
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Sign In | Omkareshwar Portal</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= e(SITE_URL) ?>/assets/images/favicon.svg">

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Noto+Sans+Devanagari:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= e(SITE_URL) ?>/assets/css/admin.css">
</head>
<body class="admin-body">

<div class="admin-login-wrap">
    <div class="admin-login-card">
        <div class="login-card-header">
            <span class="login-om-symbol">ॐ</span>
            <div class="login-title">Shree Omkareshwar Jyotirlinga</div>
            <div class="login-subtitle">Pilgrimage Management &amp; Admin Panel</div>
        </div>

        <div class="login-card-body">
            <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert" style="font-size:0.88rem;">
                <?= e($error) ?>
            </div>
            <?php endif; ?>

            <?php $flash = get_flash(); if ($flash): ?>
            <div class="alert alert-<?= e($flash['type']) ?>" role="alert" style="font-size:0.88rem;">
                <?= $flash['message'] ?>
            </div>
            <?php endif; ?>

            <form action="<?= url('admin?action=login') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="email" class="form-label-admin">Admin Email Address</label>
                    <input type="email" class="form-control-admin" id="email" name="email" placeholder="admin@omkareshwar.local" required value="<?= e($_POST['email'] ?? 'admin@omkareshwar.local') ?>">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label-admin">Admin Password</label>
                    <input type="password" class="form-control-admin" id="password" name="password" placeholder="••••••••••••" required>
                    <small class="text-muted d-block mt-1">Default demo: <code>Admin@Omkar2026!</code></small>
                </div>

                <button type="submit" class="btn-admin-primary w-100 py-2">
                    Sign In to Admin Dashboard
                </button>
            </form>

            <div class="text-center mt-4 pt-3 border-top">
                <a href="<?= url() ?>" class="text-muted text-decoration-none" style="font-size:0.82rem;">
                    &larr; Back to Public Portal
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
