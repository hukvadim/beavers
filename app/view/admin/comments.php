<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>
<div class="admin-header">
	<div class="admin-header__title-hold">
		<h2 class="admin-header__title">
			<?=ucfirst($pageTypeClean)?>
		</h2>
		<div class="admin-header__search box-input position-relative">
			<button class="btn btn-submit d-flex-center position-absolute top-0 start-0" type="submit">
				<svg class="icon icon-filter"><use xlink:href="#icon-filter"></use></svg>
			</button>
			<input type="search" class="form-control js-admin-search-onkeup" name="search" data-page-type="<?=$pageTypeClean?>" placeholder="Search..." maxlength="100" minlength="4">
		</div>
	</div>

	<div class="admin-header__filter btn-group btn-filter-group">
		<a href="<?=$url['admin-filter']?>all"         class="btn btn-link btn-admin btn-filter <?=isActive('all', $activeFilter, 'active', true)?>">All comments</a>
		<a href="<?=$url['admin-filter']?>published"   class="btn btn-link btn-admin btn-filter <?=isActive('published', $activeFilter)?>">Published</a>
		<a href="<?=$url['admin-filter']?>hidden"      class="btn btn-link btn-admin btn-filter <?=isActive('hidden', $activeFilter)?>">Hidden</a>
	</div>

</div>

<div class="box-card-list">

	<div class="js-box-card-list">
			
		<?php if (arrExist($listData['list'])): ?>
			<?php foreach ($listData['list']as $itemData): ?>
				<div class="admin-card hover-scale-el">
					<a href="<?=$url['admin-edit'].$itemData['id']?>" class="admin-card__img-hold scale-el">
						<img src="<?=viewImg($itemData['article_img'], 'article').addTmpView()?>" alt="" class="admin-card__img">
					</a>
					<div class="admin-card__text-hold">
						<a href="<?=$url['admin-edit'].$itemData['id']?>" class="admin-card__title text-truncate"><?=viewFullName($itemData['user_name'], $itemData['user_surname'])?> <small>(<?=clean($itemData['article_title'])?>)</small></a>
						<p class="admin-card__desk text-truncate-2cols"><?=viewStr($itemData['text'])?></p>
						<div class="admin-card__btn-list">
							<a href="<?=$url['admin-edit'].$itemData['id']?>" class="admin-card__btn btn btn-link btn-admin btn-sm btn-edit">
								<svg class="icon icon-edit"><use xlink:href="#icon-edit"></use></svg>
								Edit
							</a>
							<a href="<?=$url['admin-delete'].$itemData['id']?>" class="admin-card__btn btn btn-link btn-admin btn-sm btn-delete js-delete">
								<svg class="icon icon-delete"><use xlink:href="#icon-delete"></use></svg>
								Delete
							</a>
						</div>
					</div>
				</div>
			<?php endforeach ?>

		<?php else: ?>

			<?php // HTML no result
				include 'block--no-result.php';
			?>

		<?php endif ?>

		<?php
			// View html pagination
			viewPagination($listData['totalNum'], 10);
		?>
	</div>

	<div class="js-box-search-card-list"></div>

</div>

