<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-title">Add new article</h1>
		<p class="pate-title-desk mt-3 text-line">Fill in all the required fields so that we can add your material.</p>
	</div>
</div>

<div class="page-content page-content-sm">
	<div class="container">
		
		<form class="form-add-article form-style js-send-form" enctype="multipart/form-data">
			<input type="hidden" name="form-type" value="add-article">

			<div class="box-input d-flex align-items-center">
				<label for="input-title" class="box-input__label fw-bold"><span class="required-label">Photo</span></label>
				<div class="box-input-img-select">
					<label class="select-file select-file--btn" id="set-avatar">
						<input type="file" name="image" class="select-file__input-file absolute-center" accept="image/*" required onchange="loadAvatar(event)">
						<span class="select-file__text-holder">
							<span class="select-file__btn btn btn-primary">
								<svg class="icon icon-upload select-file__icon animate icon-m-right-lg"><use xlink:href="#icon-upload"></use></svg>
								<span class="select-file__btn-link">Select photo</span>
								<span class="select-file__btn-img-name text-truncate" id="img-preview-name">You selected photo</span>
							</span>
							<span class="select-file__info">Upload a photo larger than 500x500 pixels<br>.jpg or .png</span>
						</span>
						<img src="" alt="" class="select-file__img-preview" id="img-preview">
					</label>
				</div>
			</div>
			<div class="box-input d-flex align-items-center">
				<label for="input-category" class="box-input__label fw-bold"><span class="required-label">Category</span></label>
				<select name="category" class="form-control form-control-lg form-select" id="input-category" required>
					<option value="">Select a category</option>
					<?php if (arrExist($rivers)): ?>
						<?php foreach ($rivers as $value): ?>
							<option value="<?=$value['id']?>"><?=viewStr($value['title'])?></option>
						<?php endforeach ?>
					<?php endif ?>
				</select>
			</div>
			<div class="box-input d-flex align-items-center">
				<label for="input-title" class="box-input__label fw-bold"><span class="required-label">Title</span></label>
				<input type="text" id="input-title" class="form-control form-control-lg" name="title" placeholder="What will your article be called?" maxlength="100" minlength="4" required>
			</div>
			<div class="box-input d-flex">
				<label for="input-text-small" class="box-input__label fw-bold"><span class="required-label">Description</span></label>
				<textarea name="text-small" id="input-text-small" class="form-control form-control-lg" minlength="10" maxlength="200" placeholder="Write a free-form small text max 200 characters" required></textarea>
			</div>
			<div class="box-input d-flex">
				<label for="input-article" class="box-input__label fw-bold"><span class="required-label">Article</span></label>
				<textarea name="article" id="input-article" class="form-control form-control-lg" minlength="10" placeholder="Write a free-form article" required style="--min-h: 250px"></textarea>
			</div>
			<div class="box-submit d-flex gap-4 mt-4 label-offset">
				<button type="submit" class="btn btn-submit btn-primary btn-lg">Add article</button>
				<a href="<?=$url['user']?>" class="btn btn-cancel btn-light btn-lg">Cancel</a>
			</div>
		</form>

	</div>
</div>