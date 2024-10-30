<div class="ckheading"><?php _e('Appearance', 'mediabox-ck') ?></div>
<div>
	<label for="<?php echo $this->fields->getId( 'cornerradius' ); ?>"><?php _e( 'Corner radius', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/border_radius_tl.png" />
	<?php echo $this->fields->render('text', 'cornerradius' ) ?>px
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'shadowoffset' ); ?>"><?php _e( 'Shadow width', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/shadow_blur.png" />
	<?php echo $this->fields->render('text', 'shadowoffset' ) ?>px
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'bgcolor' ); ?>"><?php _e( 'Background Color', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/color.png" />
	<?php echo $this->fields->render('color', 'bgcolor' ) ?>
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'overlaycolor' ); ?>"><?php _e( 'Overlay Color', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/color.png" />
	<?php echo $this->fields->render('color', 'overlaycolor' ) ?>
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'overlayopacity' ); ?>"><?php _e( 'Overlay opacity', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/shading.png" />
	<?php echo $this->fields->render('text', 'overlayopacity' ) ?>
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'text2color' ); ?>"><?php _e( 'Title Color', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/color.png" />
	<?php echo $this->fields->render('color', 'text2color' ) ?>
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'text1color' ); ?>"><?php _e( 'Description Color', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/color.png" />
	<?php echo $this->fields->render('color', 'text1color' ) ?>
</div>