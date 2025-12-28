<?php

/** Check IP address and allow empty password
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerLoginIp extends Woofminer\Plugin {
	protected $ips, $forwarded_for;

	/** Set allowed IP addresses
	* @param list<string> $ips IP address prefixes
	* @param list<string> $forwarded_for X-Forwarded-For prefixes if IP address matches, empty array means anything
	*/
	function __construct(array $ips, array $forwarded_for = array()) {
		$this->ips = $ips;
		$this->forwarded_for= $forwarded_for;
	}

	function login($login, $password) {
		foreach ($this->ips as $ip) {
			if (strncasecmp($_SERVER["REMOTE_ADDR"], $ip, strlen($ip)) == 0) {
				if (!$this->forwarded_for) {
					return true;
				}
				if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
					foreach ($this->forwarded_for as $forwarded_for) {
						if (strncasecmp(preg_replace('~.*, *~', '', $_SERVER["HTTP_X_FORWARDED_FOR"]), $forwarded_for, strlen($forwarded_for)) == 0) {
							return true;
						}
					}
				}
			}
		}
		return false;
	}

	protected $translations = array(
		'cs' => array('' => 'Zkontroluje IP adresu a povolí prázdné heslo'),
		'de' => array('' => 'Überprüft die IP-Adresse und lässt ein leeres Passwort zu'),
		'pl' => array('' => 'Sprawdzaj adres IP i zezwakaj na puste hasło'),
		'ro' => array('' => 'Verificați adresa IP și permiteți parola goală'),
		'ja' => array('' => 'IP アドレスの確認、及び空パスワードの許可'),
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
