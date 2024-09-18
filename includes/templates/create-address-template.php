<?php
use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Team;
use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;

/** @var Collection $teams */
$teams ??= new Collection();
?>

<div>
	<?php
	$player = get_transient('player') ?: \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player::make([]);
	?>
	<form action="<?= admin_url('admin-post.php'); ?>" method="post">
		<input type="hidden" name="action" value="handle_create_player" />
		<div>
			<label>
				Name
				<input type="text" name="name" />
			</label>
			<?php
				$name = $player?->hasError('name') ? $player->errors['name'] : '';
				if ($name) :
			?>
				<div><?= $name ?></div>
			<?php endif; ?>
		</div>
		<div>
			<label>
				Team
				<select name="team_id">
					<?php foreach($teams->toArray() as $team) : ?>
						<option value="<?= $team->id ?>"><?= $team->name ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</div>
		<div>
			<button type="submit">Add Player</button>
		</div>
	</form>
</div>


<?php get_footer(); ?>
