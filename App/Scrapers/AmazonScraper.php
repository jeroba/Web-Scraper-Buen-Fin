<?php

namespace App\Scrapers;

use simplehtmldom\HtmlWeb;
use simplehtmldom\HtmlDocument;

class AmazonScraper {
    protected $keywords;

    protected $clientWeb;

    protected $clientHtml;

    protected $url = 'https://www.amazon.com/s/?field-keywords=';

    protected $querySelector = 'div[data-component-type=s-search-result]';

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
            $image = $productNode->find('img', 0);
            $title = $productNode->find('h2', 0);
            $url = $productNode->find('h2 a', 0);
            $price = $productNode->find('.a-offscreen', 0);

            $this->results[] = [
                'image' => $image->src,
                'title' => $title->plaintext,
                'url' => $url->href,
                'price' => $price ? $this->getPrice($price->plaintext) : null,
            ];
        }
    }

    protected function getPrice($price) {
        $price = trim($price, '$');
        return str_replace(',', '', $price);
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
}