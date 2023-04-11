<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-content">
	<div class="container">
		<div class="box-card-list">

			<div class="page-header">
				<h1 class="page-title">
					Search
					<?php if ($searchVal): ?>
						"<span class="text-truncate js-query-onkeup"><?=viewStr($searchVal)?></span>"
					<?php endif ?>
				</h1>
				<form class="form-search form-search--lg position-relative w-100 mt-4" role="search" action="<?=setLink('search')?>">
					<button class="btn btn-submit d-flex-center position-absolute top-0 start-0" type="submit">
						<svg class="icon icon-arrow-down"><use xlink:href="#icon-arrow-down"></use></svg>
					</button>
					<input name="search" type="search" value="<?=viewStr($searchVal)?>" placeholder="Search..." aria-label="Search" class="form-control animate js-set-query-onkeup">
				</form>
			</div>

			<?php // HTML card article
				include 'block--card-article.php';
			?>

		</div>
	</div>
</div>




