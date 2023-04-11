<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-header text-center">
	<div class="container">
		<h1 class="page-title">Recover password</h1>
		<p class="pate-title-desk mt-3 text-muted">We will send you an email with a link to change your password</p>
	</div>
</div>

<div class="page-content page-content-sm">
	<div class="container">
		<div class="form-wrapper d-flex">
			
			<form class="form-recover form-style form-style--center js-send-form">
				<input type="hidden" name="form-type" value="recover">

				<div class="box-input">
					<input value="" type="email" class="form-control form-control-lg" name="email" placeholder="Email" maxlength="100" minlength="4" required>
				</div>
				<div class="box-submit">
					<button class="btn btn-submit btn-primary btn-lg w-100">Change password</button>
				</div>
			</form>

		</div>
	</div>
</div>