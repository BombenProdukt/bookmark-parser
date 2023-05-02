<?php

declare(strict_types=1);

namespace BombenProdukt\BookmarkParser;

use Carbon\CarbonImmutable;
use Symfony\Component\DomCrawler\Crawler;

final readonly class HtmlParser implements ParserInterface
{
    /**
     * @return array<int, Bookmark>
     */
    public function parse(string $content): array
    {
        return (new Crawler($content))
            ->filter('a[ADD_DATE]')
            ->each(fn (Crawler $linkNode): Bookmark => new Bookmark(
                name: $linkNode->innerText(),
                link: $linkNode->attr('href'),
                date: CarbonImmutable::createFromTimestamp($linkNode->attr('add_date')),
            ));
    }
}
