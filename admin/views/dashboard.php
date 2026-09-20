<?php
/**
 * Admin Dashboard View
 */
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Dashboard <span>Welcome, <?= e($adminUser['name'] ?? 'Admin') ?></span></h2>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= url('admin?action=pooja_form') ?>" class="btn-admin-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Pooja Service
        </a>
        <a href="<?= url('admin?action=blog_form') ?>" class="btn-admin-secondary">
            <i class="bi bi-pencil-square me-1"></i> Write Article
        </a>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card border-crimson">
            <div class="stat-icon bg-crimson-soft">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div class="stat-body">
                <div class="stat-value"><?= (int)($bookingStats['total'] ?? 0) ?></div>
                <div class="stat-label">Total Bookings</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card border-success">
            <div class="stat-icon bg-success-soft">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-body">
                <div class="stat-value"><?= (int)($bookingStats['confirmed'] ?? 0) ?></div>
                <div class="stat-label">Confirmed Darshans</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card border-gold">
            <div class="stat-icon bg-gold-soft">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-body">
                <div class="stat-value"><?= (int)($bookingStats['pending'] ?? 0) ?></div>
                <div class="stat-label">Pending Bookings</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="admin-stat-card border-teal">
            <div class="stat-icon bg-teal-soft">
                <i class="bi bi-currency-rupee"></i>
            </div>
            <div class="stat-body">
                <div class="stat-value"><?= format_currency($bookingStats['revenue'] ?? 0) ?></div>
                <div class="stat-label">Paid Seva Revenue</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Links / Modules Grid -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3 col-lg-2">
        <a href="<?= url('admin?action=bookings') ?>" class="quick-action-btn">
            <i class="bi bi-ticket-detailed-fill"></i>
            <span>Bookings</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <a href="<?= url('admin?action=poojas') ?>" class="quick-action-btn">
            <i class="bi bi-flower1"></i>
            <span><?= $totalPoojas ?> Poojas</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <a href="<?= url('admin?action=temples') ?>" class="quick-action-btn">
            <i class="bi bi-bank2"></i>
            <span><?= $totalTemples ?> Temples</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <a href="<?= url('admin?action=places') ?>" class="quick-action-btn">
            <i class="bi bi-geo-alt-fill"></i>
            <span>Places</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <a href="<?= url('admin?action=hotels') ?>" class="quick-action-btn">
            <i class="bi bi-building"></i>
            <span>Accommodations</span>
        </a>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <a href="<?= url('admin?action=blogs') ?>" class="quick-action-btn">
            <i class="bi bi-journal-text"></i>
            <span><?= $totalBlogs ?> Articles</span>
        </a>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="admin-table-card mb-4">
    <div class="card-header">
        <h5>Recent Pilgrimage Bookings</h5>
        <a href="<?= url('admin?action=bookings') ?>" class="btn-admin-secondary btn-sm" style="padding:0.35rem 0.8rem;font-size:0.78rem;">
            View All Bookings &rarr;
        </a>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Ref #</th>
                    <th>Devotee Name</th>
                    <th>Pooja Ritual</th>
                    <th>Date &amp; Slot</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recentBookings)): foreach ($recentBookings as $b): ?>
                <tr>
                    <td><code><?= e($b['booking_number']) ?></code></td>
                    <td>
                        <strong><?= e($b['customer_name']) ?></strong><br>
                        <small class="text-muted"><?= e($b['customer_phone']) ?></small>
                    </td>
                    <td><?= e($b['pooja_name'] ?? 'Vedic Pooja') ?></td>
                    <td>
                        <?= format_date($b['booking_date']) ?><br>
                        <small class="text-gold fw-bold"><?= e($b['booking_time']) ?></small>
                    </td>
                    <td><strong><?= format_currency($b['amount']) ?></strong></td>
                    <td>
                        <span class="status-badge status-<?= e($b['booking_status']) ?>">
                            <?= e($b['booking_status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= url('admin?action=booking_view&id=' . $b['id']) ?>" class="btn-action btn-view" title="View Details">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No booking records found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
