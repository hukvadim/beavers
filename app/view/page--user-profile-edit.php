<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-title">Edit user data</h1>
		<p class="pate-title-desk mt-3 text-line">Fill in all the required fields so that we can add your material.</p>
	</div>
</div>

<div class="page-content page-content-sm">
	<div class="container">

		<form class="form-edit-profile form-style js-send-form" enctype="multipart/form-data">
			<input type="hidden" name="form-type" value="profile-edit">

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
						<img src="<?=viewImg($user['avatar'], 'user')?>" alt="<?=viewImgAlt($user['nameFull'])?>" class="select-file__img-preview" id="img-preview">
					</label>
				</div>
			</div>
			<div class="box-input d-flex">
				<label for="input-article" class="box-input__label fw-bold"><span class="required-label">Email</span></label>
				<input type="email" value="<?=viewValue($user['email'])?>" class="form-control form-control-lg" name="email" placeholder="Email" maxlength="100" minlength="4" required style="max-width: 600px;">
			</div>
			<div class="box-input d-flex">
				<label for="input-article" class="box-input__label fw-bold"><span class="required-label">Name & Surname</span></label>
				<div class="row g-3 w-100" style="max-width: 615px;">
					<div class="col-6">
						<input type="text" value="<?=viewValue($user['name'])?>" class="form-control form-control-lg" name="name" placeholder="Name" maxlength="100" minlength="2" required>
					</div>
					<div class="col-6">
						<input type="text" value="<?=viewValue($user['surname'])?>" class="form-control form-control-lg" name="surname" placeholder="Surname" maxlength="100" minlength="2" required>
					</div>
				</div>
			</div>
			<div class="box-input d-flex">
				<label for="input-article" class="box-input__label fw-bold">New password</label>
				<input type="text" class="form-control form-control-lg" name="password" placeholder="Need to change your password?" maxlength="85" minlength="4" autocomplete style="max-width: 600px;">
			</div>

			<div class="box-submit d-flex gap-4 mt-4 label-offset">
				<button class="btn btn-submit btn-primary btn-lg">Edit profile</button>
				<a href="#" class="btn btn-cancel btn-light btn-lg">Cancel</a>
			</div>
		</form>

	</div>
</div>