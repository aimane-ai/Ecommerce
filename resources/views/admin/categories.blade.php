@extends('admin.maindesign')

@section('view_category')
<div class="container mt-5">
    <h3 class="mb-4 text-center">All catégories</h3>

    @if($categories->isEmpty())
        <div class="alert alert-info text-center">
            No categories found.
        </div>
    @else
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
        <div class="row">
                @php
                    $id = 1;
                @endphp
            @foreach ($categories as $category)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">#{{$id++}} {{ $category->category }}</h5>
                            <div class="mt-2">
                                <form action="{{route('admin.deletecategory',$category->id)}}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">Delete</button>
                                </form>
                            <form action="{{ route('admin.updatecategory', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="category" class="form-label">Name of category</label>
                                    <input type="text" name="category" value="{{ old('category', $category->category) }}" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Update</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
     <div class="d-flex justify-content-center mt-3">
            {{ $categories->links() }}
    </div>
</div>
@endsection
