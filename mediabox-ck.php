<?php
/**
 * Plugin Name: Mediabox CK
 * Plugin URI: https://www.ceikay.com/en/wordpress-plugins/mediabox-ck
 * Description: Mediabox CK shows your medias in a nice responsive Lightbox. You can also use the lightbox on touch device to navigate through the medias, zoom and pan with your fingers.
 * Version: 1.1.3
 * Author: Cédric KEIFLIN
 * Author URI: https://www.ceikay.com/
 * Text Domain: mediabox-ck
 * Domain Path: /language
 * License: GPL2
 */

Namespace Mediaboxck;

defined('ABSPATH') or die;

if (! defined('CK_LOADED')) define('CK_LOADED', 1);
if (! defined('MEDIABOXCK_PLATFORM')) define('MEDIABOXCK_PLATFORM', 'wordpress');
if (! defined('MEDIABOXCK_PATH')) define('MEDIABOXCK_PATH', dirname(__FILE__));
if (! defined('MEDIABOXCK_MEDIA_PATH')) define('MEDIABOXCK_MEDIA_PATH', MEDIABOXCK_PATH);
if (! defined('MEDIABOXCK_ADMIN_GENERAL_URL')) define('MEDIABOXCK_ADMIN_GENERAL_URL', admin_url('', 'relative') . 'options-general.php?page=mediabox-ck');
if (! defined('MEDIABOXCK_MEDIA_URL')) define('MEDIABOXCK_MEDIA_URL', plugins_url('', __FILE__));
if (! defined('MEDIABOXCK_CEIKAY_MEDIA_URL')) define('MEDIABOXCK_CEIKAY_MEDIA_URL', 'https://media.ceikay.com');
if (! defined('MEDIABOXCK_SITE_ROOT')) define('MEDIABOXCK_SITE_ROOT', ABSPATH);
if (! defined('MEDIABOXCK_URI_ROOT')) define('MEDIABOXCK_URI_ROOT', site_url());
if (! defined('MEDIABOXCK_URI_BASE')) define('MEDIABOXCK_URI_BASE', admin_url('', 'relative'));
if (! defined('MEDIABOXCK_VERSION')) define('MEDIABOXCK_VERSION', '1.1.0');
if (! defined('MEDIABOXCK_PLUGIN_NAME')) define('MEDIABOXCK_PLUGIN_NAME', 'mediabox-ck');
if (! defined('MEDIABOXCK_SETTINGS_FIELD')) define('MEDIABOXCK_SETTINGS_FIELD', 'mediaboxck_options'); // shall be mediabox-ck_options but keep this notation for legacy purpose
if (! defined('MEDIABOXCK_WEBSITE')) define('MEDIABOXCK_WEBSITE', 'https://www.ceikay.com/plugins/mediabox-ck/');

class Mediaboxck {

	private static $instance;

	static function getInstance() { 
		if (!isset(self::$instance))
		{
			self::$instance = new self();
		}

		return self::$instance;
	}

	function init() {
		require_once('helpers/helper.php');
		$this->default_settings = Helper::getSettings();

		// load the translation
		add_action('plugins_loaded', array($this, 'load_textdomain'));

		register_setting(MEDIABOXCK_SETTINGS_FIELD, MEDIABOXCK_SETTINGS_FIELD);
		// set the entry in the database options table if not exists
		add_option(MEDIABOXCK_SETTINGS_FIELD, $this->default_settings );
		$this->options = get_option(MEDIABOXCK_SETTINGS_FIELD);

		if (is_admin()) {
			// add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 20 );
			// add the link in the plugins list
			add_filter( 'plugin_action_links', array( $this, 'show_plugin_links'), 10, 2 );
		} else {
			add_action('wp_footer', array( $this, 'load_inline_assets'));
			add_action('wp_enqueue_scripts', array( $this, 'load_assets'));
			add_action('init', array( $this, 'load_jquery'));
		}
		return;
	}

	function load_textdomain() {
		load_plugin_textdomain( 'mediabox-ck', false, dirname( plugin_basename( __FILE__ ) ) . '/language/'  );
	}

	/*function admin_init() {
		register_setting(MEDIABOXCK_SETTINGS_FIELD, MEDIABOXCK_SETTINGS_FIELD);
		// set the entry in the database options table if not exists
		add_option(MEDIABOXCK_SETTINGS_FIELD, $this->default_settings );
		$this->options = get_option(MEDIABOXCK_SETTINGS_FIELD);
	}*/

