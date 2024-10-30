<div>
	<label for="<?php echo $this->fields->getId( 'resizeopening' ); ?>" class="hasTooltip" title="<?php _e( 'Resize the lightbox from the following values to the media width when it opens', 'mediabox-ck') ?>"><?php _e( 'Resize transition', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/shape_handles.png" />
	<?php echo $this->fields->render('radio', 'resizeopening') ?>
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'resizeduration' ); ?>"><?php _e( 'Resize duration', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/hourglass.png" />
	<?php echo $this->fields->render('text', 'resizeduration' ) ?>ms
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'initialwidth' ); ?>"><?php _e( 'Initial width', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/width.png" />
	<?php echo $this->fields->render('text', 'initialwidth' ) ?>px
</div>
<div>
	<label for="<?php echo $this->fields->getId( 'initialheight' ); ?>"><?php _e( 'Initial height', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/height.png" />
	<?php echo $this->fields->render('text', 'initialheight' ) ?>px
</div>