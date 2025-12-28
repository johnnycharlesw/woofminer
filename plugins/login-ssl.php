<?php

/** Connect to MySQL, PostgreSQL or MS SQL using SSL
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerLoginSsl extends Woofminer\Plugin {
	protected $ssl;

	/**
	* MySQL: ["key" => filename, "cert" => filename, "ca" => filename, "verify" => bool]
	* PostgresSQL: ["mode" => sslmode] (https://www.postgresql.org/docs/current/libpq-connect.html#LIBPQ-CONNECT-SSLMODE)
	* MSSQL: ["Encrypt" => true, "TrustServerCertificate" => true] (https://learn.microsoft.com/en-us/sql/connect/php/connection-options)
	*/
	function __construct(array $ssl) {
		$this->ssl = $ssl;
	}

	function connectSsl() {
		return $this->ssl;
	}

	protected $translations = array(
		'cs' => array('' => 'Připojení k MySQL, PostgreSQL a MS SQL pomocí SSL'),
		'de' => array('' => 'Stellen Sie eine Verbindung zu MySQL, PostgreSQL, MS SQL über SSL her'),
		'pl' => array('' => 'Połącz się z MySQL, PostgreSQL, MS SQL za pomocą protokołu SSL'),
		'ro' => array('' => 'Conectați-vă la MySQL, PostgreSQL, MS SQL utilizând SSL'),
		'ja' => array('' => 'MySQL, PostgreSQL, MS SQL への接続時に SSL を利用'),
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
