<link rel="stylesheet" href="<?php echo MEDIABOXCK_MEDIA_URL ?>/assets/jscolor/jscolor.css" type="text/css" />
<script type="text/javascript" src="<?php echo MEDIABOXCK_MEDIA_URL ?>/assets/jscolor/jscolor.js"></script>
<div id="ckoptionswrapper" class="ckinterface">
	<a href="<?php echo MEDIABOXCK_WEBSITE ?>" target="_blank" style="text-decoration:none;"><img src="<?php echo MEDIABOXCK_MEDIA_URL ?>/images/logo_mediaboxck_64.png" style="margin: 5px;" class="cklogo" /><span class="cktitle">Mediabox CK</span></a>
	<div style="clear:both;"></div>
	<a class="button" href="https://www.ceikay.com/documentation/mediabox-ck/" target="_blank"><img src="https://media.ceikay.com/images/page_white_acrobat.png" width="16" height="16" /> <?php echo __('Documentation', 'mediabox-ck') ?></a>
	<form method="post" action="options.php">
		<div class="metabox-holder">
			<div class="nav-tab-wrapper">
				<a class="menulinkck nav-tab nav-tab-active" tab="tab_general" href="#"><?php _e('General','mediabox-ck'); ?></a>
				<a class="menulinkck nav-tab" tab="tab_styles" href="#"><?php _e('Styles','mediabox-ck'); ?></a>
				<a class="menulinkck nav-tab" tab="tab_effects" href="#"><?php echo _e('Effects', 'mediabox-ck'); ?></a>
				<a class="menulinkck nav-tab" tab="tab_mobile" href="#"><?php echo _e('Mobile', 'mediabox-ck'); ?></a>
			</div>
			<div class="tabck tab-active" id="tab_general">
				<div class="" style="width: 99%;">
				<?php 
					require_once(MEDIABOXCK_PATH . '/interfaces/options-general.php');
				?>
				</div>
			</div>
			<div class="tabck" id="tab_styles">
				<div class="" style="width: 99%;">
				<?php 
					require_once(MEDIABOXCK_PATH . '/interfaces/options-styles.php');
				?>
				</div>
			</div>
			<div class="tabck" id="tab_effects">
				<div class="" style="width: 99%;">
				<?php 
					require_once(MEDIABOXCK_PATH . '/interfaces/options-effects.php');
				?>
				</div>
			</div>
			<div class="tabck" id="tab_mobile">
				<div class="" style="width: 99%;">
				<?php 
					require_once(MEDIABOXCK_PATH . '/interfaces/options-mobile.php');
				?>
				</div>
			</div>
			<?php 
			settings_fields(MEDIABOXCK_SETTINGS_FIELD); 
			?>
		</div>
		<div>
			<input type="submit" class="button button-primary" name="save_options" value="<?php _e('Save Settings', 'tooltip-ck'); ?>" />
		</div>
	</form>
	<?php echo $this->copyright(); ?>
</div>
<!-- Needed to allow metabox layout and close functionality. -->
<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready( function ($) {
		create_nav_tabs($('#ckoptionswrapper'));
		$( '.hasTooltip' ).tooltip({ 
			close: function( event, ui ) {
				ui.tooltip.hide();
			},
			position: {
				my: "left bottom-10",
				at: "left top",
				using: function( position, feedback ) {
					$( this ).css( position );
				}
			},
			track: false,
			tooltipClass: "cktooltip"
		});
	});
	function create_nav_tabs(main) {
		jQuery('div.tabck:not(.tab-active)', main).hide();
		jQuery('.menulinkck', main).each(function(i, tab) {
			jQuery(tab).click(function() {
				jQuery('div.tabck', main).hide();
				jQuery('.menulinkck', main).removeClass('nav-tab-active');
				if (jQuery('#' + jQuery(tab).attr('tab')).length)
					jQuery('#' + jQuery(tab).attr('tab')).fadeIn();
				jQuery(this).addClass('nav-tab-active');
			});
		});
	}
	//]]>
</script>