@extends('admin.maindesign')

@section('view_orders')
<div class="container mt-5">
    <h3 class="mb-4 text-center">All Orders</h3>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif


        {{-- Barre de recherche --}}
    <form action="{{route('admin.searchorder')}}" method="get" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="search" value="" 
                   class="form-control" placeholder="Search for a commande...">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
    
    {{-- Aucun produit --}}
    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            No Orders found.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>address</th>
                        <th>Product</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Phone Number</th>
                        <th>Ordered At</th>
                        <th>Status</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                @php
                    $id = 1;
                @endphp
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$id++}}</td>
                            <td class="text text-danger">{{ $order->name }}</td>
                            <td>{{ $order->address}}</td>
                            <td>
                                <img src="{{ asset('storage/' . $order->product->image) }}" 
                                    alt="{{ $order->product->name }}" 
                                    width="80" height="80"
                                    class="rounded">
                            </td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->product->prix }} MAD</td>
                            <td class="text text-danger">{{ $order->telephone }}</td>
                            <td>{{ $order->created_at}}</td>
                            <td>
                                <form action="{{route('admin.changestatus',$order->id)}}" method="POST" class="d-flex gap-2 justify-content-center align-items-center">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm w-auto">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Livré</option>
                                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Annulé</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                            onclick="return confirm('Are you sure?')">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td><a href="{{route('admin.downloadpdf',$order->id)}}" class="btn btn-danger">Download PDF</a></td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif
</div>
@endsection
