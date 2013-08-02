<?php
if ($id):
	if ($movie->id):
		if ($movie->poster_path) {
			$img_url = $client->config->images->base_url . $client->config->images->poster_sizes[3] . $movie->poster_path;
		} else {
			$img_url = 'http://placehold.it/208x271/&amp;text=N/A';
		}
?>
<article class="movie row">
	<header class="large-12 columns">
		<h2><?php echo $movie->title; ?></h2>
	</header>
	<aside class="large-4 columns">
		<figure>
			<img src="<?php echo $img_url; ?>" alt="<?php echo $actor->name; ?>">
		</figure>
		<dl>
			<?php if ($movie->status): ?><dt><i class="foundicon-compass"></i> Status:</dt><dd><?php echo $movie->status; ?></dd><?php endif; ?>
			<?php if ($movie->release_date): ?><dt><i class="foundicon-calendar"></i> Release Date:</dt><dd><?php echo $movie->release_date; ?></dd><?php endif; ?>
			<?php if ($movie->original_title): ?><dt><i class="foundicon-globe"></i> Original Title:</dt><dd><?php echo $movie->original_title; ?></dd><?php endif; ?>
		</dl>
	</aside>
	<section class="large-8 columns">
		<?php if ($movie->overview): ?><p><?php echo nl2br($movie->overview); ?></p><?php endif; ?>
	</section>
	<hr/>
	<?php //var_dump($movie); ?>
</article>

<?php
	else: //if ($movie->id)
?>
	<p class="alert-box alert">We're sorry we couldn't find the movie.</p>
<?
	endif; //if ($movie->id)
else: //if ($id)
?>
<!-- //didnt send id, redirect to home -->
<?php
endif; //if ($id)
?>