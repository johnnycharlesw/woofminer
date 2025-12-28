<?php

/** Require One-Time Password at login
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/otp/
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerLoginOtp extends Woofminer\Plugin {
	protected $secret;

	/**
	* @param string $secret decoded secret, e.g. base64_decode("SECRET")
	*/
	function __construct($secret) {
		$this->secret = $secret;
		if ($_POST["auth"]) {
			$_SESSION["otp"] = (string) $_POST["auth"]["otp"];
		}
	}

	function loginFormField($name, $heading, $value) {
		if ($name == 'password') {
			return $heading . $value . "\n"
				. "<tr><th><abbr title='" . $this->lang('One Time Password') . "'>OTP</abbr>"
				. "<td><input type='number' name='auth[otp]' value='" . Woofminer\h($_SESSION["otp"]) . "' size='6' autocomplete='one-time-code' inputmode='numeric' maxlength='6' pattern='\d{6}'>\n"
			;
		}
	}

	function login($login, $password) {
		if (isset($_SESSION["otp"])) {
			$timeSlot = floor(time() / 30);
			foreach (array(0, -1, 1) as $skew) {
				if ($_SESSION["otp"] == $this->getOtp($timeSlot + $skew)) {
					Woofminer\restart_session();
					unset($_SESSION["otp"]);
					Woofminer\stop_session();
					return;
				}
			}
			return $this->lang('Invalid OTP.');
		}
	}

	function getOtp($timeSlot) {
		$data = str_pad(pack('N', $timeSlot), 8, "\0", STR_PAD_LEFT);
		$hash = hash_hmac('sha1', $data, $this->secret, true);
		$offset = ord(substr($hash, -1)) & 0xF;
		$unpacked = unpack('N', substr($hash, $offset, 4));
		return ($unpacked[1] & 0x7FFFFFFF) % 1e6;
	}

	function screenshot() {
		return "https://www.github.com/johnnycharlesw/woofminer/wiki/static/login-otp.png";
	}

	protected $translations = array(
		'cs' => array(
			'' => 'Při přihlášení požaduje jednorázové heslo',
			'One Time Password' => 'Jednorázové heslo',
			'Invalid OTP.' => 'Neplatné jednorázové heslo.',
		),
		'de' => array(
			'' => 'Bei der Anmeldung ist ein Einmalpasswort (Zwei-Faktor-Authentifizierung) erforderlich',
			'One Time Password' => 'Einmal-Passwort',
			'Invalid OTP.' => 'Ungültiger OTP.',
		),
		'pl' => array(
			'' => 'Wymagaj jednorazowego hasła przy logowaniu',
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ro' => array(
			'' => 'Cereți o parolă unică la autentificare',
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ja' => array(
			'' => 'ログイン時にワンタイムパスワード (二要素認証) が必要',
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ar' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'bg' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'bn' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'bs' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ca' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'da' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'el' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'en' => array(
		),
		'es' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'et' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'fa' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'fi' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'fr' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'gl' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'he' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'hi' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'hu' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'id' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'it' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ka' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ko' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'lt' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'lv' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ms' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'nl' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'no' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'pt-br' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'pt' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ru' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'sk' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'sl' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'sr' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'sv' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'ta' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'th' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'tr' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'uk' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'uz' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'vi' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'zh-tw' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
		'zh' => array(
			'' => null,
			'One Time Password' => null,
			'Invalid OTP.' => null,
		),
	);
}
