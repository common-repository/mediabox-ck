<?php
/**
 * @copyright	Copyright (C) 2016. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		Plugins CK - Cédric KEIFLIN - https://www.ceikay.com
 */
Namespace Mediaboxck;

defined('ABSPATH') or die;

class Helper {

	public static $default_settings;

	public static function getSettings() {
		if (empty(self::$default_settings)) {
			$default_settings = array( 	
				'fxduration' => '300'
				,'attribtype' => 'rel'
				,'attribname' => 'lightbox'
				,'defaultwidth' => '640'
				,'defaultheight' => '360'
				,'showcaption' => '1'
				,'showcounter' => '1'
				,'loop' => '1'
				,'cornerradius' => '10'
				,'shadowoffset' => '5'
				,'bgcolor' => ''
				,'overlaycolor' => ''
				,'overlayopacity' => '0.7'
				,'text1color' => ''
				,'text2color' => ''
				,'resizeopening' => '1'
				,'resizeduration' => '240'
				,'initialwidth' => '320'
				,'initialheight' => '180'
				,'mobile_enable' => '1'
				,'mobile_detectiontype' => 'resolution'
				,'mobile_resolution' => '640'
			);
			self::$default_settings = $default_settings;
		}
		return self::$default_settings;
	}

	/**
	 * Test if there is already a unit, else add the px
	 *
	 * @param string $value
	 * @return string
	 */
	public static function testUnit($value) {
		if ((stristr($value, 'px')) OR (stristr($value, 'em')) OR (stristr($value, '%')) OR (stristr($value, 'auto')) ) {
			return $value;
		}

		if ($value == '') {
			$value = 0;
		}

		return $value . 'px';
	}
	
	/**
	 * Convert a hexa decimal color code to its RGB equivalent
	 *
	 * @param string $hexStr (hexadecimal color value)
	 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
	 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
	 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
	 */
	public static function hex2RGB($hexStr, $opacity) {
		if ($opacity > 1) $opacity = $opacity/100;
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
		$rgbArray = array();
		if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false; //Invalid hex color code
		}
		$rgbacolor = "rgba(" . $rgbArray['red'] . "," . $rgbArray['green'] . "," . $rgbArray['blue'] . "," . $opacity . ")";

		return $rgbacolor;
	}
}
