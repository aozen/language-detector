<?php

namespace Aozen\LanguageDetector;

class Characters
{
    /**
     * ASCII Char List
     * A-Za-z0-9
     * 
     * @return array
     */
    public static function getAsciiChars()
    {
        return ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
                '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-'];
    }

    /**
     * Non-ASCII Turkish chars
     * 
     * @return array
     */
    public static function getTurkishSpecialChars()
    {
        return ['Ö', 'ö', 'Ç', 'ç', 'Ş', 'ş', 'İ', 'ı', 'Ğ', 'ğ', 'Ü', 'ü'];
    }

    /**
     * Turkish Uppercase to Lowercase
     * 
     * @return array
     */
    public static function getTurkishLowerCase() {
        return [
            'I' => 'ı',
            'İ' => 'İ',
            'Ğ' => 'ğ',
            'Ü' => 'ü',
            'Ş' => 'ş',
            'Ç' => 'ç',
            'Ö' => 'ö',
        ];
    }

    /**
     * Non-ASCII German chars
     * 
     * @return array
     */
    public static function getGermanSpecialChars()
    {
        return ['Ä', 'Ö', 'Ü', 'ß', 'ä', 'ö', 'ü'];
    }

    /**
     * German Uppercase to Lowercase
     * 
     * @return array
     */
    public static function getGermanLowerCase() {
        return [
            'Ä' => 'ä',
            'Ö' => 'ö',
            'Ü' => 'ü',
            'ß' => 'ss',
        ];
    }

    /**
     * Non-ASCII French chars
     * 
     * @return array
     */
    public static function getFrenchSpecialChars() {
        return ['À', 'Â', 'Æ', 'Ç', 'É', 'È', 'Ê', 'Ë', 'Î', 'Ï', 'Ô', 'Œ', 'Ù', 'Û', 'Ü', 'Ÿ', 'à', 'â', 'æ', 'ç', 'é', 'è', 'ê', 'ë', 'î', 'ï', 'ô', 'œ', 'ù', 'û', 'ü', 'ÿ'];
    }
    
    /**
     * Spanish Uppercase to Lowercase
     * 
     * @return array
     */
    public static function getFrenchLowerCase() {
        return [
            'À' => 'à',
            'Â' => 'â',
            'Æ' => 'æ',
            'Ç' => 'ç',
            'É' => 'é',
            'È' => 'è',
            'Ê' => 'ê',
            'Ë' => 'ë',
            'Î' => 'î',
            'Ï' => 'ï',
            'Ô' => 'ô',
            'Œ' => 'œ',
            'Ù' => 'ù',
            'Û' => 'û',
            'Ü' => 'ü',
            'Ÿ' => 'ÿ',
        ];
    }

    /**
     * Non-ASCII Italian chars
     * 
     * @return array
     */
    public static function getItalianSpecialChars()
    {
        return ['À','È','É','Ì','Í','Ò','Ó','Ù','Ú','à', 'è', 'é', 'ì', 'í', 'ò', 'ó', 'ù', 'ú'];
    }

    /**
     * Italian Uppercase to Lowercase
     * 
     * @return array
     */
    public static function getItalianLowerCase()
    {
        return [
            'À' => 'à',
            'È' => 'è',
            'É' => 'é',
            'Ì' => 'ì',
            'Í' => 'í',
            'Ò' => 'ò',
            'Ó' => 'ó',
            'Ù' => 'ù',
            'Ú' => 'ú'
        ];
    }

    /**
     * Non-ASCII Spanish chars
     * 
     * @return array
     */
    public static function getSpanishSpecialChars()
    {
        return ['Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'á', 'é', 'í', 'ñ', 'ó', 'ú'];
    }

    /**
     * Spanish Uppercase to Lowercase
     * 
     * @return array
     */
    public static function getSpanishLowerCase() {
        return [
            'Á' => 'á',
            'É' => 'é',
            'Í' => 'í',
            'Ñ' => 'ñ',
            'Ó' => 'ó',
            'Ú' => 'ú',
        ];
    }
}
