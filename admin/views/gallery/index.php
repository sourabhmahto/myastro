<?php
/**
 * Admin Gallery List View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Photo Gallery <span>(<?= count($galleries) ?> photos)</span></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=gallery_form') ?>" class="btn-admin-primary">
            <i class="bi bi-upload me-1"></i> Add Photo to Gallery
        </a>
    </div>
</div>

<div class="admin-table-card">
    <div class="card-header">
        <h5>Photo Gallery Items</h5>
        <input type="text" class="table-search-input" placeholder="Search photos...">
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Photo Title</th>
                    <th>Category</th>
                    <th>Alt Text</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($galleries)): foreach ($galleries as $g): ?>
                <tr>
                    <td><?= $g['id'] ?></td>
                    <td>
                        <img src="<?= e(upload_url($g['image'], 'default-temple.svg')) ?>" alt="" style="width:50px;height:40px;object-fit:cover;border-radius:4px;">
                    </td>
                    <td><strong><?= e($g['title']) ?></strong></td>
                    <td><span class="badge bg-light text-dark"><?= e($g['category']) ?></span></td>
                    <td><small class="text-muted"><?= e(mb_substr($g['alt_text'], 0, 35)) ?>…</small></td>
                    <td>
                        <span class="status-badge status-<?= e($g['status']) ?>">
                            <?= e($g['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?= url('admin?action=gallery_form&id=' . $g['id']) ?>" class="btn-action btn-edit" title="Edit Photo">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= url('admin?action=gallery&action=delete&id=' . $g['id'] . '&token=' . csrf_token()) ?>" class="btn-action btn-delete" data-confirm="Delete this photo?" title="Delete Photo">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No photos found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
