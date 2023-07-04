<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Models\Pages;

class Sitemap
{
    public function generateSitemap():void
    {
        //recuperer les urls des page

        $getUrls = new Pages();
        $urlsContent = $getUrls->getUriPages();

    
        foreach($urlsContent as $urlContent){
            $urls[] = $urlContent['url_page'];
        }
        
         $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>');
        
         foreach($urls as $url){
            $xmlUrl = $xml->addChild('url');
            $xmlUrl->addChild('loc', $url);
         }

         //convertir l'objet en chaîne XML
         $xmlString = $xml->asXML();

         //chemin vert le fichier sitempa.xml at th root of the project create if not exist
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml';

         file_put_contents($filePath, $xmlString);

         //vardump user actuel php

         //creer route speciale dans le routeur pour accéder à generateSitemap()

    }
}