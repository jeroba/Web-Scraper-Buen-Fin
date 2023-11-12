<?php

namespace App\Controllers; 

use App\Models\Search;
use App\Scrapers\EbayScraper;
use App\Scrapers\AmazonScraper;

class SearchController {
    public function index() {
        $searches = Search::where('user_id', $_SESSION['id'])
            ->get();

        return view('my-searches', [
            'searches' => $searches
        ]);
    }

    public function show() {

        $amazon = new AmazonScraper(input('keywords'));
        $amazon->search();

        $ebay = new EbayScraper(input('keywords'));
        $ebay->search();

        if (input('sort') == 'asc') {
            $amazon->sortAsc();
            $ebay->sortAsc();
        }

        if (input('sort') == 'desc') {
            $amazon->sortDesc();
            $ebay->sortDesc();
        }

        return view('search', [
            'amazonResults' => $amazon->getResults(),
            'ebayResults' => $ebay->getResults(),
        ]);
    }

    public function store() {
        Search::create([
            'keywords' => input('keywords'),
            'user_id' => $_SESSION['id']
        ]);

        return redirect('/my-searches');
    }

    public function destroy($searchId) {
        $search = Search::find($searchId);
        $search->delete();

        return redirect('/my-searches');
    }
}