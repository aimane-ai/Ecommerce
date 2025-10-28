@extends('maindesign') 

@section('product_details')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
<div class="container my-5"> 
    <div class="row justify-content-center"> 
        <div class="col-lg-10"> 

            <div class="card shadow-lg border-0"> 

                {{-- Image produit --}}
                <img src="{{ asset('storage/' . $product->image) }}"  
                     alt="{{ $product->name }}"  
                     style="max-height: 500px; object-fit: cover; width: 100%;"> 

                <div class="card-body"> 
                    <h2 class="card-title mb-3">{{ $product->name }}</h2> 

                    <h4 class="text-danger fw-bold"> 
                        {{ $product->prix }} MAD 
                        @if($product->quantite > 0) 
                            <span class="badge bg-success ms-2 text-white">In Stock</span> 
                        @else 
                            <span class="badge bg-danger ms-2">Out of Stock</span> 
                        @endif 
                    </h4> 

                    <h5 class="mt-4">Description</h5> 
                    <p class="text-muted"> 
                        {{ $product->description }} 
                    </p> 

                    <h5 class="mt-4">Features</h5> 
                    <ul class="list-unstyled"> 
                        <li><i class="fa fa-check text-success"></i> Category: {{ $product->category ?? 'N/A' }}</li> 
                        <li><i class="fa fa-check text-success"></i> Available Quantity: {{ $product->quantite }}</li> 
                        <li><i class="fa fa-check text-success"></i> Livraison rapide</li> 
                        <li><i class="fa fa-check text-success"></i> Garantie 12 mois</li> 
                    </ul> 

                    {{-- Boutons Add to Cart et Like --}}
                    <div class="mt-4 d-flex gap-3">
                        <form action="{{route('add_to_card',$product->id)}}" method="get"> 
                            @csrf 
                            <input type="hidden" name="quantity" value="1"> 
                            <button type="submit" class="btn btn-primary px-5 py-2"> 
                                <i class="fa fa-cart-plus"></i> Add to Cart 
                            </button> 
                        </form>
                        
                        @auth
                        <form action="{{ route('likeproduct', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger px-4 py-2">
                                <i class="fa fa-heart"></i> 
                                {{ $product->likes->where('user_id', auth()->id())->count() ? 'Liked' : 'Like' }} 
                                ({{ $product->likes->count() }})
                            </button>
                        </form>
                        @endauth
                    </div> 
                </div> 

            </div> 

            {{-- Section Customer Reviews --}}
            <div class="card shadow-lg border-0 mt-5">
                <div class="card-header bg-light">
                    <h4 class="mb-0"><i class="fa fa-star text-warning"></i> Customer Reviews</h4>
                </div>
                
                <div class="card-body">
                    {{-- Formulaire d'ajout de review --}}
                    <div class="mb-4 p-3 bg-light rounded">
                        <h6>Write a Review</h6>
                        <form action="{{route('addcomment' , $product->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Your Review</label>
                                <textarea name="comment" class="form-control" rows="3" placeholder="Share your experience with this product..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>

                    {{-- Liste des reviews existantes --}}
                    <div class="reviews-list">
                        @foreach ($product->comment as $comment)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $comment->user->name ?? 'Anonymous' }}</h6>
                                    <p class="mb-2 text-muted">{{ $comment->comment }}</p>
                                </div>
                                
                                {{-- Delete uniquement pour l'auteur --}}
                                @if(Auth::id() === $comment->user_id)
                                <form action="{{ route('destroycomment', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
 
        </div> 
    </div> 
</div> 
@endsection
