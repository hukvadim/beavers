<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="box-user-info">
	<img src="<?=viewImg($user['avatar'], 'user')?>" alt="<?=viewImgAlt($user['nameFull'])?>" class="box-user-info__img">
	<h2 class="box-user-info__name"><?=viewFullName($user['name'], $user['surname'])?></h2>
	<ul class="box-user-info__list list-unstyled">
		<li class="box-user-info__list-li">
			<a href="<?=setLink('user-edit')?>" class="box-user-info__list-link d-flex-center-y btn-link">
				<svg class="icon icon-edit icon-m-right-lg top--1"><use xlink:href="#icon-edit"></use></svg>
				Edit profile
			</a>
		</li>
		<li class="box-user-info__list-li">
			<a href="<?=setLink('user-bookmark')?>" class="box-user-info__list-link d-flex-center-y btn-link">
				<svg class="icon icon-bookmark icon-m-right-lg top--1"><use xlink:href="#icon-bookmark"></use></svg>
				Bookmark
			</a>
		</li>
		<li class="box-user-info__list-li">
			<a href="<?=setLink('user-activity')?>" class="box-user-info__list-link d-flex-center-y btn-link">
				<svg class="icon icon-clock icon-m-right-lg top--1"><use xlink:href="#icon-clock"></use></svg>
				Activity history
			</a>
		</li>
		<li class="box-user-info__list-li">
			<a class="box-user-info__list-link d-flex-center-y btn-link" href="<?=setLink('user-logout')?>">
				<svg class="icon icon-log-out icon-m-right-lg top--1"><use xlink:href="#icon-log-out"></use></svg>
				Logout
			</a>
		</li>
	</ul>

	<?php if ($systemOption['admin']): ?>
		<ul class="box-admin-info list-unstyled">
			<li class="box-admin-info__li">
				<a href="<?=setLink('admin-users')?>" class="box-admin-info__link d-flex-center-y btn-link">
					<svg class="icon icon-user icon-m-right-lg top--1"><use xlink:href="#icon-user"></use></svg>
					Users
				</a>
			</li>
			<li class="box-admin-info__li">
				<a href="<?=setLink('admin-articles')?>" class="box-admin-info__link d-flex-center-y btn-link">
					<svg class="icon icon-article icon-m-right-lg"><use xlink:href="#icon-article"></use></svg>
					Articles
				</a>
			</li>
			<li class="box-admin-info__li">
				<a href="<?=setLink('admin-category')?>" class="box-admin-info__link d-flex-center-y btn-link">
					<svg class="icon icon-category icon-m-right-lg"><use xlink:href="#icon-category"></use></svg>
					Categories
				</a>
			</li>
			<li class="box-admin-info__li">
				<a href="<?=setLink('admin-comments')?>" class="box-admin-info__link d-flex-center-y btn-link">
					<svg class="icon icon-comments icon-m-right-lg"><use xlink:href="#icon-comments"></use></svg>
					Comments
				</a>
			</li>
		</ul>
	<?php endif ?>

</div>