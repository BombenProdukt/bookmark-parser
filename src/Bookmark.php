<?php

declare(strict_types=1);

namespace BombenProdukt\BookmarkParser;

use Carbon\CarbonImmutable;
use JsonSerializable;

final readonly class Bookmark implements JsonSerializable
{
    public function __construct(
        private string $name,
        private string $link,
        private CarbonImmutable $date,
    ) {
        //
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'link' => $this->link,
            'date' => $this->date->unix(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
