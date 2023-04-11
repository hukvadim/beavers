<?php
	defined('security') or die('Access denied'); // Add light protection against file access
?>

<div class="page-content">
	<div class="container">
		<div class="row page-content-hold">

			<div class="col-lg-4">
				<?php // HTML category
					include 'block--category.php';
				?>
			</div>

			<div class="col-lg-8 article">

				<div class="page-header">
					<?php
						// View html breadcrumb
						viewBreadcrumb($breadcrumb);
					?>

					<h1 class="article__title"><?=viewStr($article['title'])?></h1>

					<div class="article__meta-hold d-flex justify-content-between align-items-center">
						<div class="meta-data">
							<?php if ($article['user_link']): ?>
								<div class="meta-data__item meta-data__item--user">
									<a href="<?=setLink($article['user_link'], 'user')?>" class="btn btn-user btn-user--offset btn-user--sm rounded-5 d-flex-center">
										<img src="<?=viewImg(setImgSm($article['user_avatar']), 'user').addTmpView($article['avatar_cache_num'])?>" alt="<?=viewFullName($article['user_name'], $article['user_surname'])?>" width="30" height="30" class="user-img rounded-circle">
										<span class="user-name icon-m-left-lg"><?=viewFullName($article['user_name'], $article['user_surname'])?></span>
									</a>
								</div>
							<?php endif ?>
							<div class="meta-data__item meta-data__item--date">
								<svg class="icon icon-calendar icon-m-right"><use xlink:href="#icon-calendar"></use></svg>
								<?=viewDate($article['date_add'], 'd F Y')?>
							</div>
							<div class="meta-data__item meta-data__item--views">
								<svg class="icon icon-eye icon-m-right"><use xlink:href="#icon-eye"></use></svg>
								<?=prettyNum($article['view_num'])?>
							</div>
						</div>
						<a href="<?=setLink('user-edit')?>" class="btn btn-link btn-bookmark-link btn-bookmark-sm">
							<svg class="icon icon-bookmark"><use xlink:href="#icon-bookmark"></use></svg>
						</a>
					</div>

					<div class="article-content typography">
						<p><img src="<?=viewImg($article['img_article'], 'article')?>" alt="<?=viewImgAlt($article['title'])?>"></p>
						<?=stripcslashes($article['text'])?>
					</div>

					<div class="box-comments">

						<div class="box-comments__header d-flex flex-wrap justify-content-between align-items-center">
							<a href="#js-show-comment-form" data-toggle="collapse" aria-expanded="false" aria-controls="js-show-comment-form" class="box-comments__btn-add-comment btn btn-primary" <?=setUserTooltip($user, 'top')?> >Write a comment</a>
							<div class="box-comments__comments-summ js-comments-summ"><?=declensionWord($comments['totalNum'], ['Comment', 'Comments', 'Comments'])?></div>
						</div>


						<?php if ($user): ?>
							<div id="js-show-comment-form">
								<form class="box-comments__form form-style js-send-form d-flex">
									<input type="hidden" name="form-type" value="comment">
									<input type="hidden" name="article-id" value="<?=$article['id']?>">

									<div class="box-comments__form-user">
										<img src="<?=viewImg($user['avatar'], 'user')?>" alt="<?=viewImgAlt($user['nameFull'])?>" width="56" height="56" class="box-comments__form-user-avatar rounded-circle">
									</div>
									<div class="box-comments__form-input-hold relative">
										<button class="btn btn-link btn-send d-flex-center position-absolute top-0 end-0 animate" type="submit"><svg class="icon icon-send"><use xlink:href="#icon-send"></use></svg></button>
										<textarea name="comment" placeholder="Write comment..." class="form-control animate autogrow js-comment-input" minlength="5" maxlength="600" required></textarea>
									</div>
								</form>
							</div>
						<?php endif ?>


						<div class="box-comments__comments-list js-comments-list">

							<?php if (arrExist($comments['list'])): ?>

								<?php foreach ($comments['list'] as $key => $comment): ?>

									<?php
										// If the previous iteration of the loop is the same comment, then display the comment in a merged form
										$similarPrevUser = ($key !== 0 and $comments['list'][$key - 1]['user_link'] === $comment['user_link']);
									?>

									<?php if (!$similarPrevUser): ?>

										<?php if ($key !== 0): // Close previous comment container ?>
											</div>
										<?php endif ?>

										<div class="item-comment">
											<div class="item-comment__header">
												<a href="<?=setLink($comment['user_link'], 'user-detail')?>" class="btn btn-user btn-user--offset btn-user--sm rounded-5 justify-content-start align-items-center">
													<img src="<?=viewImg(setImgSm($comment['user_avatar']), 'user').addTmpView($comment['avatar_cache_num'])?>" alt="<?=viewImgAlt($comment['user_name'])?>" width="30" height="30" class="user-img rounded-circle">
													 <span class="user-name icon-m-left-lg"><?=viewFullName($comment['user_name'], $comment['user_surname'])?></span>
													 <span class="user-date icon-m-left-lg"><?=timeAgo($comment['date_add'])?></span>
												</a>
											</div>
											<p class="item-comment__text"><?=stripcslashes(nl2br($comment['text']))?></p>

									<?php else: ?>

										<p class="item-comment__text">
											<span class="comment-date"><?=timeAgo($comment['date_add'])?></span>
											<?=stripcslashes(nl2br($comment['text']))?>
										</p>

									<?php endif ?>

									<?php if ($key === count($comments['list']) - 1): // Close last comment container ?>
										</div>
									<?php endif ?>

								<?php endforeach ?>

								<?php
									// View html pagination
									viewPagination($comments['totalNum'], $commentsPerPage);
								?>

							<?php else: ?>

									<?php // HTML no result
										include 'block--no-result.php';
									?>

							<?php endif ?>
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>
</div>