<?php
	defined('security') or die('Access denied'); // Add light protection against file access

	// HTML site footer
	include 'block--footer.php';
?>

<script>
	// Settings that will be passed to js
	const option = {
		path: '<?=PATH?>',
		maxSize: <?=MAX_SIZE?>,
		searchPage: '<?=$url['search']?>',
	}

	// Error from php
	let phpAnswer = '<?=($_SESSION['answer']) ? $_SESSION['answer'] : ''?>';
</script>

<script src="<?=setPath('libs')?>jquery/jquery-3.6.3.min.js"></script>
<script src="<?=setPath('libs')?>bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?=setPath('libs')?>notify/notify.min.js"></script>
<script src="<?=setPath('js')?>script.js<?=addTmpView()?>"></script>

<?php if ($systemOption['admin']): ?>
	<script src="<?=setPath('js')?>admin.js<?=addTmpView()?>"></script>
<?php endif ?>




<?php unset($_SESSION['answer']); // Errors, we will output in an array $_SESSION['answer'] and it must be shown once  ?>
</body>
</html>