<?php
	defined('security') or die('Access denied'); // Add light protection against file access

	// View category
	if (arrExist($rivers)):
?>
<div class="box-category">
	<ul class="category nav flex-column list-unstyled">

		<?php foreach ($rivers as $key => $value): ?>
			<li class="nav-item">
				<a href="<?=setLink($value['link'], 'category')?>" class="nav-link js-active-self-link <?=isActive($value['link'], $activeCat)?>">
					<img src="<?=viewImg($value['img'], 'category')?>" alt="<?=viewImgAlt($value['title'])?>" class="nav-link-img radius-main animate">
					<?=viewStr($value['title'])?>
				</a>
			</li>
		<?php endforeach ?>

	</ul>
</div>
<?php endif ?>

