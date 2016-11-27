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
		$url = "https://dict.leo.org/dictQuery/m-vocab/".$this->translationCode."/query.xml?tolerMode=nof&lp=".$this->translationCode."&lang=de&rmWords=off&directN=0&rmSearch=on&search=".urlencode($cleanedInput)."&searchLoc=0&resultOrder=basic&multiwordShowSingle=on&sectLenMax=16";

		$str = $w->request($url, array(CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 5));
		if (!empty($str)) {
			$options = $leo->get($str);

			if ($options != array()) {
				foreach($options as $option) {
					$argument = "{".$this->translationCode."}{".$option->originalWord."}{".$option->translatedWord."}";
					$w->result(time(), $argument, $option->translatedWord, $option->originalWord, $option->languageCode.".png", "yes", $option->originalWord);
				}
			}
		} else {
			$w->result(time(), "", "Timeout occurred.", $option->originalWord, "icon.png", "no");
		}
		return $w->toxml();
	}
}

?>