@extends('layouts.app')

@section('header')
<title>{{ env('APP_NAME',$category->name . ' - items - ecommerce') }}</title>
<meta name="keywords" content="here you can all items related to this category" >
@endsection

@section('content')
<h1 class="text-center">{{ $category->name }}</h1>
<div class="row">
    @foreach ($category_items as $item)
        
            <div class="col-sm-4">
                <div class="card" style="width: 14rem;">
                    <img src="{{ asset('images/items/' . $item->photo) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">{{ $item->name }}</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="status">status</span>:{{ $item->condition }} </li>

                            <li class="list-group-item"><span class="price">price</span>:{{ $item->price }} </li>
                            <li class="list-group-item"><span class="date">date</span>:{{ $item->date }} </li>
                        </ul>
                        <a class="btn btn-success" href="{{url('items/details/'.$item->id)}}">details</a>
                    </div>
                    
                </div>
            </div>
        
    @endforeach
</div>
@endsection