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
		<a href="<?=$url['admin-filter']?>all"         class="btn btn-link btn-admin btn-filter <?=isActive('all', $activeFilter, 'active', true)?>">All articles</a>
		<a href="<?=$url['admin-filter']?>published"   class="btn btn-link btn-admin btn-filter <?=isActive('published', $activeFilter)?>">Published</a>
		<a href="<?=$url['admin-filter']?>hidden"      class="btn btn-link btn-admin btn-filter <?=isActive('hidden', $activeFilter)?>">Hidden</a>
		
		<?php if (arrExist($rivers)): ?>
			<div class="btn btn-link btn-admin btn-filter dropdown">
				<a class="btn-select-by dropdown-toggle" href="#" data-bs-toggle="dropdown"><span class="text-truncate">Category</span></a>
				<ul class="dropdown-menu">

					<?php foreach ($rivers as $value): ?>
						<li><a class="dropdown-item text-truncate js-active-self-link <?=isActive($value['id'], $filterCatID)?>" href="<?=$url['admin-filter-cat'].$value['id']?>"><?=viewStr($value['title'])?></a></li>
					<?php endforeach ?>

				</ul>
			</div>
		<?php endif ?>

		<?php if (arrExist($listUsers['list'])): ?>
			<div class="btn btn-link btn-admin btn-filter dropdown">
				<a class="btn-select-by dropdown-toggle" href="#" data-bs-toggle="dropdown"><span class="text-truncate">Users</span></a>
				<ul class="dropdown-menu dropdown-menu--set-max">

					<?php foreach ($listUsers['list'] as $userData): ?>
						<li><a class="dropdown-item text-truncate js-active-self-link <?=isActive($userData['id'], $filterUserID)?>" href="<?=$url['admin-filter-user'].$userData['id']?>"><?=viewFullName($userData['name'], $userData['surname'])?></a></li>
					<?php endforeach ?>

				</ul>
			</div>
		<?php endif ?>

	</div>

</div>

<div class="box-card-list">

	<div class="js-box-card-list">
			
		<?php if (arrExist($listData['list'])): ?>
			<?php foreach ($listData['list']as $itemData): ?>
				<div class="admin-card hover-scale-el">
					<a href="<?=$url['admin-edit'].$itemData['id']?>" class="admin-card__img-hold scale-el">
						<img src="<?=viewImg($itemData['img'], 'article').addTmpView()?>" alt="" class="admin-card__img">
					</a>
					<div class="admin-card__text-hold">
						<a href="<?=$url['admin-edit'].$itemData['id']?>" class="admin-card__title"><?=clean($itemData['title'])?></a>
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
				viewPagination($listData['totalNum'], 6);
			?>

		<?php else: ?>

			<?php // HTML no result
				include 'block--no-result.php';
			?>

		<?php endif ?>
	</div>

	<div class="js-box-search-card-list"></div>

</div>

