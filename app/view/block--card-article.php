<?php
	defined('security') or die('Access denied'); // Add light protection against file access

	// View articles
	if (arrExist($records['list'])):
?>
<div class="list-articles js-list-articles">

	<?php foreach ($records['list'] as $key => $article): ?>
		<div class="card card-article hover-scale-el">

			<div class="card-img-hold scale-el">
				<!-- <a href="<?=setLink('user-edit')?>" class="btn btn-link btn-bookmark card-img-btn-left">
					<svg class="icon icon-bookmark"><use xlink:href="#icon-bookmark"></use></svg>
				</a> -->
				<a href="<?=setLink($article['link'], 'article')?>" class="card-img-link d-flex">
					<img src="<?=viewImg($article['img'], 'article')?>" alt="<?=viewImgAlt($article['title'])?>" class="card-img">
				</a>
			</div>

			<div class="card-body">

				<?php if ($article['cat_name']): ?>
					<a href="<?=setLink($article['cat_link'], 'category')?>" class="btn btn-category btn-primary btn-sm"><?=viewStr($article['cat_name'])?></a>
				<?php endif ?>

				<a href="<?=setLink($article['link'], 'article')?>" class="card-title btn-link"><?=viewStr($article['title'])?></a>

				<?php if ($article['text_sm']): ?>
					<p class="card-text"><?=viewStr($article['text_sm'])?></p>
				<?php endif ?>

				<?php if ($article['user_link']): ?>
					<a href="<?=setLink($article['user_link'], 'user-detail')?>" class="btn btn-user btn-user--sm rounded-5 d-flex-center">
						<img src="<?=viewImg(setImgSm($article['user_avatar']), 'user').addTmpView($article['avatar_cache_num'])?>" alt="<?=viewImgAlt($article['user_name'])?>" width="30" height="30" class="user-img rounded-circle">
						<span class="user-name icon-m-left-lg"><?=viewFullName($article['user_name'], $article['user_surname'])?></span>
					</a>
				<?php endif ?>
			</div>

		</div>
	<?php endforeach ?>

</div>

<?php
	// View html pagination
	viewPagination($records['totalNum']);
?>

<?php else: ?>

	<?php // HTML no result
		include 'block--no-result.php';
	?>

<?php endif ?>