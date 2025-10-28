@extends('maindesign')
@section('index')
      <div class="container">
                @if(session('success_P'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success_P') }}
        </div>
    @endif
    <div class="heading_container heading_center">
      <h2>
        Latest Products
      </h2>
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
      <a href="{{route('allproducts')}}">
        View All Products
      </a>
    </div>
  </div>

@endsection

