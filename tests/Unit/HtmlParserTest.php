<?php

declare(strict_types=1);

namespace Tests\Unit;

use BombenProdukt\BookmarkParser\HtmlParser;

it('should parse the HTML export of bookmarks', function (): void {
    $content = <<<'HTML'
    <!DOCTYPE HTML>
    <HTML>
    <HEAD>
        <TITLE>SAMPLE HTML WITH LINKS</TITLE>
    </HEAD>
    <BODY>
        <A HREF="HTTPS://WWW.EXAMPLE1.COM" ADD_DATE="1629837323">EXAMPLE 1</A>
        <A HREF="HTTPS://WWW.EXAMPLE2.COM">EXAMPLE 2</A>
        <A HREF="HTTPS://WWW.EXAMPLE3.COM" ADD_DATE="1629837350">EXAMPLE 3</A>
    </BODY>
    </HTML>
    HTML;

    $bookmarks = (new HtmlParser($content))->parse();

    expect($bookmarks[0]->getName())->toBe('EXAMPLE 1');
    expect($bookmarks[1]->getName())->toBe('EXAMPLE 3');
});
