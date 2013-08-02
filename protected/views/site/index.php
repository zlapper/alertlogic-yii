<section class="row">
	<form action="?" id="search-form" class="custom large-12 columns">
		<fieldset class="row">
			<legend>Search movies</legend>

			<div class="small-12 large-7 columns">
				<label for="q">Name:</label>
				<input type="text" name="q" id="q" value="<?php echo $_GET['q'] ?>">
			</div>

			<div class="small-12 large-3 columns">
				<label for="type">Type:</label>
				<select name="type" id="type" >
					<option value="person" <?php if ($type=='person') echo 'selected'; ?>>Actor/Actress</option>
					<option value="movie" <?php if ($type=='movie') echo 'selected'; ?>>Movie</option>
				</select>
			</div>

			<div class="small-12 large-2 columns">
				<input type="submit" class="button" value="Search">
			</div>
		</fieldset>
	</form>
</section>

<?php
	if ($query):
?>
<section class="row">
	<h2>Search Results</h2>
	<?php
		if ($type == 'person'):
			if ($actors):
				foreach ($actors as &$actor):
	?>
	<article class="actor result large-4 small-12 columns">
		<?php
				if ($actor->profile_path) {
					$img_url = $client->config->images->base_url . $client->config->images->profile_sizes[2] . $actor->profile_path;
				} else {
					$img_url = 'http://placehold.it/208x271/&amp;text=N/A';
				}
		?>
		<div class='panel'>
			<a href="index.php/site/person/?q=<?php echo $query; ?>&amp;id=<?php echo $actor->id; ?>">
				<img src="<?php echo $img_url; ?>" alt="<?php echo $actor->name; ?>">
				<h4><?php echo $actor->name; ?></h4>
			</a>
		</div>
	</article>
	<?php
				endforeach; // $actors
			else: // if ($actors)
	?>
	<p class="alert-box alert">We're sorry we couldn't find any actor/actress for "<?php echo $query; ?>"</p>
	<?php
			endif; // if ($actors)
		elseif ($type == 'movie'):
			if ($movies):
				foreach ($movies as $key=>$movie):
	?>
	<article class="movie result large-4 small-12 columns">
		<?php
				if ($movie->poster_path) {
					$img_url = $client->config->images->base_url . $client->config->images->poster_sizes[2] . $movie->poster_path;
				} else {
					$img_url = 'http://placehold.it/208x271/&amp;text=N/A';
				}
		?>
		<div class='panel'>
			<a href="index.php/site/movie/?q=<?php echo $query; ?>&amp;id=<?php echo $movie->id; ?>">
				<img src="<?php echo $img_url; ?>" alt="<?php echo $movie->title; ?>">
				<h4><?php echo $movie->title; ?></h4>
			</a>
			<dl>
				<?php if ($movie->release_date): ?><dt><i class="foundicon-calendar"></i> Release Date:</dt><dd><?php echo $movie->release_date; ?></dd><?php endif; ?>
				<?php if ($movie->original_title): ?><dt><i class="foundicon-globe"></i> Original Title:</dt><dd><?php echo $movie->original_title; ?></dd><?php endif; ?>
			</dl>
		</div>
	</article>
	<?php
					if ($key > 0 && ($key + 1) % 3 == 0) { echo '<hr/>'; };
				endforeach; // $movies
			else: // if ($movies)
	?>
	<p class="alert-box alert">We're sorry we couldn't find any movie for "<?php echo $query; ?>"</p>
	<?php
			endif; // if ($movies)
		endif; // $type
	?>
</section>
<?php
	endif; // if ($query)
?>
