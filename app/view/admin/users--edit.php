<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>
<div class="admin-header">
	<div class="admin-header__title-hold">
		<h2 class="admin-header__title">User edit</h2>
	</div>
</div>

<form class="admin-form-edit form-style js-send-form" enctype="multipart/form-data">
	<input type="hidden" name="admin" value="true">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="pageType" value="<?=$pageTypeClean?>">
	<input type="hidden" name="form-type" value="admin-user-edit">

	<div class="box-input d-flex align-items-center">
		<label for="input-title" class="box-input__label fw-bold"><span class="required-label">Photo</span></label>
		<div class="box-input-img-select">
			<label class="select-file select-file--btn has-preview" id="set-avatar">
				<input type="file" name="avatar" class="select-file__input-file absolute-center" accept="image/*" onchange="loadAvatar(event)">
				<span class="select-file__text-holder">
					<span class="select-file__btn btn btn-primary">
						<svg class="icon icon-upload select-file__icon animate icon-m-right-lg"><use xlink:href="#icon-upload"></use></svg>
						<span class="select-file__btn-link">Change avatar</span>
						<span class="select-file__btn-img-name text-truncate" id="img-preview-name">You selected photo</span>
					</span>
					<span class="select-file__info">Upload a photo larger than 500x500 pixels<br>.jpg or .png</span>
				</span>
				<img src="<?=viewImg($userData['avatar'], 'user').addTmpView()?>" alt="<?=viewImgAlt($userData['nameFull'])?>" class="select-file__img-preview" id="img-preview">
			</label>
		</div>
	</div>

	<div class="box-input d-flex">
		<label for="input-type" class="box-input__label fw-bold"><span class="required-label">Type</span></label>
		<select name="type" class="form-control form-control-lg form-select" id="input-type" required style="max-width: 600px;">
			<option value="user" <?=isActive('user', $userData['type'], 'selected', true)?>>User</option>
			<option value="admin" <?=isActive('admin', $userData['type'], 'selected')?>>Admin</option>
		</select>
	</div>

	<?php if ($userData['type'] != 'admin'): ?>
		<div class="box-input d-flex">
			<label for="input-published" class="box-input__label fw-bold"><span class="required-label">Publication</span></label>
			<select name="published" class="form-control form-control-lg form-select" id="input-published" required style="max-width: 600px;">
				<option value="show" <?=isActive('show', $userData['published'], 'selected', true)?>>Publish</option>
				<option value="hide" <?=isActive('hide', $userData['published'], 'selected')?>>Hide</option>
			</select>
		</div>
		<div class="box-input d-flex">
			<label for="input-confirmed" class="box-input__label fw-bold"><span class="required-label">Confirmed</span></label>
			<select name="confirmed" class="form-control form-control-lg form-select" id="input-confirmed" required style="max-width: 600px;">
				<option value="yes" <?=isActive('yes', $userData['email_confirmed'], 'selected', true)?>>Yes</option>
				<option value="no" <?=isActive('no', $userData['email_confirmed'], 'selected')?>>No</option>
			</select>
		</div>
	<?php endif ?>

	<div class="box-input d-flex">
		<label for="input-article" class="box-input__label fw-bold"><span class="required-label">Email</span></label>
		<input type="email" value="<?=viewValue($userData['email'])?>" class="form-control form-control-lg" name="email" placeholder="Email" maxlength="100" minlength="4" required style="max-width: 600px;">
	</div>
	<div class="box-input d-flex">
		<label for="input-article" class="box-input__label fw-bold"><span class="required-label">Name & Surname</span></label>
		<div class="row g-3 w-100" style="max-width: 615px;">
			<div class="col-6">
				<input type="text" value="<?=viewValue($userData['name'])?>" class="form-control form-control-lg" name="name" placeholder="Name" maxlength="100" minlength="2" required>
			</div>
			<div class="col-6">
				<input type="text" value="<?=viewValue($userData['surname'])?>" class="form-control form-control-lg" name="surname" placeholder="Surname" maxlength="100" minlength="2" required>
			</div>
		</div>
	</div>
	<div class="box-input d-flex">
		<label for="input-article" class="box-input__label fw-bold">New password</label>
		<input type="text" class="form-control form-control-lg" name="password" placeholder="Change user password?" maxlength="85" minlength="4" autocomplete style="max-width: 600px;">
	</div>

	<div class="box-submit d-flex gap-4 mt-4 label-offset">
		<button class="btn btn-submit btn-primary btn-lg">Edit profile</button>
		<a href="<?=$url['admin-users']?>" class="btn btn-cancel btn-light btn-lg">Cancel</a>
	</div>
</form>