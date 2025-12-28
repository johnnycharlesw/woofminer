<?php

/** Enable login without password
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerLoginPasswordLess extends Woofminer\Plugin {
	protected $password_hash;

	/** Set allowed password
	* @param string $password_hash result of password_hash()
	*/
	function __construct($password_hash) {
		$this->password_hash = $password_hash;
	}

	function credentials() {
		$password = Woofminer\get_password();
		return array(Woofminer\SERVER, $_GET["username"], (password_verify($password, $this->password_hash) ? "" : $password));
	}

	function login($login, $password) {
		if ($password != "") {
			return true;
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Povolí přihlášení bez hesla'),
		'de' => array('' => 'Ermöglicht die Anmeldung ohne Passwort'),
		'pl' => array('' => 'Włącz logowanie bez hasła'),
		'ro' => array('' => 'Activați autentificarea fără parolă'),
		'ja' => array('' => 'パスワードなしのログインを許可'),
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
