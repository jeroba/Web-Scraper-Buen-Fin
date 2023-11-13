<?php

namespace App\Controllers; 

use App\Models\Search;
use App\Scrapers\MercadoLibreScraper;
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

        $mercadoLibre = new MercadoLibreScraper(input('keywords'));
        $mercadoLibre->search();

        if (input('sort') == 'asc') {
            $amazon->sortAsc();
            $mercadoLibre->sortAsc();
        }

        if (input('sort') == 'desc') {
            $amazon->sortDesc();
            $mercadoLibre->sortDesc();
        }

        return view('search', [
            'amazonResults' => $amazon->getResults(),
            'mercadoLibreResults' => $mercadoLibre->getResults(),
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