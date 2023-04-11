<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-header text-center">
	<div class="container">
		<h1 class="page-title">Change password</h1>
		<p class="pate-title-desk mt-3 text-muted">After changing the password, we will immediately authorize you to the site with the current password.</p>
	</div>
</div>

<div class="page-content page-content-sm">
	<div class="container">
		<div class="form-wrapper d-flex">

			<form class="form-change-password form-style form-style--center js-send-form">
				<input type="hidden" name="form-type" value="change-password">
				<input type="hidden" name="email" value="<?=$login?>">
				<input type="hidden" name="need-redirect" value="true">

				<div class="box-input">
					<input value="" type="text" class="form-control form-control-lg" name="new-password" placeholder="New password" maxlength="100" minlength="4" required autocomplete="off">
				</div>
				<div class="box-submit">
					<button class="btn btn-submit btn-primary btn-lg w-100">Change password</button>
				</div>
			</form>

		</div>
	</div>
</div>