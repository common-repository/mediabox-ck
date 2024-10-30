<div>
	<label for="<?php echo $this->fields->getId( 'mobile_enable' ); ?>" class="hasTooltip" title="<?php _e( 'Switch to a specific layout with full screen for mobile', 'mediabox-ck') ?>"><?php _e( 'Enable for mobile', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/ipod.png" />
	<?php echo $this->fields->render('radio', 'mobile_enable') ?>
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'mobile_detectiontype' ); ?>"><?php _e( 'Detection type', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/wrench_orange.png" />
	<?php $options_attribtype = array(
		'resolution' => __('Resolution')
		, 'tablet' => __('Tablet')
		, 'phone' => __('Phone')
		);
	?>
	<?php echo $this->fields->render('select', 'mobile_detectiontype', null, $options_attribtype) ?>
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'mobile_resolution' ); ?>"><?php _e( 'Mobile resolution', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/width.png" />
	<?php echo $this->fields->render('text', 'mobile_resolution' ) ?>px
</div>