<?php

/** Specify timeout for running every query
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerTimeout extends Woofminer\Plugin {
	private $seconds;

	/**
	* @param int $seconds
	*/
	function __construct($seconds = 5) {
		$this->seconds = $seconds;
	}

	function afterConnect() {
		$seconds = Woofminer\get_setting("timeout", "adminer_config", $this->seconds);
		if ($seconds != '') {
			$ms = $seconds * 1000;
			$conn = Woofminer\connection();
			switch (Woofminer\JUSH) {
				case 'sql':
					$conn->query("SET max_execution_time = $ms");
					break;
				case 'pgsql':
					$conn->query("SET statement_timeout = $ms");
					break;
				case 'mssql':
					$conn->query("SET LOCK_TIMEOUT $ms");
					break;
				default:
					if (method_exists($conn, 'timeout')) {
						$conn->timeout($ms);
					}
			}
		}
	}

	function config() {
		$seconds = Woofminer\get_setting("timeout", "adminer_config", $this->seconds);
		return array($this->lang('Queries timeout') => '<input type="number" name="config[timeout]" min="0" value="' . Woofminer\h($seconds) . '" class="size"> ' . $this->lang('seconds'));
	}

	protected $translations = array(
		'cs' => array(
			'' => 'Nastaví timeout pro spouštění každého dotazu',
			'Queries timeout' => 'Timeout dotazů',
			'seconds' => 'sekund',
		),
		'ar' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'bg' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'bn' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'bs' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'ca' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'da' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'de' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'el' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'en' => array(
		),
		'es' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'et' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'fa' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'fi' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'fr' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'gl' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'he' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'hi' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'hu' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'id' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'it' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'ja' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'ka' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'ko' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'lt' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'lv' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'ms' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'nl' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'no' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'pl' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'pt-br' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'pt' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'ro' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'ru' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'sk' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'sl' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'sr' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'sv' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'ta' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'th' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'tr' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'uk' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'uz' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'vi' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'zh-tw' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
		'zh' => array(
			'' => null,
			'Queries timeout' => null,
			'seconds' => null,
		),
	);
}
