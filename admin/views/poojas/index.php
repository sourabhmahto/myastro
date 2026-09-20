<?php
/**
 * Admin Pooja Services List View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Pooja Services <span>(<?= count($poojas) ?> services)</span></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=pooja_form') ?>" class="btn-admin-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Pooja Service
        </a>
    </div>
</div>

<div class="admin-table-card">
    <div class="card-header">
        <h5>All Pooja Services</h5>
        <input type="text" class="table-search-input" placeholder="Search pooja services...">
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Service Name</th>
                    <th>Duration</th>
                    <th>Dakshina (Price)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($poojas)): foreach ($poojas as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td>
                        <img src="<?= e(upload_url($p['image'], 'default-pooja.svg')) ?>" alt="" style="width:45px;height:45px;object-fit:cover;border-radius:6px;">
                    </td>
                    <td>
                        <strong><?= e($p['name']) ?></strong><br>
                        <small class="text-muted"><code>/<?= e($p['slug']) ?></code></small>
                    </td>
                    <td><?= e($p['duration']) ?></td>
                    <td><strong class="text-crimson"><?= format_currency($p['price']) ?></strong></td>
                    <td>
                        <span class="status-badge status-<?= e($p['status']) ?>">
                            <?= e($p['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?= url('pooja-services/' . $p['slug']) ?>" target="_blank" class="btn-action btn-view" title="View Public Page">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= url('admin?action=pooja_form&id=' . $p['id']) ?>" class="btn-action btn-edit" title="Edit Service">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= url('admin?action=poojas&action_type=delete&id=' . $p['id'] . '&token=' . csrf_token()) ?>" class="btn-action btn-delete" data-confirm="Are you sure you want to delete this pooja service?" title="Delete Service">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No pooja services found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
