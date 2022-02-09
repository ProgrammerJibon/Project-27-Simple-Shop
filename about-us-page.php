<div class="container my-5">
	<h5>
		<b><?php echo t(2)[$l]; ?></b>
	</h5>
	<div class="p-3 card" style="font-weight: 600; font-size: 14px;">
		<div style="margin-top: 8px; font-size: 15px; font-weight: bold;"><?php echo t(12)[$l]; ?>: </div>
		<div><?php echo site_info('intro'); ?></div>
		<div style="margin-top: 8px; font-size: 15px; font-weight: bold;"><?php echo t(13)[$l]; ?>: </div>
		<div><?php echo site_info('address'); ?></div>
		<div style="margin-top: 8px; font-size: 15px; font-weight: bold;"><?php echo t(14)[$l]; ?>: </div>
		<div><div><?php echo site_info('owner'); ?></div></div>
		<div style="margin-top: 8px; font-size: 15px; font-weight: bold;"><?php echo t(10)[$l]; ?>: </div>
		<div><?php echo t(15)[$l]; ?>: <?php echo site_info('phone'); ?></div>
		<div><?php echo t(16)[$l]; ?>: <?php echo site_info('email'); ?></div>
		<div><?php echo t(17)[$l]; ?>: <?php echo site_info('tax_id'); ?></div>
		<div><?php echo t(18)[$l]; ?>: <?php echo site_info('vat_id'); ?></div>
		<div style="margin-top: 8px; font-size: 15px; font-weight: bold;"><?php echo t(19)[$l]; ?>:</div>
		<div>
			<?php echo site_info('bank_details'); ?>
		</div>
	</div>
</div>