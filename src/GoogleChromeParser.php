<?php

declare(strict_types=1);

namespace BombenProdukt\BookmarkParser;

use Carbon\CarbonImmutable;

final readonly class GoogleChromeParser implements ParserInterface
{
    /**
     * @throws \JsonException
     *
     * @return array<int, Bookmark>
     */
    public function parse(string $content): array
    {
        $roots = \json_decode($content, true, \JSON_THROW_ON_ERROR)['roots'];
        $bookmarks = [];

        foreach ($roots as $root) {
            $this->parseNode($root, $bookmarks);
        }

        return $bookmarks;
    }

    private function parseNode(array $node, array &$bookmarks): void
    {
        if ($node['type'] === 'url') {
            $bookmarks[] = new Bookmark(
                name: $node['name'],
                link: $node['url'],
                date: CarbonImmutable::createFromDate(1601, 1, 1, 'UTC')->addSeconds($node['date_added'] / 1000000),
            );
        }

        if ($node['type'] === 'folder' && isset($node['children'])) {
            foreach ($node['children'] as $child) {
                $this->parseNode($child, $bookmarks);
            }
        }
    }
}
