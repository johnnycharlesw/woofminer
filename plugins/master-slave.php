<?php

/** Execute writes on master and reads on slave
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerMasterSlave extends Woofminer\Plugin {
	private $masters = array();

	/**
	* @param string[] $masters [$slave => $master]
	*/
	function __construct(array $masters) {
		$this->masters = $masters;
	}

	function credentials() {
		if ($_POST && isset($this->masters[Woofminer\SERVER])) {
			return array($this->masters[Woofminer\SERVER], $_GET["username"], Woofminer\get_session("pwds"));
		}
	}

	function login($login, $password) {
		if (!$_POST && ($master = &$_SESSION["master"])) {
			Woofminer\connection()->query("DO MASTER_POS_WAIT('" . Woofminer\q($master['File']) . "', $master[Position])");
			$master = null;
		}
	}

	function messageQuery($query, $time, $failed = false) {
		//! doesn't work with sql.inc.php
		$result = Woofminer\connection()->query('SHOW MASTER STATUS');
		if ($result) {
			Woofminer\restart_session();
			$_SESSION["master"] = $result->fetch_assoc();
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Zápisy provádět na masteru a čtení na slave'),
		'de' => array('' => 'Schreibvorgänge auf dem Master und Lesevorgänge auf dem Slave ausführen'),
		'pl' => array('' => 'Wykonuje zapisy na komputerze głównym i odczyty na komputerze podrzędnym'),
		'ro' => array('' => 'Executarea scrierilor pe master și a citirilor pe slave'),
		'ja' => array('' => 'マスタ書込みとスレーブ読込みの有効化'),
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
