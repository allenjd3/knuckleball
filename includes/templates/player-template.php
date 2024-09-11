<?php

use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player;

get_header();

/** @var Player $player */
$player = get_query_var('player');
?>
<div class="x-container max width offset">
	<h3><?= $player->name ?></h3>
	<img src="<?= $player->getAvatarUrl() ?>" alt="<?= $player->name ?>" class="avatar" />
</div>


<?php get_footer(); ?>
