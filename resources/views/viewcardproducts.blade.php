@extends('maindesign')

@section('view_card_product')
<div class="container my-5">
    <h2 class="mb-4">Mon Panier ({{ $count }} articles)</h2>

    {{-- Message succès --}}
    @if(session('success_c'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success_c') }}
        </div>
    @endif

    @if($card->isEmpty())
        <p class="text-muted text-center fs-4 mt-3">
            Votre panier est vide.
        </p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Nom du produit</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $price = 0;
                @endphp
                @foreach($card as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                 alt="{{ $item->product->name }}" 
                                 width="80" height="80">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->prix }} DH</td>
                        <td>
                            <form action="{{ route('deletecardproduct',$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $price += $item->product->prix;
                    @endphp
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            <div class="card shadow-sm p-3 mb-4" style="max-width: 300px;">
                <h5 class="text-end">Total :</h5>
                <h3 class="text-end ">{{ $price }} DH</h3>
                <a href="{{ route('stripe', $price) }}" class="btn btn-primary w-100 mt-2">Pay Now</a>

            </div>
        </div>

        {{-- Formulaire de livraison --}}
        <div class="card shadow p-4">
            <h4 class="mb-3">Informations de livraison</h4>
            <form action="{{route('confirm_order')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-control" placeholder="Votre nom complet" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="address" class="form-control" placeholder="Votre adresse complète" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="number" name="telephone" class="form-control" placeholder="Votre numéro de téléphone" required>
                </div>
                <input type="hidden" name="total" value="">
                <button type="submit" class="btn btn-success w-100">Confirmer la commande</button>
            </form>
        </div>

    @endif
</div>


@endsection
