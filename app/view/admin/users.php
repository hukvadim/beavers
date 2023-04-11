<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>
<div class="admin-header">
	<div class="admin-header__title-hold">
		<h2 class="admin-header__title">
			<?=ucfirst($pageTypeClean)?>
			<a href="<?=$url['admin-add']?>" class="admin-header__btn-add btn btn-sm btn-icon btn-outline-primary btn-admin rounded-circle">
				<svg class="icon icon-plus"><use xlink:href="#icon-plus"></use></svg>
			</a>
		</h2>
		<div class="admin-header__search box-input position-relative">
			<button class="btn btn-submit d-flex-center position-absolute top-0 start-0" type="submit">
				<svg class="icon icon-filter"><use xlink:href="#icon-filter"></use></svg>
			</button>
			<input type="search" class="form-control js-admin-search-onkeup" name="search" data-page-type="<?=$pageTypeClean?>" placeholder="Search..." maxlength="100" minlength="4">
		</div>
	</div>

	<div class="admin-header__filter btn-group btn-filter-group">
		<a href="<?=$url['admin-filter']?>all"         class="btn btn-link btn-admin btn-filter <?=isActive('all', $activeFilter, 'active', true)?>">All users</a>
		<a href="<?=$url['admin-filter']?>published"   class="btn btn-link btn-admin btn-filter <?=isActive('published', $activeFilter)?>">Published</a>
		<a href="<?=$url['admin-filter']?>hidden"      class="btn btn-link btn-admin btn-filter <?=isActive('hidden', $activeFilter)?>">Hidden</a>
		<a href="<?=$url['admin-filter']?>unactivated" class="btn btn-link btn-admin btn-filter <?=isActive('unactivated', $activeFilter)?>">Unactivated</a>
	</div>

</div>

<div class="box-card-list">

	<div class="js-box-card-list">
			
		<?php if (arrExist($listData['list'])): ?>
			<?php foreach ($listData['list']as $itemData): ?>
				<div class="admin-card hover-scale-el">
					<a href="<?=$url['admin-edit'].$itemData['id']?>" class="admin-card__img-hold scale-el">
						<img src="<?=viewImg($itemData['avatar'], 'user').addTmpView()?>" alt="" class="admin-card__img">
					</a>
					<div class="admin-card__text-hold">
						<a href="<?=$url['admin-edit'].$itemData['id']?>" class="admin-card__title"><?=viewFullName($itemData['name'], $itemData['surname'])?></a>
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

			<?php
				// View html pagination
				viewPagination($listData['totalNum'], 10);
			?>

		<?php else: ?>

			<?php // HTML no result
				include 'block--no-result.php';
			?>

		<?php endif ?>
	</div>

	<div class="js-box-search-card-list"></div>


</div>

