<?php

namespace Aozen\LanguageDetector\Tests;

use Aozen\LanguageDetector\LanguageDetector;

class TestCase
{
    public $language_detector;

    public function __construct() {
        $this->language_detector = new LanguageDetector();
    }

    function getLanguage($string) {
        return $this->language_detector->detect($string)->getLanguage();
    }

    function getClosestLanguage($string) {
        return $this->language_detector->detect($string)->getClosestLanguage();
    }

    function getLanguageWithCheckList($string, $check_list) {
        return $this->language_detector->detect($string)->checkList($check_list)->getLanguage();
    }

    function getLanguageWithBlockList($string, $block_list) {
        return $this->language_detector->detect($string)->blockList($block_list)->getLanguage();
    }

    function getLowerCase($string) {
        return $this->language_detector->detect($string)->getLowerCase();
    }
}

class Test extends \PHPUnit\Framework\TestCase
{
    // TR Test
    // Şahsiyet = personality
    public function testGetLanguageEqualsToTr()
    {
        $test_case = new TestCase();
        $result = $test_case->getLanguage("Şahsiyet");
        $this->assertEquals("tr", $result);
    }

    // EN Test
    public function testGetLanguageEqualsToEn()
    {
        $test_case = new TestCase();
        $result = $test_case->getLanguage("kiss");
        $this->assertEquals("en", $result);
    }

    // DE Test
    // spaßen = to have fun
    public function testGetLanguageEqualsToDe()
    {
        $test_case = new TestCase();
        $result = $test_case->getLanguage("spaßen");
        $this->assertEquals("de", $result);
    }

    // ES Test
    // Árbol = tree
    public function testGetLanguageEqualsToEs()
    {
        $test_case = new TestCase();
        $result = $test_case->getLanguage("Árbol");
        $this->assertEquals("es", $result);
    }

    // FR Test
    // Rêve ïmparfait = imperfect dream
    public function testGetLanguageEqualsToFr()
    {
       $test_case = new TestCase();
       $result = $test_case->getLanguage("Rêve ïmparfait");
       $this->assertEquals("fr", $result); 
    }

    // Invalid Language Test
    // Lächeln = smile and its German
    // délicieux = delicious and its French 
    public function testGetLanguageEqualsToInvalidLanguage()
    {
       $test_case = new TestCase();
       $result = $test_case->getLanguage("Lächeln délicieux");
       $this->assertEquals("invalid_language", $result);
    }

    // Closest TR Test
    // Ähre = award, aşçı = cook
    // 3 Turkish, 1 German Char
    public function testGetClosestLanguageEqualsToTr()
    {
       $test_case = new TestCase();
       $result = $test_case->getClosestLanguage("Ähre aşçı");
       $this->assertEquals("tr", $result);
    }

    // Closest DE Test
    // Äpfel = apple, straße = street
    // 2 German, 1 Turkish Char
    public function testGetClosestLanguageEqualsToDe()
    {
       $test_case = new TestCase();
       $result = $test_case->getClosestLanguage("Äpfel straße İstanbul");
       $this->assertEquals("de", $result);
    }

    // CheckList IT Test
    // Amóur = love
    // ó letter can be use in italian and spanish
    public function testGetLanguageWithCheckListEqualsToIt()
    {
       $test_case = new TestCase();
       $result = $test_case->getLanguageWithCheckList("Amóur", ['it', 'de']);
       $this->assertEquals("it", $result);
    }

    // CheckList Invalid Language Test
    // Amóur = love
    // ó letter can be use in italian and spanish
    public function testGetLanguageWithCheckListEqualsToInvalidLanguage()
    {
       $test_case = new TestCase();
       $result = $test_case->getLanguageWithCheckList("Amóur", ['de', 'tr']);
       $this->assertEquals("invalid_language", $result);
    }

    // BlockList IT Test
    // Amóur = love
    // ó letter can be use in italian and spanish
    public function testGetLanguageWithBlockListEqualsToIt()
    {
       $test_case = new TestCase();
       $result = $test_case->getLanguageWithBlockList("Amóur", ['es']);
       $this->assertEquals("it", $result);
    }

    // BlockList Invalid Language Test
    // Amóur = love
    // ó letter can be use in italian and spanish
    // de, tr doesnt have the letter `ó` so blockList is meaningless
    // Detector must not decide the language is italian or spanish 
    public function testGetLanguageWithBlockListEqualsToInvalidLanguage()
    {
       $test_case = new TestCase();
       $result = $test_case->getLanguageWithBlockList("Amóur", ['it', 'es']);
       $this->assertEquals("invalid_language", $result);
    }

    // TR Lowercase
    // ÖPÜŞMEK = kiss
    public function testGetLowerCaseEqualsToTr()
    {
       $test_case = new TestCase();
       $result = $test_case->getLowerCase("ÖPÜŞMEK");
       $this->assertEquals("öpüşmek", $result);
    }

    // DE Lowercase
    // STRAßE = street
    public function testGetLowerCaseEqualsToDe()
    {
       $test_case = new TestCase();
       $result = $test_case->getLowerCase("STRAßE");
       $this->assertEquals("strasse", $result);
    }
}