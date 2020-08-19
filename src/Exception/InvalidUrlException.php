<?php


namespace RssToXmlDownload\Exception;


class InvalidUrlException extends \Exception
{
    protected $message = 'Podano nieprawidłowy format argumentu URL.';
}
