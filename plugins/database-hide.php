<?php

/** Hide some databases from the interface - just to improve design, not a security plugin
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerDatabaseHide extends Woofminer\Plugin {
	protected $disabled;

	/**
	* @param list<string> $disabled case insensitive database names in values
	*/
	function __construct(array $disabled) {
		$this->disabled = array_map('strtolower', $disabled);
	}

	function databases($flush = true) {
		$return = array();
		foreach (Woofminer\get_databases($flush) as $db) {
			if (!in_array(strtolower($db), $this->disabled)) {
				$return[] = $db;
			}
		}
		return $return;
	}

	protected $translations = array(
		'cs' => array('' => 'Skryje některé databáze z rozhraní – pouze vylepší vzhled, nikoliv bezpečnost'),
		'de' => array('' => 'Verstecken Sie einige Datenbanken vor der Benutzeroberfläche – nur um das Design zu verbessern, verbessert nicht die Sicherheit'),
		'pl' => array('' => 'Ukryj niektóre bazy danych w interfejsie – tylko po to, aby ulepszyć motyw, a nie wtyczkę zabezpieczającą'),
		'ro' => array('' => 'Ascundeți unele baze de date din interfață - doar pentru a îmbunătăți designul, nu un plugin de securitate'),
		'ja' => array('' => '一部データベースを UI 上で表示禁止 (デザイン的な効果のみでセキュリティ的には効果なし)'),
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
