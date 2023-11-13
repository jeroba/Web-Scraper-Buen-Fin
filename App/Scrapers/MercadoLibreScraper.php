<?php

namespace App\Scrapers;

use simplehtmldom\HtmlWeb;
use simplehtmldom\HtmlDocument;

class MercadoLibreScraper {
    protected $keywords;

    protected $clientWeb;

    protected $clientHtml;

    protected $url = 'https://listado.mercadolibre.com.mx/';

    protected $querySelector = 'li.ui-search-layout__item';

    protected $results = [];

    public function __construct($keywords) {
        $this->keywords = urlencode($keywords);
        $this->clientWeb = new HtmlWeb;
        $this->clientHtml = new HtmlDocument;
    }

    public function search() {
        
        $html = $this->clientWeb->load($this->url . $this->keywords);
        $allNodes = $html->find($this->querySelector);

        $this->getProductResults($allNodes);

        return $this;
    }

    protected function getProductResults($allNodes) {
        foreach ($allNodes as $node) {
            $productNode = $this->clientHtml->load($node->innertext);
            $image = $productNode->find('.ui-search-result-image__element', 0);
            $title = $productNode->find('h2.ui-search-item__title', 0);
            $url = $productNode->find('a.ui-search-link', 0);
            $price = $productNode->find('span.andes-money-amount__fraction', 0);
            
            $this->results[] = [
                'image' => $image->getAttribute('data-src'),
                'title' => $title->plaintext,
                'url' => $url->href,
                'price' => $price ? $this->getSinglePrice($price->plaintext) : null,
            ];
        }
    }

    public function getResults() {
        return $this->results;
    }

    public function sortAsc() {
        usort($this->results, function ($resultA, $resultB) {
            if ($resultA['price'] == $resultB['price']) {
                return 0;
            }

            return ($resultA['price'] < $resultB['price']) ? -1 : 1;
        });
        
        return $this;
    }

    public function sortDesc() {
        usort($this->results, function ($resultA, $resultB) {
            if ($resultA['price'] == $resultB['price']) {
                return 0;
            }

            return ($resultA['price'] > $resultB['price']) ? -1 : 1;
        });
        
        return $this;
    }

    protected function getSinglePrice($price) {
        $price = trim($price, 'USD');
        $price = trim($price, 'MXN');
        $price = explode(' a USD', $price)[0];
        $price = explode(' a MXN', $price)[0];
        $price = trim($price, ' ');
        $price = trim($price, '$');
        $price = str_replace(',', '', $price);

        return str_replace(' ', '', $price);
    }
}