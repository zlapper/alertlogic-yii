<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<aside class="row">
	<header class="large-12 columns">
		<h1><?php echo $this->pageTitle; ?></h1>
	</header>

	<form action="?" id="search-form" class="large-12 columns">
		<fieldset class="row">
			<legend>Search movies</legend>

			<div class="small-12 large-2 columns">
				<label for="q" class="inline">Actor/Actress name:</label>
			</div>

			<div class="small-12 large-8 columns">
				<input type="text" name="q" id="q" value="<?php if (array_key_exists('q',$_GET)) { echo $_GET['q']; } ?>">
			</div>

			<div class="small-12 large-2 columns">
				<input type="submit" class="button postfix" value="Search">
			</div>
		</fieldset>
	</form>
</aside>
<section class="row">
	<?php
		if ($_GET && $_GET['q']) {
	?>
	<h2>Search Results</h2>
	<?php
			if ($movies) {
	?>

	<section id="movies" class="large-8 small-8 large-uncentered small-centered columns">
		<?php
			foreach ($movies as &$movie) {

				if ($movie->poster_path) {
					$img_url = $client->config->images->base_url . $client->config->images->poster_sizes[1] . $movie->poster_path;
				} else {
					$img_url = 'http://placehold.it/154x231/&amp;text=N/A';
				}

		?>
			<article class="row">
				<div class="large-3 columns">
					<img data-original="<?php echo $img_url; ?>" alt="<?php echo $movie->title; ?>" src="img/loader.gif">
				</div>
				<div class="large-9 columns">
					<header>
						<h3><?php echo $movie->title; ?></h3>
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
			}
		?>
	</section>
	<aside id="actor" class="large-3 small-4 large-uncentered small-centered columns panel">
		<?php
		if ($actor->profile_path) {
			$img_url = $client->config->images->base_url . $client->config->images->profile_sizes[2] . $actor->profile_path;
		} else {
			$img_url = 'http://placehold.it/208x271/&amp;text=N/A';
		}
		?>
		<img src="<?php echo $img_url; ?>" alt="<?php echo $actor->name; ?>">
		<h3><?php echo $actor->name; ?></h3>
	</aside>

	<?php
			} else {
	?>

	<p class="alert-box alert">We're sorry we couldn't find any results for "<?php echo $_GET['q']; ?>"</p>

	<?php

			}
		}
	?>
</section>
