@extends('admin.maindesign')
@section('add_category')
<div class="container mt-5" style="max-width: 500px;">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Category</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.postaddcategory') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="category" class="form-label">Name of category</label>
                    <input type="text" name="category" id="category" class="form-control" placeholder="Entrez le nom de la catégorie" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection
