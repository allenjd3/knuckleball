<?php
use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Team;
use \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;

/** @var Collection $teams */
$teams ??= new Collection();
?>

<div>
	<?php
	$address = get_transient('address') ?: \Ohio_Tokyo_International_Sea_Monster_Society\Entities\Address::make([]);
	?>

	<form action="<?= admin_url('admin-post.php'); ?>" method="post">
		<input type="hidden" name="action" value="handle_create_address" />
		<div>
			<label>
				Address 1
				<input type="text" name="address_1" />
			</label>
			<?php
				$address_1 = $address?->hasError('address_1') ? $address->errors['address_1'] : '';
				if ($address_1) :
			?>
				<div><?= $address_1 ?></div>
			<?php endif; ?>
		</div>
		<div>
			<label>
				Address 2
				<input type="text" name="address_2" />
			</label>
			<?php
			$address_2 = $address?->hasError('address_2') ? $address->errors['address_2'] : '';
			if ($address_2) :
				?>
				<div><?= $address_2 ?></div>
			<?php endif; ?>
		</div>
		<div>
			<label>
				City
				<input type="text" name="city" />
			</label>
			<?php
			$city = $address?->hasError('city') ? $address->errors['city'] : '';
			if ($city) :
				?>
				<div><?= $city ?></div>
			<?php endif; ?>
		</div>
		<div>
			<label>
				State
				<input type="text" name="state" />
			</label>
			<?php
			$state = $address?->hasError('state') ? $address->errors['state'] : '';
			if ($state) :
				?>
				<div><?= $state ?></div>
			<?php endif; ?>
		</div>
		<div>
			<label>
				Postal Code
				<input type="text" name="postal_code" />
			</label>
			<?php
			$postal_code = $address?->hasError('postal_code') ? $address->errors['postal_code'] : '';
			if ($postal_code) :
				?>
				<div><?= $postal_code ?></div>
			<?php endif; ?>
		</div>
		<div>
			<button type="submit">Add Address</button>
		</div>
	</form>
</div>


<?php get_footer(); ?>
