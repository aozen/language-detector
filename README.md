# Language Detector

Used to determine which language a given string belongs to.

## Installation

You can install the package via composer:
`composer require aozen/language-detector`

## Usage

The LanguageDetector class must be included by yourself.

```php
    use \Aozen\LanguageDetector\LanguageDetector;
```

Example:

```php
class YourClass {
    public function yourFunction() {
        $language_detector = new LanguageDetector();
        return $language_detector->detect("Güneş")->getLanguage(); // Result: "tr"
    }
}
```

## Other Usage Examples

1. By default, the code searches in all languages specified as `available` within the code.

1. The `getClosestLanguage` function works similarly to `getLanguage`, but it doesn't guarantee a 100% correct result. For instance, the example `Äpfel straße délicieux` would return `invalid_language` with `getLanguage`, while `getClosestLanguage` would return `de`, based on which language had the most character matches. For instance, the expression `délicieux délicieux Äpfel` would have also returned `fr`.

1. To search only in the desired languages, `checkList` is used.

```php
    $language_detector->detect("Äpfel")->checkList("tr", "de", "it")->getLanguage(); // de
```

1. To prevent searching in unwanted languages, `blockList` is used.

```php
    $language_detector->detect("Äpfel")->blockList("de")->getLanguage(); // invalid_language
```

1. To retrieve the `lowercase` version of the given string for each language, `getLowerCase` is used. Separate definitions for each language are required.

```php
    $language_detector->detect("TÜRKÇE-BİR-YAZI")->getLowerCase(); // türkçe-bi̇r-yazı
```

## Testing

`vendor/bin/phpunit tests/Test.php`
