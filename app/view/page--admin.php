<?php
	defined('security') or die('Access denied'); // Add light protection against file access

	
?>


<div class="page-content page-type-<?=$pageType?>">
	<div class="container">
		<div class="page-content-hold d-flex">

			<?php // HTML user-sidebar
				include 'admin/block--sidebar.php';
			?>

			<div class="page-admin-holder">
				<?php
					// Connect the rest of the view html according to the type
					if(!@include('admin/'.$pageType.'.php'))
						include('admin/'.$mainPage.'.php');
				?>
			</div>
		</div>
	</div>
</div>