	function admin_menu() {
		if ( ! current_user_can('update_plugins') )
			return;

		// add a new submenu to the standard Settings panel
		$this->pagehook = add_options_page(
		__('Mediabox CK'), __('Mediabox CK'), 
		'administrator', MEDIABOXCK_PLUGIN_NAME, array($this,'render_options') );

		// executed on-load. Add all metaboxes and create the row in the options table
		add_action( 'load-' . $this->pagehook, array( $this, 'load_admin_assets' ) );
	}

	function show_plugin_links($links, $file) {
		if ($file == MEDIABOXCK_PLUGIN_NAME . '/' . MEDIABOXCK_PLUGIN_NAME . '.php') {
			array_push($links, '<a href="options-general.php?page=' . MEDIABOXCK_PLUGIN_NAME . '">'. __('Settings'). '</a>');
		}

		return $links;
	}

	public function load_admin_assets() {
		wp_enqueue_script(array('jquery', 'jquery-ui-tooltip'));
		wp_enqueue_style( 'ckframework', MEDIABOXCK_MEDIA_URL . '/assets/ckframework.css' );
		wp_enqueue_style( MEDIABOXCK_PLUGIN_NAME . '-admin', MEDIABOXCK_MEDIA_URL . '/assets/admin.css' );
	}

	public function render_options() {
		require_once(MEDIABOXCK_PATH . '/helpers/ckfields.php');
		$this->fields = new CKFields($this->options, MEDIABOXCK_SETTINGS_FIELD, $this->default_settings);
		$this->fields->load_assets_files();
		require_once(MEDIABOXCK_PATH . '/interfaces/options.php');
	}

	public function copyright() {
		$html = array();
		$html[] = '<hr style="margin:10px 0;clear:both;" />';
		$html[] = '<div class="ckpoweredby"><a href="https://www.ceikay.com" target="_blank">https://www.ceikay.com</a></div>';
		// $html[] = '<div class="ckproversioninfo"><div class="ckproversioninfo-title"><a href="' . COOKIESCK_WEBSITE . '" target="_blank">' . __('Get the Pro version', 'cookies-ck') . '</a></div>
		// <div class="ckproversioninfo-content">
			
// <p>Multiple positions</p>
// <p>Custom cookie duration</p>
// <p>Custom duration</p>
// <p>Read more attributes</p>
// <p>Styling interface</p>
// <div class="ckproversioninfo-button"><a href="' . COOKIESCK_WEBSITE . '" target="_blank">' . __('Get the Pro version', 'cookies-ck') . '</a></div>
		// </div>';

		return implode($html);
	}

	function load_jquery() {
		wp_enqueue_script('jquery');
	}

