<?php

namespace App\Helper;

final class DomainHelper
{
    public static function slugify(string $text): string
    {
        // Replace non-letter or non-number characters with -
        $slug = preg_replace('~[^\pL\d]+~u', '-', $text);

        // Transliterate
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);

        // Remove unwanted characters
        $slug = preg_replace('~[^-\w]+~', '', $slug);

        // Trim
        $slug = trim($slug, '-');

        // Convert to lowercase
        $slug = strtolower($slug);

        return $slug;
    }
}