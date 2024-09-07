<?php
use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;
use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player;

get_header();
$players ??= new Collection();
?>

<div style="display: flex; gap: 1em;">
<?php foreach ($players->toArray() as $player): ?>
	<?php /** @var Player $player */ ?>
	<div style="display: flex; flex-direction: column; align-items: center;">
		<img src="<?= $player->getAvatarUrl() ?>" alt="<?= $player->name ?>" class="avatar" />
		<a href="<?= $player->getPath() ?>"><?= $player->name ?></a>
	</div>
<?php endforeach; ?>
</div>

<div class="x-container max width offset">
	<article class="entry-wrap center">
		<form method="get">
			<label for="search-player" class="sr-only">Search</label>
			<input id="search-player" name="search" type="text" placeholder="search for a player" />
			<button type="submit">Search</button>
		</form>
	</article>
</div>

<?php get_footer(); ?>
