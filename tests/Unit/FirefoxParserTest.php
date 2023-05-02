<?php

declare(strict_types=1);

namespace Tests\Unit;

use BombenProdukt\BookmarkParser\Bookmark;
use BombenProdukt\BookmarkParser\FirefoxParser;

it('should parse the SQLite database of Mozilla Firefox', function (): void {
    $bookmarks = (new FirefoxParser('/Users/brianfaust/Library/Application Support/Firefox/Profiles/7pilig34.default-release/places.sqlite'))->parse();

    expect($bookmarks[0])->toBeInstanceOf(Bookmark::class);
})->skipOnGitHubActions();
