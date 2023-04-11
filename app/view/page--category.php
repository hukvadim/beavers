<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-title"><?=viewStr($catInfo['title'])?></h1>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="row page-content-hold">

			<div class="col-lg-4">
				<?php // HTML category
					include 'block--category.php';
				?>
			</div>

			<div class="col-lg-8">
				<div class="box-card-list">

					<?php // HTML card article
						include 'block--card-article.php';
					?>

				</div>
			</div>

		</div>
	</div>
</div>