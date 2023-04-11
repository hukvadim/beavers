<?php
	defined('security') or die('Access denied'); // Add light protection against file access\

	// Change the link to the user's recovery category
	$url['category'] = $url['user'].$userDetail['link'].'/category/';
?>

<div class="page-content">
	<div class="container">
		<div class="row page-content-hold">

			<div class="col-lg-4 user-sidebar">
				
				<div class="box-user-info">
					<img src="<?=viewImg($userDetail['avatar'], 'user')?>" alt="<?=viewImgAlt($userDetail['nameFull'])?>" class="box-user-info__img">
					<h2 class="box-user-info__name"><?=viewFullName($user['name'], $user['surname'])?></h2>
				</div>

			</div>

			<div class="col-lg-8 user-content">
				<div class="box-card-list">

					<div class="page-header">
						<h1 class="page-title">User wrote these articles</h1>
					</div>

					<?php if (arrExist($categoryRecords)): ?>
						<div class="box-category-inline">
							<a href="<?=$url['user'].$url['data1'].$userDetail['link']?>" class="btn btn-category btn-primary btn-sm <?=(!$activeProfileCat) ? 'active' : ''?>">All articles</a>
							
							<?php foreach ($categoryRecords as $key => $value): ?>
								<a href="<?=$url['user'].$url['data1'].$userDetail['link'].$url['data2'].'category'.$url['data3'].$value['link']?>" class="btn btn-category btn-primary btn-sm <?=isActive($value['link'], $activeProfileCat)?>"><?=viewStr($value['title'])?></a>
							<?php endforeach ?>
						</div>
					<?php endif ?>

					<?php // HTML card article
						include 'block--card-article.php';
					?>

				</div>
			</div>

		</div>
	</div>
</div>