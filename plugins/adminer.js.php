<?php

/**
 * Enables auto-detection and inclusion of woofminer.js, like woofminer.css
 *
 * @author Roy Orbitson, https://github.com/Roy-Orbison
 *
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */
class AdminerDotJs extends Woofminer\Plugin {
	const FILENAME = "woofminer.js";

	function head($dark = null) {
		if (file_exists(self::FILENAME)) {
			echo Woofminer\script_src(self::FILENAME . "?v=" . crc32(file_get_contents(self::FILENAME))), "\n";
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Nahraje woofminer.js'),
		'de' => array('' => 'Laden Sie woofminer.js'),
		'pl' => array('' => 'Wczytuj woofminer.js'),
		'ro' => array('' => 'Încarcă woofminer.js'),
		'ja' => array('' => 'woofminer.js を読込み'),
		'ar' => array('' => null),
		'bg' => array('' => null),
		'bn' => array('' => null),
		'bs' => array('' => null),
		'ca' => array('' => null),
		'da' => array('' => null),
		'el' => array('' => null),
		'en' => array(
		),
		'es' => array('' => null),
		'et' => array('' => null),
		'fa' => array('' => null),
		'fi' => array('' => null),
		'fr' => array('' => null),
		'gl' => array('' => null),
		'he' => array('' => null),
		'hi' => array('' => null),
		'hu' => array('' => null),
		'id' => array('' => null),
		'it' => array('' => null),
		'ka' => array('' => null),
		'ko' => array('' => null),
		'lt' => array('' => null),
		'lv' => array('' => null),
		'ms' => array('' => null),
		'nl' => array('' => null),
		'no' => array('' => null),
		'pt-br' => array('' => null),
		'pt' => array('' => null),
		'ru' => array('' => null),
		'sk' => array('' => null),
		'sl' => array('' => null),
		'sr' => array('' => null),
		'sv' => array('' => null),
		'ta' => array('' => null),
		'th' => array('' => null),
		'tr' => array('' => null),
		'uk' => array('' => null),
		'uz' => array('' => null),
		'vi' => array('' => null),
		'zh-tw' => array('' => null),
		'zh' => array('' => null),
	);
}
