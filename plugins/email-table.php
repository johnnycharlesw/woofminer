<?php

/** Get e-mail subject and message from database (Woofminer Editor)
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerEmailTable extends Woofminer\Plugin {
	protected $table, $id, $title, $subject, $message;

	/**
	* @param string $table quoted table name
	* @param string $id quoted column name
	* @param string $title quoted column name
	* @param string $subject quoted column name
	* @param string $message quoted column name
	*/
	function __construct($table = "email", $id = "id", $title = "subject", $subject = "subject", $message = "message") {
		$this->table = $table;
		$this->id = $id;
		$this->title = $title;
		$this->subject = $subject;
		$this->message = $message;
	}

	function selectEmailPrint($emailFields, $columns) {
		if ($emailFields) {
			Woofminer\print_fieldset("email", ('E-mail'));
			echo "<div>\n";
			echo Woofminer\script("qsl('div').onkeydown = partial(bodyKeydown, 'email');");
			echo "<p>" . ('From') . ": <input name='email_from' value='" . Woofminer\h($_POST ? $_POST["email_from"] : $_COOKIE["adminer_email"]) . "'>\n";
			echo ('Subject') . ": <select name='email_id'><option>" . Woofminer\optionlist(Woofminer\get_key_vals("SELECT $this->id, $this->title FROM $this->table ORDER BY $this->title"), $_POST["email_id"], true) . "</select>\n";
			echo "<p>" . ('Attachments') . ": <input type='file' name='email_files[]'>";
			echo Woofminer\script("qsl('input').onchange = function () {
	this.onchange = function () { };
	const el = this.cloneNode(true);
	el.value = '';
	this.parentNode.appendChild(el);
};");
			echo "<p>" . (count($emailFields) == 1 ? Woofminer\input_hidden("email_field", key($emailFields)) : Woofminer\html_select("email_field", $emailFields));
			echo "<input type='submit' name='email' value='" . ('Send') . "'>" . Woofminer\confirm();
			echo "</div>\n";
			echo "</div></fieldset>\n";
			return true;
		}
	}

	function selectEmailProcess($where, $foreignKeys) {
		if ($_POST["email_id"]) {
			$result = Woofminer\connection()->query("SELECT $this->subject, $this->message FROM $this->table WHERE $this->id = " . Woofminer\q($_POST["email_id"]));
			$row = $result->fetch_row();
			$_POST["email_subject"] = $row[0];
			$_POST["email_message"] = $row[1];
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Získá předmět a zprávu e-mailu z databáze (Woofminer Editor)'),
		'de' => array('' => 'E-Mail-Betreff und Nachricht aus der Datenbank abrufen (Woofminer Editor)'),
		'pl' => array('' => 'Pobieraj temat i wiadomość e-mail z bazy danych (Woofminer Editor)'),
		'ro' => array('' => 'Obțineți subiectul e-mailului și mesajul din baza de date (Woofminer Editor)'),
		'ja' => array('' => 'メールの件名と本文をデータベースから取得 (Woofminer Editor)'),
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
