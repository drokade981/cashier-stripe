<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class ProductController extends Controller
{
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            $users = $this->productRepository->productList($request->all(), true);
            return ProductResource::collection($users);
        } else {
            return view('product.index');
        }
    }

    public function show($id)
    {
        $product = $this->productRepository->getProduct($id);
        $title = 'Product Detail';
        $intent = auth()->user()->createSetupIntent();
        $user = Auth::user();
        return view('product.view', compact('title', 'product', 'intent', 'user'));
    }

    public function charge(Request $request, $id)
    {
        $product = $this->productRepository->getProduct($id);
        $user = $request->user();

        $paymentMethod = $request->input('payment_method');
        // dd($paymentMethod);
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $user->charge($product->price * 100, $paymentMethod);

        return redirect()->route('products.index')->with('success', 'Payment Successful!');
    }
}
