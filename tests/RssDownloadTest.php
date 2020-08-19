<?php

namespace RssToXmlDownload;

use PHPUnit\Framework\TestCase;
use RssToXmlDownload\Exception\InvalidModeException;
use RssToXmlDownload\Exception\InvalidPathException;
use RssToXmlDownload\Exception\InvalidUrlException;

class RssDownloadTest extends TestCase
{
    public function testDzialanieSimple()
    {
        $this->assertIsBool(true);

        $currentPath = getcwd();
        $rssDownload = new RssDownload();
        $rssDownload->saveAsCsv('https://blog.nationalgeographic.org/rss', $currentPath.'/test.csv', 'w');

        unlink($currentPath.'/test.csv');
    }

    public function testDzialanieExtended()
    {
        $this->assertIsBool(true);

        $currentPath = getcwd();
        $rssDownload = new RssDownload();
        $rssDownload->saveAsCsv('https://blog.nationalgeographic.org/rss', $currentPath.'/test.csv', 'a');

        unlink($currentPath.'/test.csv');
    }

    public function testNieprawidlowyUrl()
    {
        $this->expectExceptionObject(new InvalidUrlException());

        $currentPath = getcwd();
        $rssDownload = new RssDownload();
        $rssDownload->saveAsCsv('nieprawidlowy_url', $currentPath.'/test.csv', 'a');

        unlink($currentPath.'/test.csv');
    }

    public function testNieprawidlowyPath()
    {
        $this->expectExceptionObject(new InvalidPathException());

        $rssDownload = new RssDownload();
        $rssDownload->saveAsCsv('https://blog.nationalgeographic.org/rss', 'incorrect//path', 'w');
    }

    public function testNieprawidlowyMode()
    {
        $this->expectExceptionObject(new InvalidModeException());

        $currentPath = getcwd();
        $rssDownload = new RssDownload();
        $rssDownload->saveAsCsv('https://blog.nationalgeographic.org/rss', $currentPath.'/test.csv', 'incorrect');

        unlink($currentPath.'/test.csv');
    }
}
