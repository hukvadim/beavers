<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-header text-center">
	<div class="container">
		<h1 class="page-title">Login / Sign up</h1>
		<p class="pate-title-desk mt-3 text-muted">Fill in all the required fields so that we can add your material.</p>
	</div>
</div>

<div class="page-content page-content-sm">
	<div class="container">
		
		<div class="form-wrapper d-flex">
			
			<form class="form-login form-style js-send-form">
				<input type="hidden" name="form-type" value="login">

				<div class="box-input">
					<input value="" type="email" class="form-control form-control-lg" name="email" placeholder="Email" maxlength="100" minlength="4" required>
				</div>
				<div class="box-input">
					<input value="" type="password" class="form-control form-control-lg" name="password" placeholder="Password" maxlength="85" minlength="4" required autocomplete="off">
				</div>
				<div class="box-submit">
					<button class="btn btn-submit btn-primary btn-lg w-100">Login</button>
					<a href="<?=setLink('recover')?>" class="btn btn-link btn-recover-pass">Recover password</a>
				</div>
			</form>

			<form class="form-signup form-style js-send-form">
				<input type="hidden" name="form-type" value="registration">

				<div class="box-input">
					<input type="email" class="form-control form-control-lg" name="email" placeholder="Email" maxlength="100" minlength="4" required>
				</div>
				<div class="box-input">
					<input type="text" class="form-control form-control-lg" name="password" placeholder="Password" maxlength="85" minlength="4" required autocomplete="off">
				</div>
				<div class="box-input row g-3">
					<div class="col-6">
						<input type="text" class="form-control form-control-lg" name="name" placeholder="Name" maxlength="50" minlength="2" required>
					</div>
					<div class="col-6">
						<input type="text" class="form-control form-control-lg" name="surname" placeholder="Surname" maxlength="50" minlength="2" required>
					</div>
				</div>
				<div class="box-input">
					<label class="select-file" id="set-avatar">
						<input type="file" name="avatar" class="select-file__input-file absolute-center" accept="image/*" onchange="loadAvatar(event)">
						<span class="select-file__text-holder">
							<svg class="icon icon-upload select-file__icon animate"><use xlink:href="#icon-upload"></use></svg>
							<span class="select-file__btn-link btn-link animate">Select photo</span>
							<span class="select-file__info">Upload a photo larger than 200x200 pixels<br>.jpg or .png</span>
						</span>
						<img src="" alt="" class="select-file__img-preview" id="img-preview">
					</label>
				</div>
				<div class="box-submit">
					<button class="btn btn-submit btn-primary btn-lg w-100">Sign up</button>
				</div>
			</form>

		</div>
	</div>
</div>