<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-title">Each beaver should have own house</h1>
		<p class="pate-title-desk mt-3"><b>The beaver left 15 cities without internet and electricity and caused a fire.</b> After clarifying the situation, it became clear that his hut on the river had been destroyed. After this situation, we started this project to help beavers have their own homes.</p>
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