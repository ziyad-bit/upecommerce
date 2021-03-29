@extends('layouts.app')

@section('header')
<title>{{ env('APP_NAME',  'categories - ecommerce') }}</title>
<meta name="keywords" content="here you can see all categories" >
@endsection

@section('content')
    <table class="table table-striped">
        <thead class="bg-info">
            <tr>
                <th scope="col">category number</th>
                <th scope="col">name</th>
                <th scope="col">description</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>
                        <a href="{{url('category/show/items/'.$category->id)}}"> {{ $category->name }} </a>
                    </td>
                    <td>{{ $category->description }}</td>
                </tr>
            @endforeach




        </tbody>
    </table>
@endsection
