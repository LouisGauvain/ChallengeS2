<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Pages;

class Sitemap
{
    public function generateSitemap(): void
    {
        $getUrls = new Pages();
        $urlsContent = $getUrls->getUriPagesByAction();

        foreach ($urlsContent as $urlContent) {
            $urls[] = $urlContent['url_page'];
        }

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>');

        foreach ($urls as $url) {
            $xmlUrl = $xml->addChild('url');
            $xmlUrl->addChild('loc', $url);
        }

        $xmlString = $xml->asXML();

        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml';

        file_put_contents($filePath, $xmlString);
    }
}
