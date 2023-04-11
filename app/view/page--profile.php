<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-content">
	<div class="container">
		<div class="row page-content-hold">

			<div class="col-lg-4 user-sidebar">
				
				<?php // HTML user-sidebar
					include 'block--user-sidebar.php';
				?>

			</div>

			<div class="col-lg-8 user-content">
				<div class="box-card-list">

					<div class="page-header">
						<h1 class="page-title">You wrote these articles</h1>
					</div>

					<?php if (arrExist($categoryRecords)): ?>
						<div class="box-category-inline">
							<a href="<?=setLink('user')?>" class="btn btn-category btn-primary btn-sm <?=(!$activeProfileCat) ? 'active' : ''?>">All articles</a>
							
							<?php foreach ($categoryRecords as $key => $value): ?>
								<a href="<?=$url['user'].$url['data1'].'category'.$url['data2'].$value['link']?>" class="btn btn-category btn-primary btn-sm <?=isActive($value['link'], $activeProfileCat)?>"><?=viewStr($value['title'])?></a>
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