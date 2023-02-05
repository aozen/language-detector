<?php

namespace Aozen\LanguageDetector;

use Aozen\LanguageDetector\Characters;
use Aozen\LanguageDetector\DetectionResult;

require_once __DIR__ . '/Helpers.php';

class LanguageDetector
{
    protected $ascii_chars;

    public function __construct()
    {
        $this->ascii_chars = Characters::getAsciiChars();
    }

    /**
     * This method attempts to identify the language of an incoming string by 
     * splitting it into characters and comparing it to the non-ASCII characters
     * of each language in the availableLanguageList. The affinity of the string 
     * to each language is stored in an array. The final decision is made in the 
     * DetectionResult class, where the results are sent.
     * 
     * @param string $str
     * 
     * @return object DetectionResult object
     */
    public function detect(string $str)
    {
        removeWhitespaces($str); // Remove whitespaces
        $this->result = new \stdClass();
        $this->result->language_string = $str;
        $string_chars = splitStringIntoChars($this->result->language_string);
		$special_chars = array_diff($string_chars, $this->ascii_chars); // get all non-ASCII chars
		$this->result->special_char_count = count($special_chars); // count all non-ASCII chars
        if(empty($special_chars)) { // If there is no non-ASCII char send it DetectionResult class for returns "invalid language"
            return new DetectionResult($this->result);
        }

        $check_list = $this->createChecklist(); // List of chars to check for languages.
		foreach($check_list as $country_code => $speacial_country_chars) {
            // If a match is found with the letters in the checklist, it assigns it to the "matching_char_list" array.
			$this->result->matching_char_list[$country_code] = array_intersect($special_chars, $speacial_country_chars);
		}

        $this->sortMatchingCharList(); // matching_char_list is sorted according to the matching rate.

        return new DetectionResult($this->result);
    }

    /**
     * Generates a list of special characters
     * to be checked for each allowed language
     * 
     * @return array
     */
    private function createChecklist()
    {
        $check_list = [];
        foreach($this->availableLanguageList() as $language) {
            $check_list[$language] = $this->addToCheckList($language);
        }

        return $check_list;
    }

    /**
     * Returns an array of special characters specific to the language.
     * 
     * @param string $language
     * @return array
     */
    private function addToCheckList($language)
    {
        switch ($language) {
            case 'tr':
                $chars = Characters::getTurkishSpecialChars();
                break;
            case 'de':
                $chars = Characters::getGermanSpecialChars();
                break;
            case 'fr':
                $chars = Characters::getFrenchSpecialChars();
                break;
            case 'it':
                $chars = Characters::getItalianSpecialChars();
                break;
            case 'es':
                $chars = Characters::getSpanishSpecialChars();
                break;
            default:
                $chars = [];
                break;
        }
        return $chars;
    }

    /**
     * List of languages to be checked 
     * 
     * @return array
     */
    private function availableLanguageList()
    {
        return [
            'tr', //Turkish
            'de', //German
            'fr', //French
            'it', //Italian
            'es', //Spanish
        ];
    }

    /**
     * Sort the array so that the element
     * with the most items is at the top.
     * 
     * @return array
     */
    private function sortMatchingCharList()
    {
        array_multisort(array_map(function($element) {
            return count($element);
        }, $this->result->matching_char_list), SORT_DESC, $this->result->matching_char_list);
    }
}