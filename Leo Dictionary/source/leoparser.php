<?php
 
class LeoParser{
 
	protected $hitCount = 0;
	protected $leftHitCount = 0;
	protected $rightHitCount = 0;
	protected $queryWord;
	
	function get($input) {
		libxml_use_internal_errors( true );
		libxml_clear_errors();
 
		$xml = new SimpleXMLElement($input);
		$searchTag = $xml->xpath("/xml/search");
		
		$this->hitCount = intval($searchTag[0]->attributes()->hitcount);
		$this->leftHitCount = intval($searchTag[0]->attributes()->hitWordCntLeft);
		$this->rightHitCount = intval($searchTag[0]->attributes()->hitWordCntRight);
 
		$resultArray = array();
		$entries = $xml->xpath("//entry");
		foreach ($entries as $entry) {
			$this->parseEntry($entry, $resultArray);
		}
		return $resultArray;
	}
 
	function parseEntry($input, array & $resultArray) {
		$firstColumn = $input->side[0];
		$firstLanguage = (string) $firstColumn->attributes()->lang;
		$firstText = $firstColumn->words[0]->word;
		
		$secondColumn = $input->side[1];
		$secondLanguage = (string) $secondColumn->attributes()->lang;
		$secondText = $secondColumn->words[0]->word;

		// change input parsing for Chinese (different XML structure)
		if ($firstLanguage == 'ch') {
			$pinyin = isset($firstColumn->repr->cc->pn->b) ? $firstColumn->repr->cc->pn->b : $firstColumn->repr->cc->pn;
			$firstText = $firstText->cc->cs .' ('. $pinyin .')';
		}
		if ($secondLanguage == 'ch') {
			$pinyin = isset($firstColumn->repr->cc->pn->b) ? $firstColumn->repr->cc->pn->b : $firstColumn->repr->cc->pn;
			$secondText = $secondText->cc->cs .' ('. $pinyin .')';
		}
		
		if ($this->leftHitCount > $this->rightHitCount) {
			$originalWord = $firstText;
			$translatedWord = $secondText;
			$languageCode = $secondLanguage;
		} else {
			$originalWord = $secondText;
			$translatedWord = $firstText;
			$languageCode = $firstLanguage;
		}
		$resultEntry = new ParserResult();
		$resultEntry->originalWord = $originalWord;// utf8_decode(trim($originalWord));
		$resultEntry->translatedWord = $translatedWord;//utf8_decode(trim($translatedWord));
		$resultEntry->languageCode = $languageCode;
		
		array_push($resultArray, $resultEntry);
	}
 
}
 
class ParserResult {
	public $translatedWord = "";
	public $originalWord = "";
	public $languageCode = "";
}
 
?>
