<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<header class="navbar navbar-expand-lg bg-white">
	<div class="container">

		<a class="navbar-brand d-flex align-items-center" href="<?=setLink('home')?>">
			<img src="<?=viewImg('logo.png')?>" alt="Logo" class="navbar-brand-logo">
			<span class="navbar-brand-text d-flex flex-column">
				<span class="navbar-brand-text-lg text-nowrap">Many hearts</span>
				<span class="navbar-brand-text-sm text-nowrap">Every beaver have own home</span>
			</span>
		</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<nav class="collapse navbar-collapse" id="navbarSupportedContent">
			
			<?php
				// Reives list
				if (arrExist($rivers)):
			?>
				<div class="nav-select-river dropdown">
					<a class="btn btn-link btn-select-river btn-link-primary dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false"><span class="text-truncate">Select river</span></a>
					<ul class="dropdown-menu">

						<?php foreach ($rivers as $value): ?>
							<li><a class="dropdown-item text-truncate js-active-self-link <?=isActive($value['link'], $activeCat)?>" href="<?=setLink($value['link'], 'category')?>"><?=viewStr($value['title'])?></a></li>
						<?php endforeach ?>

					</ul>
				</div>
			<?php endif ?>

			<form class="nav-search form-search position-relative js-nav-form-search" role="search" action="<?=setLink('search')?>">
				<button class="btn btn-submit d-flex-center position-absolute top-0 start-0" type="submit" aria-label="Search">
					<svg class="icon icon-arrow-down"><use xlink:href="#icon-arrow-down"></use></svg>
				</button>
				<input name="query" type="search" placeholder="Search..." class="form-control form-control-sm animate">
			</form>

			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<a class="nav-link nav-link--icon" href="<?=(arrExist($user)) ? setLink('article-add') : '#'?>" <?=setUserTooltip($user)?> aria-label="Button add article">
						<svg class="icon icon-plus-circle animate"><use xlink:href="#icon-plus-circle"></use></svg>
					</a>
				</li>

				<?php
					// If user exist
					if ($user):
				?>
					<li class="nav-item dropdown dropdown-user">
						<a href="#" class="nav-link d-flex-center dropdown-toggle btn btn-user rounded-5" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="<?=viewImg($user['avatar_sm'], 'user').addTmpView($user['avatar_cache_num'])?>" alt="<?=viewImgAlt($user['nameFull'])?>" width="32" height="32" class="user-img rounded-circle">
							<span class="user-name icon-m-left-lg"><?=viewStr($user['name'])?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-end fz-14px">
							<?php if ($systemOption['admin']): ?>
								<li><a class="dropdown-item d-flex-center-y fw-bold" href="<?=setLink('admin')?>"><svg class="icon icon-setting icon-m-right-lg top--1"><use xlink:href="#icon-setting"></use></svg>Admin panel</a></li>
								<li><hr class="dropdown-divider"></li>
							<?php endif ?>

							<li><a class="dropdown-item d-flex-center-y" href="<?=setLink('user')?>"><svg class="icon icon-edit icon-m-right-lg top--1"><use xlink:href="#icon-eye"></use></svg>Go to profile</a></li>
							<li><a class="dropdown-item d-flex-center-y" href="<?=setLink('user-edit')?>"><svg class="icon icon-edit icon-m-right-lg top--1"><use xlink:href="#icon-edit"></use></svg>Edit profile</a></li>
							<li><a class="dropdown-item d-flex-center-y" href="<?=setLink('user-bookmark')?>"><svg class="icon icon-bookmark icon-m-right-lg top--1"><use xlink:href="#icon-bookmark"></use></svg>Bookmark</a></li>
							<li><a class="dropdown-item d-flex-center-y" href="<?=setLink('user-activity')?>"><svg class="icon icon-clock icon-m-right-lg top--1"><use xlink:href="#icon-clock"></use></svg>Activity history</a></li>
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item d-flex-center-y" href="<?=setLink('user-logout')?>"><svg class="icon icon-log-out icon-m-right-lg top--1"><use xlink:href="#icon-log-out"></use></svg>Logout</a></li>
						</ul>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a class="nav-link" href="<?=setLink('login')?>">Login / Sign up</a>
					</li>
				<?php endif ?>
			</ul>
		</nav>
	</div>
</header>