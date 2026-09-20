<?php
/**
 * Admin Blog Article Create / Edit Form
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0"><?= $post ? 'Edit Blog Article' : 'Write New Article' ?></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=blogs') ?>" class="btn-admin-secondary">
            &larr; Back to Articles
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="admin-form-card">
            <div class="form-card-header">
                <i class="bi bi-journal-richtext"></i> <?= $post ? 'Edit Article Content' : 'Article Information' ?>
            </div>
            <div class="form-card-body">
                <form action="<?= url('admin?action=blog_form' . ($post ? '&id=' . $post['id'] : '')) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label for="blog-title-input" class="form-label-admin">Article Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="blog-title-input" name="title" required value="<?= e($post['title'] ?? '') ?>" placeholder="e.g. Complete Omkareshwar Pilgrimage Guide">
                        </div>
                        <div class="col-md-4">
                            <label for="blog-slug-input" class="form-label-admin">URL Slug</label>
                            <input type="text" class="form-control-admin" id="blog-slug-input" name="slug" value="<?= e($post['slug'] ?? '') ?>" placeholder="complete-omkareshwar-pilgrimage-guide">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label-admin">Short Excerpt / Summary <span class="text-danger">*</span></label>
                        <textarea class="form-control-admin" id="excerpt" name="excerpt" rows="2" required placeholder="Brief 1-2 sentence lead paragraph..."><?= e($post['excerpt'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label-admin">Full Article Content <span class="text-danger">*</span></label>
                        <textarea class="form-control-admin" id="content" name="content" rows="12" required placeholder="Write the complete pilgrimage guide, temple timings, rituals, travel tips, and stories..."><?= e($post['content'] ?? '') ?></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-admin">Featured Article Image</label>
                            <input type="file" class="form-control-admin" name="featured_image" accept="image/*" data-preview="blog-img-preview">
                            <div class="image-preview-box mt-2" id="blog-img-preview">
                                <?php if (!empty($post['featured_image'])): ?>
                                <img src="<?= e(upload_url($post['featured_image'], 'default-temple.svg')) ?>" alt="Current Image">
                                <?php else: ?>
                                <div class="placeholder-icon"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Publication Status</label>
                            <select name="status" class="form-select-admin">
                                <option value="published" <?= (($post['status'] ?? 'published') === 'published') ? 'selected' : '' ?>>Published (Visible)</option>
                                <option value="draft" <?= (($post['status'] ?? '') === 'draft') ? 'selected' : '' ?>>Draft (Hidden)</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= url('admin?action=blogs') ?>" class="btn-admin-secondary">Cancel</a>
                        <button type="submit" class="btn-admin-primary">
                            <i class="bi bi-check-lg me-1"></i> <?= $post ? 'Update Article' : 'Publish Article' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
