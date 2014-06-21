<?php
require('utils.php');
require('leoparser.php');
require('workflows.php');

class Leo {
	
	private $translationCode;
	
	function __construct($translationCode) {
		$this->translationCode = $translationCode;
	}
	
	function getTranslations($input) {
		$w = new Workflows("psistorm.alfed.leo");
		$leo = new LeoParser();

		$cleanedInput = clean_utf8($input);
		$url = "http://dict.leo.org/".$this->translationCode."/?lang=en&searchLoc=0&search=".urlencode($cleanedInput);

		$str = $w->request($url, array(CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 5));
		if (!empty($str)) {
			$options = $leo->get($str);
		
			if ($options != array()) {
				foreach($options as $option) {
					$w->result(time(), "{".$this->translationCode."}".$option->translatedWord, $option->translatedWord, $option->originalWord, $option->languageCode.".png", "yes", $option->originalWord);
				}
			}
		} else {
			$w->result(time(), "", "Timeout occurred.", $option->originalWord, "icon.png", "no");
		}
		return $w->toxml();
	}
}

?>