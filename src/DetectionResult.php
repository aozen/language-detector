<?php

namespace Aozen\LanguageDetector;

use Aozen\LanguageDetector\Characters;

class DetectionResult
{

    private $result = [];

    /**
     * The $result object holds information about:
     *  -matching_char_list (array): A multidimensional array that keeps 
     *   track of the number of special characters for each language. 
     *   Key is the language code, value is an array of matching  special characters. 
     *   For example, if the string is "türkçe", 
     *   matching_char_list["tr"][1] = ü, matching_char_list["tr"][4] = ç, 
     *   matching_char_list["de"][1] = ü
     *  -(string)language_string : The detecting string expression.
     *  -special_char_count: The total number of non-ASCII characters 
     *   detected in the string. For example, "gülünç" => 3 (ü,ü,ç)
     * 
     * @param object $result
     */
    public function __construct(object $result)
    {
        $this->result = $result;
    }

    /**
     * Detects the language of a string
     * Returns language code for 100% match, "en" for ASCII chars, 
     * "invalid_language" otherwise.
     * 
     * @return string "en", {language_code}, "invalid_language"
     */
    public function getLanguage()
    {
        if(empty($this->result->matching_char_list) && $this->result->special_char_count == 0) {
            return "en";
        }

        $this->result->matching_char_list = array_filter($this->result->matching_char_list, function ($item) {
            return count($item) > 0;
        });

        if(count($this->result->matching_char_list) == 0) {
            return "invalid_language";
        }

        if(key($this->result->matching_char_list) && count(reset($this->result->matching_char_list)) == $this->result->special_char_count) {
            return (string) key($this->result->matching_char_list);
        }

        return "invalid_language";
    }

    /**
    * Language codes to be checked
    * Example: ->checkList(["tr", "de"])
    *
    * @param array $check_list
    * @return object DetectionResult object
    */
    public function checkList(array $check_list)
    {
        $this->result->matching_char_list = array_intersect_key($this->result->matching_char_list, array_flip($check_list));
        return new DetectionResult($this->result);
    }

    /**
    * Language codes to be checked
    * Example: ->blockList(["tr", "de"])
    *
    * @param array $block_list
    * @return object DetectionResult object
    */
    public function blockList(array $block_list)
    {
        $this->result->matching_char_list = array_diff_key($this->result->matching_char_list, array_flip($block_list));
        return new DetectionResult($this->result);
    }

    /**
    * Detects the closest language to the language_string and performs lowercase in that language.
    * 1. Detects the closest language to the language_string.
    * 2. Performs lowercase in the language.
    * 3. Applies mb_strtolower.
    * Example:
    * -1. Step: "ÖPÜŞMEK" => tr
    * -2. Step: language-specific lowercase: "öPüşMEK
    * -3. Step: Apply lowercase to the remaining characters: "öpüşmek"
    *
    * @return string The language_string property.
    */
    public function getLowerCase()
    {
        $language = DetectionResult::getClosestLanguage();
        switch ($language) {
            case 'tr':
                $lower_case_pairs = Characters::getTurkishLowerCase();
                break;
            case 'de':
                $lower_case_pairs = Characters::getGermanLowerCase();
                break;
            case 'fr':
                $lower_case_pairs = Characters::getFrenchLowerCase();
                break;
            case 'it':
                $lower_case_pairs = Characters::getItalianLowerCase();
                break;
            case 'es':
                $lower_case_pairs = Characters::getSpanishLowerCase();
                break;
            default:
                $lower_case_pairs = [];
                break;
        }

        foreach($lower_case_pairs as $char_from => $char_to) {
            $this->result->language_string = str_replace($char_from, $char_to, $this->result->language_string);
        }

        $this->result->language_string = mb_strtolower($this->result->language_string);

        return $this->result->language_string;
    }

    /**
    * Returns the potential closest language if the language string could not be identified with 100% certainty.
    *
    * If the getLanguage method returns "invalid_language", this method returns the potential closest language.
    * This occurs when the language string could not be matched with a language with 100% certainty.
    *
    * @return string
    */
    public function getClosestLanguage()
    {
        $language = DetectionResult::getLanguage();
        if($language == "invalid_language") {
            return (string) key($this->result->matching_char_list);
        }
        return $language;
    }
}
