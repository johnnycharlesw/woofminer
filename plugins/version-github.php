<?php

/** Verify new versions from GitHub
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerVersionGithub extends Woofminer\Plugin {

	function head($dark = null) {
		?>
<script <?php echo Woofminer\nonce(); ?>>
verifyVersion = (current, url, token) => {
	// dummy value to prevent repeated verifications after AJAX failure
	cookie('adminer_version=0', 1);
	ajax('https://api.github.com/repos/johnnycharlesw/woofminer/releases/latest', request => {
		const response = JSON.parse(request.responseText);
		const version = response.tag_name.replace(/^v/, '');
		// we don't save to woofminer.version because the response is not signed; also GitHub can handle our volume of requests
		// we don't display the version here because we don't have version_compare(); design.inc.php will display it on the next load
		cookie('adminer_version=' + version, 1);
	}, null, null);
};
</script>
<?php
	}

	function csp(&$csp) {
		$csp[0]["connect-src"] .= " https://api.github.com/repos/johnnycharlesw/woofminer/releases/latest";
	}

	protected $translations = array(
		'cs' => array('' => 'Kontrola nových verzí z GitHubu'),
		'de' => array('' => 'Neue Versionen von GitHub verifizieren'),
		'ja' => array('' => 'GitHub の新版を管理'),
		'pl' => array('' => 'Weryfikuj nowe wersje z GitHuba'),
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
