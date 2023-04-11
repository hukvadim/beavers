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
						<h1 class="page-title">Your bookmark</h1>
					</div>

					<?php // HTML card article
						include 'block--card-article.php';
					?>

				</div>
			</div>

		</div>
	</div>
</div>