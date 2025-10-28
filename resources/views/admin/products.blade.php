@extends('admin.maindesign')

@section('view_product')
<div class="container mt-5">
    <h3 class="mb-4 text-center">All Products</h3>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Barre de recherche --}}
    <form action="{{route('admin.searchproduct')}}" method="get" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="search" value="" 
                   class="form-control" placeholder="Search by product name...">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    {{-- Aucun produit --}}
    @if($products->isEmpty())
        <div class="alert alert-info text-center">
            No Products found.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price (MAD)</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if(!is_null($product->image))
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>{{ $product->prix }}</td>
                            <td>{{ $product->quantite }}</td>
                            <td>{{ $product->category ?? 'N/A' }}</td>
                            <td>
                                {{-- Edit --}}
                                <form action="{{ route('admin.editproduct', $product->id) }}" method="get" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                </form>
                                {{-- Delete --}}
                                <form action="{{ route('admin.deleteproduct', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $products->appends(['search' => request('search')])->links() }}
        </div>
    @endif
</div>
@endsection
