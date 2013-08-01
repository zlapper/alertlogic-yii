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
	<aside class="actor small large-4 small-6 columns">
		<!-- <h3>Actor</h3> -->
		<?php
				if ($actor->profile_path) {
					$img_url = $client->config->images->base_url . $client->config->images->profile_sizes[2] . $actor->profile_path;
				} else {
					$img_url = 'http://placehold.it/208x271/&amp;text=N/A';
				}
		?>
		<div class='panel'>
			<a href="site/person/?q=<?php echo $_GET['q']; ?>&id=<?php echo $actor->id; ?>"><img src="<?php echo $img_url; ?>" alt="<?php echo $actor->name; ?>">
			<h4><?php echo $actor->name; ?></h4></a>
		</div>
	</aside>
	<?php
				endforeach; //actors
			else: // if ($actors)
	?>
	<p class="alert-box alert">We're sorry we couldn't find any actor/actress for "<?php echo $query; ?>"</p>
	<?php
			endif; // if ($actors)
			?>
</section>
<?php
		endif; // if ($type)
	endif; // if ($query)
?>
