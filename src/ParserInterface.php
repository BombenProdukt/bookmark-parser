<?php

declare(strict_types=1);

namespace BombenProdukt\BookmarkParser;

interface ParserInterface
{
    public function parse(): array;
}
