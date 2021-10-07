<?php


namespace App\Http\Override;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class HeadingRowFormatterEn extends HeadingRowFormatter
{

    /**
     * @const string
     */
    const FORMATTER_NONE = 'none';

    /**
     * @const string
     */
    const FORMATTER_SLUG = 'slug';

    /**
     * @var string
     */
    protected static $formatter;

    /**
     * @var callable[]
     */
    protected static $customFormatters = [];

    /**
     * @var array
     */
    protected static $defaultFormatters = [
        self::FORMATTER_NONE,
        self::FORMATTER_SLUG,
    ];

    /**
     * @param array $headings
     *
     * @return array
     */
    public static function format(array $headings): array
    {
//        $headings = static::changeKeys($headings);
        return (new Collection($headings))->map(function ($value) {
            return static::callFormatter($value);
        })->toArray();
    }

    public static function changeKeys(array $array): array {
        $newArray = [];
        foreach($array as $key => $row) {
            if(isset($row)) {
                $new_keys = Str::slug($row, '_');
                if(strlen($new_keys) >= 64){
                    $firstLetter = preg_split("/[\s,_-]+/", "$new_keys");
                    $new_keys = $new_keys.'_'.Str::random(5);
                }
                $newArray[$new_keys] = $row;
            }
        }

        return $newArray;
    }

    /**
     * @param string $name
     */
    public static function default(string $name = null)
    {
        if (null !== $name && !isset(static::$customFormatters[$name]) && !in_array($name, static::$defaultFormatters, true)) {
            throw new InvalidArgumentException(sprintf('Formatter "%s" does not exist', $name));
        }

        static::$formatter = $name;
    }

    /**
     * @param string   $name
     * @param callable $formatter
     */
    public static function extend(string $name, callable $formatter)
    {
        static::$customFormatters[$name] = $formatter;
    }

    /**
     * Reset the formatter.
     */
    public static function reset()
    {
        static::default();
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    protected static function callFormatter($value, $key = null)
    {
        static::$formatter = static::$formatter ?? config('excel.imports.heading_row.formatter', self::FORMATTER_SLUG);

        // Call custom formatter
        if (isset(static::$customFormatters[static::$formatter])) {
            $formatter = static::$customFormatters[static::$formatter];
            return $formatter($value);
        }

        if (static::$formatter === self::FORMATTER_SLUG) {
            $new_keys = Str::slug($value, '_');
            if(strlen($new_keys) >= 64){
//                $firstLetter = preg_split("/[\s,_-]+/", $new_keys);
                $firstLetter = strstr($new_keys, '_', true);
                $new_keys = $firstLetter.'_short_'.strlen($new_keys);
            }
            return $new_keys;
        }

        // No formatter (FORMATTER_NONE)
        return $value;
    }

}
