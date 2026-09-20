<?php
/**
 * Admin Hotel Create / Edit Form
 */
require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="admin-page-title mb-0"><?= $hotel ? 'Edit Accommodation' : 'Add New Accommodation' ?></h2>
    </div>
    <div>
        <a href="<?= url('admin?action=hotels') ?>" class="btn-admin-secondary">
            &larr; Back to Accommodations
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="admin-form-card">
            <div class="form-card-header">
                <i class="bi bi-building"></i> <?= $hotel ? 'Edit Property Details' : 'Property Information' ?>
            </div>
            <div class="form-card-body">
                <form action="<?= url('admin?action=hotel_form' . ($hotel ? '&id=' . $hotel['id'] : '')) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label for="form-name-input" class="form-label-admin">Property / Ashram Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="form-name-input" name="name" required value="<?= e($hotel['name'] ?? '') ?>" placeholder="e.g. Narmada Resort (MP Tourism)">
                        </div>
                        <div class="col-md-4">
                            <label for="form-slug-input" class="form-label-admin">URL Slug</label>
                            <input type="text" class="form-control-admin" id="form-slug-input" name="slug" value="<?= e($hotel['slug'] ?? '') ?>" placeholder="narmada-resort-mp-tourism">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="price_range" class="form-label-admin">Price / Tariff Range <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="price_range" name="price_range" required value="<?= e($hotel['price_range'] ?? '₹800 - ₹2,500 / night') ?>" placeholder="e.g. ₹1,200 - ₹3,000 / night">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label-admin">Front Desk Contact Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-admin" id="phone" name="phone" required value="<?= e($hotel['phone'] ?? '') ?>" placeholder="+91 98765 43210">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label-admin">Address / Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-admin" id="address" name="address" required value="<?= e($hotel['address'] ?? 'Omkareshwar, MP - 450554') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="amenities" class="form-label-admin">Amenities &amp; Facilities (Comma separated)</label>
                        <input type="text" class="form-control-admin" id="amenities" name="amenities" value="<?= e($hotel['amenities'] ?? '') ?>" placeholder="AC Rooms, Satvik Food, River View, Hot Water, Wi-Fi, Parking">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label-admin">Property Description <span class="text-danger">*</span></label>
                        <textarea class="form-control-admin" id="description" name="description" rows="5" required placeholder="Describe rooms, proximity to Jhula Pul, satvik bhojan, and pilgrim hospitality..."><?= e($hotel['description'] ?? '') ?></textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-admin">Property Image</label>
                            <input type="file" class="form-control-admin" name="image" accept="image/*" data-preview="hotel-img-preview">
                            <div class="image-preview-box mt-2" id="hotel-img-preview">
                                <?php if (!empty($hotel['image'])): ?>
                                <img src="<?= e(upload_url($hotel['image'], 'default-place.svg')) ?>" alt="Current Image">
                                <?php else: ?>
                                <div class="placeholder-icon"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Status</label>
                            <select name="status" class="form-select-admin">
                                <option value="active" <?= (($hotel['status'] ?? 'active') === 'active') ? 'selected' : '' ?>>Active (Published)</option>
                                <option value="inactive" <?= (($hotel['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive (Hidden)</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= url('admin?action=hotels') ?>" class="btn-admin-secondary">Cancel</a>
                        <button type="submit" class="btn-admin-primary">
                            <i class="bi bi-check-lg me-1"></i> <?= $hotel ? 'Save Changes' : 'Create Hotel Record' ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
