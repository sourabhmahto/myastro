<?php
/**
 * Admin Places List View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Places &amp; Attractions <span>(<?= count($places) ?> places)</span></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=place_form') ?>" class="btn-admin-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Place
        </a>
    </div>
</div>

<div class="admin-table-card">
    <div class="card-header">
        <h5>Attractions &amp; Parikrama Sites</h5>
        <input type="text" class="table-search-input" placeholder="Search places...">
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Place Name</th>
                    <th>Distance from Temple</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($places)): foreach ($places as $pl): ?>
                <tr>
                    <td><?= $pl['id'] ?></td>
                    <td>
                        <img src="<?= e(upload_url($pl['image'], 'default-place.svg')) ?>" alt="" style="width:45px;height:45px;object-fit:cover;border-radius:6px;">
                    </td>
                    <td>
                        <strong><?= e($pl['name']) ?></strong><br>
                        <small class="text-muted"><code>/<?= e($pl['slug']) ?></code></small>
                    </td>
                    <td><span class="badge bg-gold text-white"><?= e($pl['distance_from_temple']) ?></span></td>
                    <td><?= e($pl['location']) ?></td>
                    <td>
                        <span class="status-badge status-<?= e($pl['status']) ?>">
                            <?= e($pl['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?= url('places/' . $pl['slug']) ?>" target="_blank" class="btn-action btn-view" title="View Public Page">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= url('admin?action=place_form&id=' . $pl['id']) ?>" class="btn-action btn-edit" title="Edit Place">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= url('admin?action=places&action=delete&id=' . $pl['id'] . '&token=' . csrf_token()) ?>" class="btn-action btn-delete" data-confirm="Delete this place?" title="Delete Place">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No attractions found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
