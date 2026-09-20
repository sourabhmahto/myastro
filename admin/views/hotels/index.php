<?php
/**
 * Admin Hotels List View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Accommodations <span>(<?= count($hotels) ?> properties)</span></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=hotel_form') ?>" class="btn-admin-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Accommodation
        </a>
    </div>
</div>

<div class="admin-table-card">
    <div class="card-header">
        <h5>Hotels, Ashrams &amp; Dharamshalas</h5>
        <input type="text" class="table-search-input" placeholder="Search hotels...">
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Property Name</th>
                    <th>Price Range</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($hotels)): foreach ($hotels as $h): ?>
                <tr>
                    <td><?= $h['id'] ?></td>
                    <td>
                        <img src="<?= e(upload_url($h['image'], 'default-place.svg')) ?>" alt="" style="width:45px;height:45px;object-fit:cover;border-radius:6px;">
                    </td>
                    <td>
                        <strong><?= e($h['name']) ?></strong><br>
                        <small class="text-muted"><code>/<?= e($h['slug']) ?></code></small>
                    </td>
                    <td><strong class="text-teal"><?= e($h['price_range']) ?></strong></td>
                    <td><?= e($h['phone']) ?></td>
                    <td>
                        <span class="status-badge status-<?= e($h['status']) ?>">
                            <?= e($h['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?= url('hotels/' . $h['slug']) ?>" target="_blank" class="btn-action btn-view" title="View Public Page">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= url('admin?action=hotel_form&id=' . $h['id']) ?>" class="btn-action btn-edit" title="Edit Hotel">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= url('admin?action=hotels&action=delete&id=' . $h['id'] . '&token=' . csrf_token()) ?>" class="btn-action btn-delete" data-confirm="Delete this accommodation?" title="Delete Hotel">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No accommodations found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
