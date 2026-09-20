<?php
/**
 * Admin Temples List View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Temples &amp; Shrines <span>(<?= count($temples) ?> shrines)</span></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=temple_form') ?>" class="btn-admin-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Temple
        </a>
    </div>
</div>

<div class="admin-table-card">
    <div class="card-header">
        <h5>Temple Shrines Catalog</h5>
        <input type="text" class="table-search-input" placeholder="Search temples...">
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Temple Name</th>
                    <th>Opening Hours</th>
                    <th>Address / Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($temples)): foreach ($temples as $t): ?>
                <tr>
                    <td><?= $t['id'] ?></td>
                    <td>
                        <img src="<?= e(upload_url($t['featured_image'], 'default-temple.svg')) ?>" alt="" style="width:45px;height:45px;object-fit:cover;border-radius:6px;">
                    </td>
                    <td>
                        <strong><?= e($t['name']) ?></strong><br>
                        <small class="text-muted"><code>/<?= e($t['slug']) ?></code></small>
                    </td>
                    <td><?= format_time($t['opening_time']) ?> – <?= format_time($t['closing_time']) ?></td>
                    <td><?= e(mb_substr($t['address'], 0, 40)) ?>…</td>
                    <td>
                        <span class="status-badge status-<?= e($t['status']) ?>">
                            <?= e($t['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?= url('temples/' . $t['slug']) ?>" target="_blank" class="btn-action btn-view" title="View Public Page">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= url('admin?action=temple_form&id=' . $t['id']) ?>" class="btn-action btn-edit" title="Edit Temple">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= url('admin?action=temples&action=delete&id=' . $t['id'] . '&token=' . csrf_token()) ?>" class="btn-action btn-delete" data-confirm="Delete this temple record?" title="Delete Temple">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No temple records found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
