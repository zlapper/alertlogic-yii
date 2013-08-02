<?php
if ($id):
	if ($person->id):
		if ($person->profile_path) {
			$img_url = $client->config->images->base_url . $client->config->images->profile_sizes[2] . $person->profile_path;
		} else {
			$img_url = 'http://placehold.it/208x271/&amp;text=N/A';
		}
?>
<article class="actor row">
	<header class="large-12 columns">
		<h2><?php echo $person->name; ?></h2>
	</header>
	<aside class="large-4 columns">
		<figure>
			<img src="<?php echo $img_url; ?>" alt="<?php echo $actor->name; ?>">
		</figure>
		<dl>
			<?php if ($person->place_of_birth): ?><dt><i class="foundicon-location"></i> Place of Birth:</dt><dd><?php echo $person->place_of_birth; ?></dd><?php endif; ?>
			<?php if ($person->birthday): ?><dt><i class="foundicon-calendar"></i> Birthday:</dt><dd><?php echo $person->birthday; ?></dd><?php endif; ?>
			<?php if ($person->deathday): ?><dt><i class="foundicon-plus"></i> Date of death:</dt><dd><?php echo $person->deathday; ?></dd><?php endif; ?>
			<?php if ($person->homepage): ?><dt><i class="foundicon-website"></i> Website:</dt><dd><?php echo $person->homepage; ?></dd><?php endif; ?>
		</dl>
	</aside>
	<section class="large-8 columns">
		<?php if ($person->biography): ?><p><?php echo nl2br($person->biography); ?></p><?php endif; ?>
	</section>
	<hr/>
</article>

<section class="movies row">
<h3>Movies</h3>
<?php
		if ($movies):
?>
	<?php
			foreach ($movies as &$movie):
				if ($movie->poster_path) {
					$img_url = $client->config->images->base_url . $client->config->images->poster_sizes[1] . $movie->poster_path;
				} else {
					$img_url = 'http://placehold.it/154x231/&amp;text=N/A';
				}
	?>
	<article class="movie row">
		<div class="large-3 columns">
			<img data-original="<?php echo $img_url; ?>" alt="<?php echo $movie->title; ?>" src="img/loader.gif">
		</div>
		<div class="large-9 columns">
			<header>
				<h4><?php echo $movie->title; ?></h4>
			</header>
			<section>
				<ul class="no-bullet">
					<?php if ($movie->release_date) { ?>
						<li>
							<i class="foundicon-calendar"></i>
							<strong>Release Date:</strong>
							<?php echo $movie->release_date; ?>
						</li>
					<?php } ?>
					<?php if ($movie->original_title) { ?>
						<li>
							<i class="foundicon-globe"></i>
							<strong>Original Title:</strong>
							<?php echo $movie->original_title; ?>
						</li>
					<?php } ?>
					<?php if ($movie->character) { ?>
						<li>
							<i class="foundicon-address-book"></i>
							<strong>Character:</strong>
							<?php echo $movie->character; ?>
						</li>
					<?php } ?>
				</ul>
			</section>
		</div>
	</article>
	<hr/>
	<?php
			endforeach; //movies
	?>
<?php
		else: //if ($movies)
?>
	<p class="alert-box alert">We're sorry we couldn't find any movies for "<?php echo $person->name; ?>".</p>
</section>
<?php
		endif; //if ($movies)
	else: //if ($person->id)
?>
	<p class="alert-box alert">We're sorry we couldn't find the actor/actress.</p>
<?
	endif; //if ($person->id)
else: //if ($id)
?>
<!-- //didnt send id, redirect to home -->
<?php
endif; //if ($id)
?>