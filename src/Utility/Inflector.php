<?php
/** @noinspection DuplicatedCode */

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Avolle\Fotballdata\Utility;

/**
 * Pluralize and singularize English words.
 *
 * Inflector pluralizes and singularizes English nouns.
 * Used by CakePHP's naming conventions throughout the framework.
 *
 * @link https://book.cakephp.org/4/en/core-libraries/inflector.html
 */
class Inflector
{
    /**
     * Method cache array.
     *
     * @var array<string, string|array<string, string>>
     */
    protected static array $cache = [];

    /**
     * Singular inflector rules
     *
     * @var array<string, string>
     */
    protected static $_singular = [
        '/(s)tatuses$/i' => '\1\2tatus',
        '/^(.*)(menu)s$/i' => '\1\2',
        '/(quiz)zes$/i' => '\\1',
        '/(matr)ices$/i' => '\1ix',
        '/(vert|ind)ices$/i' => '\1ex',
        '/^(ox)en/i' => '\1',
        '/(alias|lens)(es)*$/i' => '\1',
        '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$/i' => '\1us',
        '/([ftw]ax)es/i' => '\1',
        '/(cris|ax|test)es$/i' => '\1is',
        '/(shoe)s$/i' => '\1',
        '/(o)es$/i' => '\1',
        '/ouses$/' => 'ouse',
        '/([^a])uses$/' => '\1us',
        '/([m|l])ice$/i' => '\1ouse',
        '/(x|ch|ss|sh)es$/i' => '\1',
        '/(m)ovies$/i' => '\1\2ovie',
        '/(s)eries$/i' => '\1\2eries',
        '/(s)pecies$/i' => '\1\2pecies',
        '/([^aeiouy]|qu)ies$/i' => '\1y',
        '/(tive)s$/i' => '\1',
        '/(hive)s$/i' => '\1',
        '/(drive)s$/i' => '\1',
        '/([le])ves$/i' => '\1f',
        '/([^rfoa])ves$/i' => '\1fe',
        '/(^analy)ses$/i' => '\1sis',
        '/(analy|diagno|^ba|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
        '/([ti])a$/i' => '\1um',
        '/(p)eople$/i' => '\1\2erson',
        '/(m)en$/i' => '\1an',
        '/(c)hildren$/i' => '\1\2hild',
        '/(n)ews$/i' => '\1\2ews',
        '/eaus$/' => 'eau',
        '/^(.*us)$/' => '\\1',
        '/s$/i' => '',
    ];

    /**
     * Irregular rules
     *
     * @var array<string, string>
     */
    protected static $_irregular = [
        'atlas' => 'atlases',
        'beef' => 'beefs',
        'brief' => 'briefs',
        'brother' => 'brothers',
        'cafe' => 'cafes',
        'child' => 'children',
        'cookie' => 'cookies',
        'corpus' => 'corpuses',
        'cow' => 'cows',
        'criterion' => 'criteria',
        'ganglion' => 'ganglions',
        'genie' => 'genies',
        'genus' => 'genera',
        'graffito' => 'graffiti',
        'hoof' => 'hoofs',
        'loaf' => 'loaves',
        'man' => 'men',
        'money' => 'monies',
        'mongoose' => 'mongooses',
        'move' => 'moves',
        'mythos' => 'mythoi',
        'niche' => 'niches',
        'numen' => 'numina',
        'occiput' => 'occiputs',
        'octopus' => 'octopuses',
        'opus' => 'opuses',
        'ox' => 'oxen',
        'penis' => 'penises',
        'person' => 'people',
        'sex' => 'sexes',
        'soliloquy' => 'soliloquies',
        'testis' => 'testes',
        'trilby' => 'trilbys',
        'turf' => 'turfs',
        'potato' => 'potatoes',
        'hero' => 'heroes',
        'tooth' => 'teeth',
        'goose' => 'geese',
        'foot' => 'feet',
        'foe' => 'foes',
        'sieve' => 'sieves',
        'cache' => 'caches',
    ];

    /**
     * Words that should not be inflected
     *
     * @var array<string>
     */
    protected static $_uninflected = [
        '.*[nrlm]ese', '.*data', '.*deer', '.*fish', '.*measles', '.*ois',
        '.*pox', '.*sheep', 'people', 'feedback', 'stadia', '.*?media',
        'chassis', 'clippers', 'debris', 'diabetes', 'equipment', 'gallows',
        'graffiti', 'headquarters', 'information', 'innings', 'news', 'nexus',
        'pokemon', 'proceedings', 'research', 'sea[- ]bass', 'series', 'species', 'weather',
    ];

    /**
     * Return $word in singular form.
     *
     * @param string $word Word in plural
     * @return string Word in singular
     * @link https://book.cakephp.org/4/en/core-libraries/inflector.html#creating-plural-singular-forms
     */
    public static function singularize(string $word): string
    {
        if (isset(static::$cache['singularize'][$word])) {
            return static::$cache['singularize'][$word];
        }

        if (!isset(static::$cache['irregular']['singular'])) {
            $wordList = array_values(static::$_irregular);
            static::$cache['irregular']['singular'] = '/(.*?(?:\\b|_))(' . implode('|', $wordList) . ')$/i';

            $upperWordList = array_map('ucfirst', $wordList);
            static::$cache['irregular']['singularUpper'] = '/(.*?(?:\\b|[a-z]))(' .
                implode('|', $upperWordList) .
                ')$/';
        }

        if (
            preg_match(static::$cache['irregular']['singular'], $word, $regs) ||
            preg_match(static::$cache['irregular']['singularUpper'], $word, $regs)
        ) {
            $suffix = array_search(strtolower($regs[2]), static::$_irregular, true);
            $suffix = $suffix ? substr($suffix, 1) : '';
            static::$cache['singularize'][$word] = $regs[1] . substr($regs[2], 0, 1) . $suffix;

            return static::$cache['singularize'][$word];
        }

        if (!isset(static::$cache['uninflected'])) {
            static::$cache['uninflected'] = '/^(' . implode('|', static::$_uninflected) . ')$/i';
        }

        if (preg_match(static::$cache['uninflected'], $word, $regs)) {
            static::$cache['pluralize'][$word] = $word;

            return $word;
        }

        foreach (static::$_singular as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                static::$cache['singularize'][$word] = preg_replace($rule, $replacement, $word);

                return static::$cache['singularize'][$word];
            }
        }
        static::$cache['singularize'][$word] = $word;

        return $word;
    }
}
