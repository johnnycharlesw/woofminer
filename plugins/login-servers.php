<?php

/** Display constant list of servers in login form
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerLoginServers extends Woofminer\Plugin {
	protected $servers;

	/** Set supported servers
	* @param array{server:string, driver:string}[] $servers [$description => ["server" => , "driver" => "server|pgsql|sqlite|..."]], note that the driver for MySQL is called 'server'
	*/
	function __construct(array $servers) {
		$this->servers = $servers;
		if ($_POST["auth"]) {
			$key = $_POST["auth"]["server"];
			$_POST["auth"]["driver"] = $this->servers[$key]["driver"];
		}
	}

	function credentials() {
		return array($this->servers[Woofminer\SERVER]["server"], $_GET["username"], Woofminer\get_password());
	}

	function login($login, $password) {
		if (!$this->servers[Woofminer\SERVER]) {
			return false;
		}
	}

	function loginFormField($name, $heading, $value) {
		if ($name == 'driver') {
			return '';
		} elseif ($name == 'server') {
			return $heading . Woofminer\html_select("auth[server]", array_keys($this->servers), Woofminer\SERVER) . "\n";
		}
	}

	protected $translations = array(
		'cs' => array('' => 'V přihlašovacím formuláři zobrazuje předdefinovaný seznam serverů'),
		'de' => array('' => 'Anzeige einer konstanten Serverliste im Anmeldeformular'),
		'pl' => array('' => 'Wyświetlaj stałą listę serwerów w formularzu logowania'),
		'ro' => array('' => 'Afișarea unei liste constante de servere în formularul de conectare'),
		'ja' => array('' => 'ログイン画面に定義済のサーバリストを表示'),
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
