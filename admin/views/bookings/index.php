<?php
/**
 * Admin Bookings Management View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Manage Bookings <span>(<?= count($bookings) ?> records)</span></h2>
    </div>
</div>

<!-- Filters Bar -->
<div class="bg-white p-3 rounded-3 shadow-sm border mb-4">
    <form action="<?= url('admin') ?>" method="GET" class="row g-2 align-items-center">
        <input type="hidden" name="action" value="bookings">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control-admin" placeholder="Search by name, ref, mobile..." value="<?= e($filters['search']) ?>">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select-admin">
                <option value="">-- All Statuses --</option>
                <option value="confirmed" <?= ($filters['status'] === 'confirmed') ? 'selected' : '' ?>>Confirmed</option>
                <option value="pending" <?= ($filters['status'] === 'pending') ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= ($filters['status'] === 'completed') ? 'selected' : '' ?>>Completed</option>
                <option value="cancelled" <?= ($filters['status'] === 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="date" class="form-control-admin" value="<?= e($filters['date']) ?>">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn-admin-primary flex-fill">Filter</button>
            <a href="<?= url('admin?action=bookings') ?>" class="btn-admin-secondary">Reset</a>
        </div>
    </form>
</div>

<!-- Bookings Table Card -->
<div class="admin-table-card">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Ref Number</th>
                    <th>Devotee Name</th>
                    <th>Pooja Ritual</th>
                    <th>Booking Date &amp; Slot</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Quick Status Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings)): foreach ($bookings as $b): ?>
                <tr>
                    <td><code><?= e($b['booking_number']) ?></code></td>
                    <td>
                        <strong><?= e($b['customer_name']) ?></strong><br>
                        <small class="text-muted"><i class="bi bi-telephone me-1"></i><?= e($b['customer_phone']) ?></small>
                    </td>
                    <td><?= e($b['pooja_name'] ?? 'N/A') ?></td>
                    <td>
                        <?= format_date($b['booking_date']) ?><br>
                        <span class="badge bg-gold text-white"><?= e($b['booking_time']) ?></span>
                    </td>
                    <td>
                        <strong><?= format_currency($b['amount']) ?></strong><br>
                        <small class="text-muted"><?= strtoupper(str_replace('_', ' ', e($b['payment_status']))) ?></small>
                    </td>
                    <td>
                        <span class="status-badge status-<?= e($b['booking_status']) ?>">
                            <?= e($b['booking_status']) ?>
                        </span>
                    </td>
                    <td>
                        <form action="<?= url('admin?action=bookings') ?>" method="POST" class="quick-status-form d-inline-flex gap-1">
                            <?= csrf_field() ?>
                            <input type="hidden" name="action" value="update_status">
                            <input type="hidden" name="booking_id" value="<?= $b['id'] ?>">
                            <select name="booking_status" class="form-select form-select-sm" style="font-size:0.78rem;width:auto;">
                                <option value="pending" <?= ($b['booking_status'] === 'pending') ? 'selected' : '' ?>>Pending</option>
                                <option value="confirmed" <?= ($b['booking_status'] === 'confirmed') ? 'selected' : '' ?>>Confirmed</option>
                                <option value="completed" <?= ($b['booking_status'] === 'completed') ? 'selected' : '' ?>>Completed</option>
                                <option value="cancelled" <?= ($b['booking_status'] === 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;">Save</button>
                        </form>
                    </td>
                    <td>
                        <a href="<?= url('admin?action=booking_view&id=' . $b['id']) ?>" class="btn-action btn-view" title="View Full Pass">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">No booking records found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
