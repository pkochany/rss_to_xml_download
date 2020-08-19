<?php

require 'RssDownload.php';
use RssToXmlDownload\RssDownload;

if ($argv[1] === 'csv:simple') {
    $prawidlowyFormat = "csv:simple URL PATH\n";
    walidujDwaArgumenty($argv, $prawidlowyFormat);

    $url = $argv[2];
    $path = $argv[3];
    $mode = 'w';

    $csvSimple = new RssDownload();
    $csvSimple->saveAsCsv($url, $path, $mode);
} elseif ($argv[1] === 'csv:extended') {
    $prawidlowyFormat = "csv:extended URL PATH\n";
    walidujDwaArgumenty($argv, $prawidlowyFormat);

    $url = $argv[2];
    $path = $argv[3];
    $mode = 'a';

    $csvSimple = new RssDownload();
    $csvSimple->saveAsCsv($url, $path, $mode);
} else {
    print("Nie rozpoznano polecenia.\n");
    print("Dostępne polecenia:\n");
    print("csv:simple <URL> <PATH>\n");
    print("csv:extended <URL> <PATH>\n");
}

function walidujDwaArgumenty($argv, $prawidlowyFormat) {
    if (count($argv) !== 4) {
        print("Wprowadzono nieprawidłową ilość argumentów.\n");
        print("Prawidłowy format to:\n");
        print($prawidlowyFormat);
        die;
    }
}

?>
