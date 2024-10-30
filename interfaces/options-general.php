<div class="ckheading"><?php _e('Link detection', 'mediabox-ck') ?></div>
<div>
	<label for="<?php echo  $this->fields->getId( 'attribtype' ); ?>" class="hasTooltip" title="<?php _e( 'Set if you want to apply to the links that have for example : class=&quot;lightbox&quot; or rel=&quot;lightbox&quot;', 'mediabox-ck') ?>"><?php _e( 'Attribute detection', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/link.png" />
	<?php $options_attribtype = array(
		'className' => __('Class', 'mediabox-ck')
		, 'rel' => __('Rel', 'mediabox-ck')
		);
	?>
	<?php echo $this->fields->render('select', 'attribtype', null, $options_attribtype) ?>
</div>
<div>
	<label for="<?php echo  $this->fields->getId( 'attribname' ); ?>"><?php _e( 'Attribute name', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/link_edit.png" />
	<?php echo $this->fields->render('text', 'attribname') ?>
</div>
<div class="ckheading"><?php _e('Dimensions', 'mediabox-ck') ?></div>
<div>
	<label for="<?php echo  $this->fields->getId( 'defaultwidth' ); ?>"><?php _e( 'Default width', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/width.png" />
	<?php echo $this->fields->render('text', 'defaultwidth') ?>px
</div>
<div>
	<label for="<?php echo  $this->fields->getId( 'defaultheight' ); ?>"><?php _e( 'Default height', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/height.png" />
	<?php echo $this->fields->render('text', 'defaultheight') ?>px
</div>
<div class="ckheading"><?php _e('Display', 'mediabox-ck') ?></div>
<div>
	<label for="<?php echo  $this->fields->getId( 'showcaption' ); ?>" class="hasTooltip" title="<?php _e( 'Show the title attribute of the link as caption in the lightbox', 'mediabox-ck') ?>"><?php _e( 'Show caption', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/text_signature.png" />
	<?php echo $this->fields->render('radio', 'showcaption') ?>
</div>
<div>
	<label for="<?php echo  $this->fields->getId( 'showcounter' ); ?>" class="hasTooltip" title="<?php _e( 'Display the number of medias beside the caption', 'mediabox-ck') ?>"><?php _e( 'Show counter', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/book_open.png" />
	<?php echo $this->fields->render('radio', 'showcounter') ?>
</div>
<div>
	<label for="<?php echo  $this->fields->getId( 'loop' ); ?>" class="hasTooltip" title="<?php _e( 'If you click the next button on the last media, it comes back to the first one. Else the next button is not available', 'mediabox-ck') ?>"><?php _e( 'Loop medias', 'mediabox-ck'); ?></label>
	<img class="iconck" src="<?php echo MEDIABOXCK_CEIKAY_MEDIA_URL ?>/images/control_repeat.png" />
	<?php echo $this->fields->render('radio', 'loop') ?>
</div>