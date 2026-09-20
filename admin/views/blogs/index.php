<?php
/**
 * Admin Blog Posts List View
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0">Blog Articles <span>(<?= count($posts) ?> articles)</span></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=blog_form') ?>" class="btn-admin-primary">
            <i class="bi bi-pencil-square me-1"></i> Write New Article
        </a>
    </div>
</div>

<div class="admin-table-card">
    <div class="card-header">
        <h5>Published &amp; Draft Articles</h5>
        <input type="text" class="table-search-input" placeholder="Search articles...">
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Article Title</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($posts)): foreach ($posts as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td>
                        <img src="<?= e(upload_url($p['featured_image'], 'default-temple.svg')) ?>" alt="" style="width:45px;height:45px;object-fit:cover;border-radius:6px;">
                    </td>
                    <td>
                        <strong><?= e($p['title']) ?></strong><br>
                        <small class="text-muted"><code>/blog/<?= e($p['slug']) ?></code></small>
                    </td>
                    <td><?= e($p['author_name'] ?? 'Admin') ?></td>
                    <td><?= format_date($p['published_at']) ?></td>
                    <td>
                        <span class="status-badge status-<?= e($p['status']) ?>">
                            <?= e($p['status']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?= url('blog/' . $p['slug']) ?>" target="_blank" class="btn-action btn-view" title="View Public Post">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= url('admin?action=blog_form&id=' . $p['id']) ?>" class="btn-action btn-edit" title="Edit Article">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= url('admin?action=blogs&action=delete&id=' . $p['id'] . '&token=' . csrf_token()) ?>" class="btn-action btn-delete" data-confirm="Delete this article?" title="Delete Article">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No articles found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
