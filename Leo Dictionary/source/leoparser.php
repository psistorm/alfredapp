<?php

class LeoParser{

	function get($input) {
		libxml_use_internal_errors( true );
		libxml_clear_errors();

		$doc = new DOMDocument();
		$doc->loadHtml($input);
		$xpath = new DOMXPath($doc);
		$entries = $xpath->query("//entry");

		$resultArray = array();
		foreach ($entries as $entry) {
			$this->parseEntry($doc->saveHtml($entry), $resultArray);
		}
		return $resultArray;
	}

	function parseEntry($input, array & $resultArray) {
		$wordDoc = new DOMDocument();
		$wordDoc->loadHtml($input);
		$wordXPath = new DOMXPath($wordDoc);
		$secondColumn = $wordXPath->query('//side[@hc="0"]');
		$entries = $wordXPath->query('//side/words/word');
		$output = "";

		$resultEntry = new ParserResult();

		$languageCode = $secondColumn->item(0)->getAttribute("lang");
		$resultEntry->languageCode = $languageCode;

		if ($languageCode == 'de') {
			$translatedWord = $entries->item(1)->nodeValue;
			$originalWord   = $entries->item(0)->nodeValue;
		} else {
			$translatedWord = $entries->item(0)->nodeValue;
			$originalWord   = $entries->item(1)->nodeValue;
		}

		$resultEntry->originalWord = utf8_decode(trim($originalWord));
		$resultEntry->translatedWord = utf8_decode(trim($translatedWord));

		array_push($resultArray, $resultEntry);
	}

	function getLanguageCode(DOMElement $element) {
		return $element->getAttribute("lang");
	}

}

class ParserResult {
	public $translatedWord = "";
	public $originalWord = "";
	public $languageCode = "";
}

?>