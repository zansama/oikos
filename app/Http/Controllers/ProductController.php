<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller

{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function viewProduct(){
      $id = request()->route('id');                                                                              // definit l'id par la route utilise

       $anyproduct = Product::all();
       $anyreview = review::all();


        if ($id) {
            $anyproduct = Product::where('id', $id)->get();                                                             // Si l'ID route correspond a l'ID product alors GET
        } else {
            return redirect()->action('CatalogController@viewCatalog');                                            // Sinon si pas d'ID product !! renvois et affiche sur le catatlog
        }
        return view('product',['anyproduct' => $anyproduct , 'anyreview' => $anyreview ]);                         // Affiche le product et la review corresondant a l'ID product


    }

    public function createReview() {                                                                                    //Fonction pour le formulaire de cration des reviews
    //        $anyreview = Review::all();
        return view('review.create');                                                                              //Affiche le formulaire au client
    }

    public function store() {                                                                                           //Fonction pour le formulaire qui vas stocker les review creer via le formulaire
        $review = new Review();
        $review->review = request('review');
        $review->note = request('note');
        $review->save();
        $anyreview = Review::all();
        return view('anyreview',  ['anyreview' => $anyreview]);
    }
}
