@extends('admin.maindesign')
@section('add_product')
<div class="container mt-5" style="max-width: 500px;">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.postaddproduct')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label  class="form-label">Name of Product</label>
                    <input type="text" name="name"  class="form-control" placeholder="Entrez the name of Product" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description of Product</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Product Description..." required></textarea>
                </div>
                <div class="mb-3">
                    <label  class="form-label">quantity of Product</label>
                    <input type="number" name="quantite"  class="form-control" placeholder="Entrez the quantity of Product" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Price of Product</label>
                    <input type="number" name="prix"  class="form-control" placeholder="Entrez the price of Product" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Product Image</label>
                    <input type="file" name="image"  class="form-control"  required>
                </div>
               <div class="mb-3">
                    <label class="form-label">Category of Product</label>
                    <select name="category" class="form-control" required>
                        <option value="">-- Select a Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category }}">{{ $category->category }}</option>
                        @endforeach   
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Add Product</button>
            </form>
        </div>
    </div>
</div>
@endsection
