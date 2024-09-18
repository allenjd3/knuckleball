<?php

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Address;
use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player;

get_header();

/** @var Player $player */
$player = get_query_var('player');
/** @var Address $address */
$address = $player->getAddress();
?>
<div class="x-container max width offset">
	<div>
		<h3><?= $player->name ?></h3>
		<img src="<?= $player->getAvatarUrl() ?>" alt="<?= $player->name ?>" class="avatar" />
	</div>
	<div>
		<strong>Address</strong>
		<p>
			<?= $address->address_1 ?><br />
			<?php if ($address->address_2) : ?>
				<?= $address->address_2 ?><br />
			<?php endif; ?>
			<?= $address->city ?><br />
			<?= $address->state ?><br />
			<?= $address->postal_code ?><br />
		</p>
	</div>
	<div>
		<strong>Fees</strong>
	</div>
</div>


<?php get_footer(); ?>
