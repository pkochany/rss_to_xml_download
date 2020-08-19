<?php


namespace RssToXmlDownload
;

require 'vendor/dg/rss-php/src/Feed.php';
use Feed;
use RssToXmlDownload\Exception\InvalidModeException;
use RssToXmlDownload\Exception\InvalidPathException;
use RssToXmlDownload\Exception\InvalidUrlException;

class RssDownload
{
    function saveAsCsv($url, $path, $mode) {
        $this->walidujUrl($url);
        $this->walidujMode($mode);
        $this->walidujPath($path, $mode);

        print("Rozpoczynam pobieranie.\n");

        try {
            $rss = Feed::loadRss($url);
        } catch (\Exception $e) {
            print("Wystąpił problem podczas ładowania RSS.]\n");
            print("Szczegóły:\n");
            print($e->getMessage());
            print($e->getTraceAsString());
        }

        $iloscItemow = $rss->item->count();
        $csvFile = fopen($path, $mode);
        $counter = 0;
        $pubDate = new \DateTime();
        // ustaw język polki dla formatu daty
        setlocale( LC_TIME, 'pl_PL.utf8');

        print("Pobrano $iloscItemow itemów.\n");

        fputcsv($csvFile, ['title', 'description', 'link', 'pubDate', 'creator']);
        fputcsv($csvFile, [$rss->title, $rss->description, $rss->link, '', '']);
        foreach ($rss->item as $item) {
            $counter += 1;
            $pubDate->setTimestamp(intval($item->timestamp));
            $trescBezHtml = strip_tags(strval($item->{'content:encoded'}));
            $trescBezHtmlBezUrl = str_replace(['http://', 'https://'], '', $trescBezHtml);
            print("Zapisywanie $counter z $iloscItemow itemów.\n");
            fputcsv($csvFile, [$item->title, $item->description, $item->link, strftime('%d %B %Y %H:%I:%S', intval($item->timestamp)), $trescBezHtmlBezUrl]);
        }
        fclose($csvFile);
        print("Zapisywanie zakończone, plik csv gotowy.\n");

        return true;
    }

    private function walidujPath($path, $mode) {
        // spróbuj stworzyć lub nadpisać plik, jeżeli wyrzuci błąd to oznacza problem z path
        try {
            $myfile = fopen($path, $mode);
            fwrite($myfile, '');
            fclose($myfile);
        } catch (\Exception $e) {
            print("Nie można stworzyć pliku. Podano nieprawidłową ścieżkę lub nie masz uprawnień do zapisu.\n");
            print("Szczegóły:\n");
            print($e->getMessage());
            print($e->getTraceAsString());

            throw new InvalidPathException();
        }
    }

    private function walidujUrl($url) {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidUrlException();
        }
    }

    private function walidujMode($mode) {
        if ($mode !== 'a' && $mode !== 'w') {
            throw new InvalidModeException();
        }
    }
}