	function load_assets() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core ');
		wp_enqueue_style('mediaboxck', MEDIABOXCK_MEDIA_URL . '/assets/mediaboxck.css');
		wp_enqueue_script('mediaboxck', MEDIABOXCK_MEDIA_URL . '/assets/mediaboxck.min.js');
	}

	function load_inline_assets() {
		// mobile detection
		if (!class_exists('Mobile_Detect')) {
			require_once MEDIABOXCK_MEDIA_PATH . '/helpers/mobile_detect.php';
		}
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

		require_once(MEDIABOXCK_PATH . '/helpers/ckfields.php');
		$this->fields = new CKFields($this->options, MEDIABOXCK_SETTINGS_FIELD, $this->default_settings);

		$cornerradius = $this->fields->getValue('cornerradius', '10');
		$shadowoffset = $this->fields->getValue('shadowoffset', '5');
		$overlayopacity = $this->fields->getValue('overlayopacity', '0.7');
		$bgcolor = $this->fields->getValue('bgcolor', '#1a1a1a');
		$overlaycolor = $this->fields->getValue('overlaycolor', '#000');
		$text1color = $this->fields->getValue('text1color', '#999');
		$text2color = $this->fields->getValue('text2color', '#fff');
		$resizeopening = $this->fields->getValue('resizeopening', 'true');
		$resizeduration = $this->fields->getValue('resizeduration', '240');
		$initialwidth = $this->fields->getValue('initialwidth', '320');
		$initialheight = $this->fields->getValue('initialheight', '180');
		$defaultwidth = $this->fields->getValue('defaultwidth', '640');
		$defaultheight = $this->fields->getValue('defaultheight', '360');
		$showcaption = $this->fields->getValue('showcaption', 'true');
		$showcounter = $this->fields->getValue('showcounter', 'true');
		$attribtype = $this->fields->getValue('attribtype', 'rel');
		$attribname = $this->fields->getValue('attribname', 'lightbox');

		$css = "#mbCenter {
					background-color: ".$bgcolor.";
					-webkit-border-radius: ".$cornerradius."px;
					-khtml-border-radius: ".$cornerradius."px;
					-moz-border-radius: ".$cornerradius."px;
					border-radius: ".$cornerradius."px;
					-webkit-box-shadow: 0px ".$shadowoffset."px 20px rgba(0,0,0,0.50);
					-khtml-box-shadow: 0px ".$shadowoffset."px 20px rgba(0,0,0,0.50);
					-moz-box-shadow: 0px ".$shadowoffset."px 20px rgba(0,0,0,0.50);
					box-shadow: 0px ".$shadowoffset."px 20px rgba(0,0,0,0.50);
					/* For IE 8 */
					-ms-filter: \"progid:DXImageTransform.Microsoft.Shadow(Strength=".$shadowoffset.", Direction=180, Color='#000000')\";
					/* For IE 5.5 - 7 */
					filter: progid:DXImageTransform.Microsoft.Shadow(Strength=".$shadowoffset.", Direction=180, Color='#000000');
					}
					
					#mbOverlay {
						background-color: ".$overlaycolor.";
					}
					
					#mbCenter.mbLoading {
						background-color: ".$bgcolor.";
					}
					
					#mbBottom {
						color: ".$text1color.";
					}
					
					#mbTitle, #mbPrevLink, #mbNextLink, #mbCloseLink {
						color: ".$text2color.";
					}
				";
		?>
		<script type="text/javascript">
		Mediabox.scanPage = function() {
			var links = jQuery('a').filter(function(i) {
				if ( jQuery(this).attr('<?php echo ($attribtype == 'rel' ? 'rel' : 'class') ?>') 
						&& jQuery(this).attr('mediaboxck_done') != '1') {
					var patt = new RegExp(/^lightbox/i);
					return patt.test(jQuery(this).attr('<?php echo ($attribtype == 'rel' ? 'rel' : 'class') ?>'));
				}
			});
			if (! links.length) return;

			links.mediabox({
			overlayOpacity : 	<?php echo $overlayopacity ?>,
			resizeOpening : 	<?php echo $resizeopening ?>,
			resizeDuration : 	<?php echo $resizeduration ?>,
			initialWidth : 		<?php echo $initialwidth ?>,
			initialHeight : 	<?php echo $initialheight ?>,
			defaultWidth : 		<?php echo $defaultwidth ?>,
			defaultHeight : 	<?php echo $defaultheight ?>,
			showCaption : 		<?php echo $showcaption ?>,
			showCounter : 		<?php echo $showcounter ?>,
			loop : 				<?php echo $this->fields->getValue('loop', 'false') ?>,
			isMobileEnable: 	<?php echo $this->fields->getValue('mobile_enable', '1') ?>,
			mobileDetection: 	'<?php echo $this->fields->getValue('mobile_detectiontype', 'resolution') ?>',
			isMobile: 			<?php echo ($deviceType != 'computer' ? 'true' : 'false')  ?>,
			mobileResolution: 	'<?php echo $this->fields->getValue('mobile_resolution', '640') ?>',
			attribType :		'<?php echo ($attribtype == 'rel' ? 'rel' : 'class') ?>',
			playerpath: '<?php echo MEDIABOXCK_MEDIA_URL ?>/assets/NonverBlaster.swf'
			}, null, function(curlink, el) {
				var rel0 = curlink.<?php echo $attribtype ?>.replace(/[[]|]/gi," ");
				var relsize = rel0.split(" ");
				return (curlink == el) || ((curlink.<?php echo $attribtype ?>.length > <?php echo strlen($attribname) ?>) && el.<?php echo $attribtype ?>.match(relsize[1]));
			});
		};
		jQuery(document).ready(function(){ Mediabox.scanPage(); });
		</script>
		<style type="text/css">
		<?php echo $css; ?>
		</style>
	<?php }
}

// load the process
$Mediaboxck = Mediaboxck::getInstance();
$Mediaboxck->init();