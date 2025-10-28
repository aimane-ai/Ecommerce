@extends('maindesign')
@section('index')
      <div class="container">
    <div class="heading_container heading_center">
      <h2>
        All Products
      </h2>
    </div>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for a product...">
        <button class="btn btn-success" type="button">
            <i class="fa fa-search "></i>
        </button>
    </div>
    <div class="row">
      @forelse($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{route('product_details',$product->id)}}">
              <div class="img-box">
                @if($product->image)
                  <img src="{{ asset('storage/'.$product->image) }}" 
                       alt="{{ $product->name }}" >
                @else
                  <img src="{{ asset('front_end/images/no-image.png') }}" alt="No image">
                @endif
              </div>
              <div class="detail-box">
                <h6>
                  {{ $product->name }}
                </h6>
                <h6>
                  Price
                  <span>
                    {{ $product->prix }} MAD
                  </span>
                </h6>
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
            </a>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p class="alert alert-info">No products available.</p>
        </div>
      @endforelse
    </div>
        <div class="btn-box">
      <a href="{{route('index')}}">
        View Latest Products
      </a>
    </div>

  </div>

@endsection

