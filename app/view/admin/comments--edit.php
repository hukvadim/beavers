<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>
<div class="admin-header">
	<div class="admin-header__title-hold">
		<h2 class="admin-header__title">Edit comment</h2>
	</div>
</div>

<form class="admin-form-add form-style js-send-form" enctype="multipart/form-data">
	<input type="hidden" name="admin" value="true">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="pageType" value="<?=$pageTypeClean?>">
	<input type="hidden" name="form-type" value="admin-comments-edit">

	<div class="box-input d-flex">
		<label for="input-published" class="box-input__label fw-bold"><span class="required-label">Publication</span></label>
		<select name="published" class="form-control form-control-lg form-select" id="input-published" required style="max-width: 290px;">
			<option value="show" <?=isActive('show', $recordData['published'], 'selected', true)?>>Publish</option>
			<option value="hide" <?=isActive('hide', $recordData['published'], 'selected')?>>Hide</option>
		</select>
	</div>

	<div class="box-input d-flex align-items-center">
		<label for="input-category" class="box-input__label fw-bold"><span class="required-label">User</span></label>
		<select name="user_id" class="form-control form-control-lg form-select" id="input-category" required style="max-width: 400px;">
			<option value="">Select user</option>
			<?php if (arrExist($listUsers['list'])): ?>
				<?php foreach ($listUsers['list'] as $value): ?>
					<option value="<?=$value['id']?>" <?=isActive($value['id'], $recordData['user_id'], 'selected')?>><?=viewFullName($value['name'], $value['surname'])?></option>
				<?php endforeach ?>
			<?php endif ?>
		</select>
	</div>

	<div class="box-input d-flex align-items-center">
		<label for="input-category" class="box-input__label fw-bold"><span class="required-label">Article</span></label>
		<select name="article_id" class="form-control form-control-lg form-select" id="input-category" required style="max-width: 500px;">
			<option value="">Select article</option>
			<?php if (arrExist($listArticles['list'])): ?>
				<?php foreach ($listArticles['list'] as $value): ?>
					<option value="<?=$value['id']?>" <?=isActive($value['id'], $recordData['article_id'], 'selected')?>><?=viewStr($value['title'])?></option>
				<?php endforeach ?>
			<?php endif ?>
		</select>
	</div>

	<div class="box-input d-flex">
		<label for="input-comment" class="box-input__label fw-bold"><span class="required-label">Comment</span></label>
		<textarea name="comment" id="input-comment" class="form-control form-control-lg" minlength="10" placeholder="Write a comment" required style="--min-h: 100px"><?=viewStr($recordData['text'])?></textarea>
	</div>

	<div class="box-submit d-flex gap-4 mt-4 label-offset">
		<button class="btn btn-submit btn-primary btn-lg">Edit comment</button>
		<a href="<?=$url['admin-'.$pageTypeClean]?>" class="btn btn-cancel btn-light btn-lg">Cancel</a>
	</div>
</form>