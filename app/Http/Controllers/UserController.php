<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Card;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        if(Auth::check()){
            if(Auth::user()->user_role == 'admin'){
                return view('admin.dashboard');
            }else if(Auth::user()->user_role == 'user'){
                return view('dashboard');
            }
        }
    }
    public function why(){
        if(Auth::check()){
            $count = Card::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        return view('why',compact('count'));
    }
    public function contact(){
        if(Auth::check()){
            $count = Card::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        return view('contact',compact('count'));
    }
     public function testi(){
        if(Auth::check()){
            $count = Card::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        return view('testi',compact('count'));
    }
    public function home(){
        if(Auth::check()){
            $count = Card::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        $products = Product::latest()->take(4)->get();
        return view('index',compact('products','count'));
    }
    public function productDetails(Product $product){
                if(Auth::check()){
            $count = Card::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        return view('productdetails',compact('product','count'));
    }
    public function allProducts(){
        if(Auth::check()){
            $count = Card::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        $products = Product::all();
        return view('allproducts',compact('products','count'));
    }
    public function addToCard(Product $product)
    {
        $product_card = new Card();
        $product_card->user_id = Auth::id();
        $product_card->product_id = $product->id;

        $product_card->save();

        return redirect()->back()->with('success', 'added to the card !');
    }
    public function cardProduct(){
        if(Auth::check()){
            $count = Card::where('user_id',Auth::id())->count();
            $card = Card::where('user_id',Auth::id())->get();
        }else{
            $count = '';
        }     
        return view('viewcardproducts',compact('count','card'));
    }
    public function deleteCardProduct(Card $card){
        $card->delete();
        return to_route('cardproduct')->with('success','deleted from the card !');
    }
    public function confirmOrder(OrderRequest $request){
        $formFields = $request->validated();
        $card_products = Card::where('user_id', Auth::id())->get();

        foreach($card_products as $card_product){
            $order = new Order();
            $order->user_id = Auth::id();
            $order->product_id = $card_product->product_id;
            $order->name = $formFields['name'];
            $order->address = $formFields['address'];
            $order->telephone = $formFields['telephone'];
            $order->save();
        }

        // vider le panier après confirmation
        Card::where('user_id', Auth::id())->delete();

        return to_route('cardproduct')->with('success_c','Commande confirmée !');
    }
    public function myOrders(){
        $orders = Order::where('user_id',Auth::id())->get();
        return view('viewmyorders',compact('orders'));
    }

    public function stripe($price)
    {
        if (Auth::check()) {
            $count = Card::where('user_id', Auth::id())->count();
        } else {
            $count = '';
        }

        return view('stripe', compact('count', 'price'));
    }


public function postStripe(Request $request)
{
    // Valider les données
    $request->validate([
        'address' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'total' => 'required|numeric',
        'stripeToken' => 'required|string',
    ]);

    try {
        // Configurer la clé secrète Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Créer le paiement
        $charge = Charge::create([
            "amount" => $request->total * 100, // Stripe attend des centimes
            "currency" => "mad",               // ou "usd", "eur", etc.
            "source" => $request->stripeToken,
            "description" => "Paiement - " . Auth::user()->name,
        ]);

        // Créer les commandes pour chaque produit dans le panier
        $cardProducts = Card::where('user_id', Auth::id())->get();
        foreach ($cardProducts as $item) {
            $order = new Order();
            $order->user_id = Auth::id();
            $order->product_id = $item->product_id;
            $order->name = Auth::user()->name; // ou tu peux créer un champ séparé
            $order->address = $request->address;
            $order->telephone = $request->telephone;
            $order->status = 'payer'; // statut payé
            $order->save();
        }

        // Vider le panier
        Card::where('user_id', Auth::id())->delete();

        return redirect()->route('index')->with('success_P', 'Paiement effectué avec succès !');

    } catch (\Exception $e) {
        return back()->with('error', 'Erreur lors du paiement : ' . $e->getMessage());
    }
    }

    public function addComment(Request $request , Product $product){
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        Comment::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'comment' => $request->comment
        ]);
        return back()->with('success', 'Commentaire added with success.');
    }
    public function destroyComment(Comment $comment){
        if($comment->user_id !== Auth::user()->id){
            abort(403);
        }
        $comment->delete();
        return back()->with('success','comment deleted with success');
    }
    public function likeProduct(Product $product){
        $user = Auth::user()->id;
        $like = Like::where('product_id',$product->id)
                ->where('user_id',$user)
                ->first();
        if($like){
            $like->delete();
        }else{
            Like::create([
                'product_id'=>$product->id,
                'user_id'=>$user,
            ]);
        }
        return back();
    }


    

}
