<?php

namespace App\Controllers;

class SitemapController
{
    public function generateSitemap()
    {
        //recuperer les urls des page

        /**
         * $urls = array( ici les urls );
         */

         $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>');
        
         foreach($urls as $url){
            $xmlUrl = $xml->addChild('url');
            $xmlUrl->addChild('loc', $url);
         }

         //convertir l'objet en chaîne XML
         $xmlString = $xml->asXML();

         //chemin vert le fichier sitempa.xml
         $filePath = '';
        
         // enregistrer le contenu dans le fichier
         file_put_contents($filePath, $xmlString);

         echo 'Sitemap generated successfully!';

         //creer route speciale dans le routeur pour accéder à generateSitemap()

    }
}