
@foreach ($items as $item)

    <div  class="col-sm-3" id="more_items">
        <a class="btn btn-primary" href="{{url('items/create')}}">add item</a>
        <div class="card" style="width: 14rem;">
            <img src="{{ asset('images/items/' . $item->photo) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h3 class="card-title">{{ $item->name }}</h3>
                <ul class="list-group">
                    <li class="list-group-item items"><span class="status">status</span>:{{ $item->condition }} </li>
                    <li class="list-group-item items"><span class="status">review</span>: {{ $item->rate == 0 ? 'no rate': $item->rate }} </li>
                    <li class="list-group-item items"><span class="price">price</span>:${{ $item->price }} </li>
                    <li class="list-group-item items"><span class="date">date</span>:{{ $item->date }} </li>
                </ul>
                <a class="btn btn-success" href="{{url('items/details/'.$item->slug)}}">details</a>
            </div>
            
        </div>
    </div>

@endforeach
