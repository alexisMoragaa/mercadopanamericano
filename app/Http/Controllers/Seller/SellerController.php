<?php 

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Services\Products\GetProductsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SellerController extends Controller
{
    public $productsService;

    /**
     * Create a new controller instance.
     *
     * @param GetProductsService $productsService
     */
    public function __construct(GetProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    
    /**
     * Show the seller dashboard with their products.
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $products = $this->productsService->getProductsBySeller(Auth::user()->id);
        return view('seller.index', ['products' => $products]);
    }

}