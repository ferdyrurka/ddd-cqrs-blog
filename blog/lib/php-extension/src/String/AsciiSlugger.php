<?php
declare(strict_types=1);

namespace PHPExtension\src\String;

use Symfony\Component\String\Slugger\AsciiSlugger as SymfonyAsciiSlugger;

class AsciiSlugger
{
    public static function slug(string $string): string
    {
        $slugger = new SymfonyAsciiSlugger();

        return $slugger->slug($string)->toString();
    }
}
