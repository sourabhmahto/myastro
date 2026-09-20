<?php
/**
 * Admin Pooja Service Create / Edit Form
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0"><?= $pooja ? 'Edit Pooja Service' : 'Add New Pooja Service' ?></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=poojas') ?>" class="btn-admin-secondary">
            &larr; Back to Pooja Services
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="admin-form-card">
            <div class="form-card-header">
                <i class="bi bi-flower1"></i> <?= $pooja ? 'Edit Service Details' : 'Pooja Service Information' ?>
            </div>
            <div class="form-card-body">
                <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert"><?= e($error) ?></div>
                <?php endif; ?>

                <form action="<?= url('admin?action=pooja_form' . ($pooja ? '&id=' . $pooja['id'] : '')) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label for="form-name-input" class="form-label-admin">Pooja Service Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="form-name-input" name="name" required value="<?= e($pooja['name'] ?? '') ?>" placeholder="e.g. Maha Rudrabhishek Pooja">
                        </div>
                        <div class="col-md-4">
                            <label for="form-slug-input" class="form-label-admin">URL Slug</label>
                            <input type="text" class="form-control-admin" id="form-slug-input" name="slug" value="<?= e($pooja['slug'] ?? '') ?>" placeholder="maha-rudrabhishek-pooja">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="price" class="form-label-admin">Dakshina / Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control-admin" id="price" name="price" required value="<?= e($pooja['price'] ?? '0') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="duration" class="form-label-admin">Ritual Duration <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="duration" name="duration" required value="<?= e($pooja['duration'] ?? '45 mins') ?>" placeholder="e.g. 75 mins">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label-admin">Full Ritual Description <span class="text-danger">*</span></label>
                        <textarea class="form-control-admin" id="description" name="description" rows="5" required placeholder="Explain the significance, Vedic hymns recited, and complete pooja vidhi..."><?= e($pooja['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="benefits" class="form-label-admin">Spiritual Benefits (Optional)</label>
                        <textarea class="form-control-admin" id="benefits" name="benefits" rows="3" placeholder="Key benefits of this ritual according to scriptures..."><?= e($pooja['benefits'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="samagri_included" class="form-label-admin">Sacred Samagri Included (Optional)</label>
                        <textarea class="form-control-admin" id="samagri_included" name="samagri_included" rows="3" placeholder="List all samagri provided (e.g. Milk, Honey, Bael Patra, Gangajal, Sandalwood)..."><?= e($pooja['samagri_included'] ?? '') ?></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-admin">Pooja Featured Image</label>
                            <input type="file" class="form-control-admin" name="image" accept="image/*" data-preview="pooja-img-preview">
                            <small class="text-muted">Allowed: JPG, PNG, WEBP, SVG (Max 5MB)</small>
                            <div class="image-preview-box mt-2" id="pooja-img-preview">
                                <?php if (!empty($pooja['image'])): ?>
                                <img src="<?= e(upload_url($pooja['image'], 'default-pooja.svg')) ?>" alt="Current Image">
                                <?php else: ?>
                                <div class="placeholder-icon"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Status</label>
                            <select name="status" class="form-select-admin">
                                <option value="active" <?= (($pooja['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>Active (Visible on Website)</option>
                                <option value="inactive" <?= (($pooja['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive (Hidden)</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= url('admin?action=poojas') ?>" class="btn-admin-secondary">Cancel</a>
                        <button type="submit" class="btn-admin-primary">
                            <i class="bi bi-check-lg me-1"></i> <?= $pooja ? 'Save Changes' : 'Create Pooja Service' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
