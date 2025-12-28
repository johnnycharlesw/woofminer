<?php

/** Set up driver, server and database to use with Woofminer Editor
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerEditorSetup extends Woofminer\Plugin {
	private $driver;
	private $server;
	private $database;

	/**
	* @param string $driver 'server' is MySQL, 'pgsql' is PostgreSQL, ...
	* @param string $server null means the default host, usually localhost
	* @param string $database null is the first available database
	*/
	function __construct($driver = 'server', $server = null, $database = null) {
		$this->driver = $driver;
		$this->server = $server;
		$this->database = $database;
	}

	function loginFormField($name, $heading, $value) {
		if ($name == 'username') {
			return $heading . str_replace("value='server'", "value='$this->driver'", $value) . "\n";
		}
	}

	function credentials() {
		return array($this->server, $_GET["username"], Woofminer\get_password());
	}

	function database() {
		if ($this->database) {
			return $this->database;
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Nastavit ovladač, server a databázi pro použití s Woofminer Editorem'),
		'de' => array('' => 'Treiber, Server und Datenbank für die Verwendung mit Woofminer Editor einrichten'),
		'ja' => array('' => 'Woofminer Editor で使用するドライバ、サーバ、データベースを設定'),
		'pl' => array('' => 'Konfiguruj sterownik, serwer i bazę danych do użycia z Woofminer Editorem'),
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
		'ro' => array('' => null),
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
