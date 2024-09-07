<?php

use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player;

get_header();
?>

<?php

/** @var Player $player */
$player = get_query_var('player');
?>
<div>
	<h3><?= $player->name ?></h3>
	<img src="<?= $player->getAvatarUrl() ?>" alt="<?= $player->name ?>" class="avatar" />
</div>


<?php get_footer(); ?>
