<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="admin-sidebar">
	<div class="admin-sidebar__user text-center">
		<img src="<?=viewImg($user['avatar'], 'user').addTmpView()?>" alt="<?=viewImgAlt($user['nameFull'])?>" class="admin-sidebar__user-img rounded-circle">
		<h2 class="admin-sidebar__user-name fw-bold"><?=viewFullName($user['name'], $user['surname'])?></h2>
		<h3 class="admin-sidebar__user-email"><?=$user['email']?></h3>
	</div>

	<ul class="admin-sidebar__list-links list-unstyled mb-0">
		<li class="admin-sidebar__li">
			<a href="<?=setLink('admin-users')?>" class="admin-sidebar__link d-flex-center-y btn-link <?=isActive('users', $pageTypeClean, 'active', true)?>">
				<svg class="icon icon-user icon-m-right-lg top--1"><use xlink:href="#icon-user"></use></svg>
				Users
			</a>
		</li>
		<li class="admin-sidebar__li">
			<a href="<?=setLink('admin-articles')?>" class="admin-sidebar__link d-flex-center-y btn-link <?=isActive('articles', $pageTypeClean, 'active')?>">
				<svg class="icon icon-article icon-m-right-lg"><use xlink:href="#icon-article"></use></svg>
				Articles
			</a>
		</li>
		<li class="admin-sidebar__li">
			<a href="<?=setLink('admin-category')?>" class="admin-sidebar__link d-flex-center-y btn-link <?=isActive('category', $pageTypeClean, 'active')?>">
				<svg class="icon icon-category icon-m-right-lg"><use xlink:href="#icon-category"></use></svg>
				Categories
			</a>
		</li>
		<li class="admin-sidebar__li">
			<a href="<?=setLink('admin-comments')?>" class="admin-sidebar__link d-flex-center-y btn-link <?=isActive('comments', $pageTypeClean, 'active')?>">
				<svg class="icon icon-comments icon-m-right-lg"><use xlink:href="#icon-comments"></use></svg>
				Comments
			</a>
		</li>
		<li class="admin-sidebar__li admin-sidebar__li--logout">
			<a href="<?=setLink('admin-comments')?>" class="admin-sidebar__link d-flex-center-y btn-link text-danger bg-danger-soft-hover">
				<svg class="icon icon-log-out icon-m-right-lg"><use xlink:href="#icon-log-out"></use></svg>
				Logout
			</a>
		</li>
	</ul>

</div>