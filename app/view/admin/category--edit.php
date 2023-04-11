<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>
<div class="admin-header">
	<div class="admin-header__title-hold">
		<h2 class="admin-header__title">Edit category</h2>
	</div>
</div>

<form class="admin-form-add form-style js-send-form" enctype="multipart/form-data">
	<input type="hidden" name="admin" value="true">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="pageType" value="<?=$pageTypeClean?>">
	<input type="hidden" name="form-type" value="admin-category-edit">

	<div class="box-input d-flex align-items-center">
		<label for="input-title" class="box-input__label fw-bold"><span class="required-label">Photo</span></label>
		<div class="box-input-img-select">
			<label class="select-file select-file--btn has-preview" id="set-image">
				<input type="file" name="image" class="select-file__input-file absolute-center" accept="image/*" onchange="loadAvatar(event)">
				<span class="select-file__text-holder">
					<span class="select-file__btn btn btn-primary">
						<svg class="icon icon-upload select-file__icon animate icon-m-right-lg"><use xlink:href="#icon-upload"></use></svg>
						<span class="select-file__btn-link">Select photo</span>
						<span class="select-file__btn-img-name text-truncate" id="img-preview-name">You selected photo</span>
					</span>
					<span class="select-file__info">Upload a photo larger than 500x500 pixels<br>.jpg or .png</span>
				</span>
				<img src="<?=viewImg($recordData['img'], 'category').addTmpView()?>" class="select-file__img-preview" id="img-preview">
			</label>
		</div>
	</div>

	<div class="box-input d-flex">
		<label for="input-published" class="box-input__label fw-bold"><span class="required-label">Publication</span></label>
		<select name="published" class="form-control form-control-lg form-select" id="input-published" required style="max-width: 290px;">
			<option value="show" <?=isActive('show', $recordData['published'], 'selected', true)?>>Publish</option>
			<option value="hide" <?=isActive('hide', $recordData['published'], 'selected')?>>Hide</option>
		</select>
	</div>

	<div class="box-input d-flex align-items-center">
		<label for="input-title" class="box-input__label fw-bold"><span class="required-label">Title</span></label>
		<input type="text" value="<?=viewValue($recordData['title'])?>" id="input-title" class="form-control form-control-lg" name="title" placeholder="Category title" maxlength="100" minlength="4" required>
	</div>

	<div class="box-submit d-flex gap-4 mt-4 label-offset">
		<button class="btn btn-submit btn-primary btn-lg">Edit category</button>
		<a href="<?=$url['admin-'.$pageTypeClean]?>" class="btn btn-cancel btn-light btn-lg">Cancel</a>
	</div>
</form>