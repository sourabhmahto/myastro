<?php
/**
 * Admin Gallery Create / Edit Form
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0"><?= $item ? 'Edit Gallery Photo' : 'Add Photo to Gallery' ?></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=gallery') ?>" class="btn-admin-secondary">
            &larr; Back to Gallery
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-form-card">
            <div class="form-card-header">
                <i class="bi bi-images"></i> <?= $item ? 'Edit Photo Information' : 'Upload Gallery Photo' ?>
            </div>
            <div class="form-card-body">
                <form action="<?= url('admin?action=gallery_form' . ($item ? '&id=' . $item['id'] : '')) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="title" class="form-label-admin">Photo Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-admin" id="title" name="title" required value="<?= e($item['title'] ?? '') ?>" placeholder="e.g. Omkareshwar Shikhara at Golden Sunrise">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label-admin">Category <span class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-select-admin">
                                <option value="temples" <?= (($item['category'] ?? 'temples') === 'temples') ? 'selected' : '' ?>>Temples &amp; Shrines</option>
                                <option value="aarti" <?= (($item['category'] ?? '') === 'aarti') ? 'selected' : '' ?>>Narmada Maha Aarti</option>
                                <option value="river_narmada" <?= (($item['category'] ?? '') === 'river_narmada') ? 'selected' : '' ?>>River Narmada &amp; Ghats</option>
                                <option value="parikrama" <?= (($item['category'] ?? '') === 'parikrama') ? 'selected' : '' ?>>Mandhata Parikrama</option>
                                <option value="rituals" <?= (($item['category'] ?? '') === 'rituals') ? 'selected' : '' ?>>Vedic Rituals</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="alt_text" class="form-label-admin">SEO Alt Text</label>
                            <input type="text" class="form-control-admin" id="alt_text" name="alt_text" value="<?= e($item['alt_text'] ?? '') ?>" placeholder="Descriptive alt text for accessibility and SEO...">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-admin">Image File <?= !$item ? '<span class="text-danger">*</span>' : '' ?></label>
                            <input type="file" class="form-control-admin" name="image" accept="image/*" data-preview="gallery-img-preview" <?= !$item ? 'required' : '' ?>>
                            <div class="image-preview-box mt-2" id="gallery-img-preview">
                                <?php if (!empty($item['image'])): ?>
                                <img src="<?= e(upload_url($item['image'], 'default-temple.svg')) ?>" alt="Current Image">
                                <?php else: ?>
                                <div class="placeholder-icon"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Status</label>
                            <select name="status" class="form-select-admin">
                                <option value="active" <?= (($item['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>Active (Visible)</option>
                                <option value="inactive" <?= (($item['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive (Hidden)</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= url('admin?action=gallery') ?>" class="btn-admin-secondary">Cancel</a>
                        <button type="submit" class="btn-admin-primary">
                            <i class="bi bi-check-lg me-1"></i> <?= $item ? 'Save Changes' : 'Upload Photo' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
