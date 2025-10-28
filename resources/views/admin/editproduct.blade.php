@extends('admin.maindesign')

@section('edit_product')
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="mb-4 text-center">Edit Product</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.updateproduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ old('name', $product->name) }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label class="form-label">Price (MAD)</label>
                    <input type="number" name="prix" class="form-control" 
                           value="{{ old('prix', $product->prix) }}" required>
                </div>

                {{-- Quantity --}}
                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantite" class="form-control" 
                           value="{{ old('quantite', $product->quantite) }}" required>
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->category }}" 
                                {{ $product->category == $cat->category ? 'selected' : '' }}>
                                {{ $cat->category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    @if($product->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="img-fluid rounded" style="max-height:150px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-success w-100">Update Product</button>
            </form>
        </div>
    </div>
</div>
@endsection
