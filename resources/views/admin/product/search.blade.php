@extends('layouts.admin')

@section('title')
    <title>List Product</title>
@endsection
@section('css')
    <style>
        .product_image_150_100 {
            width: 100px;
            height: 130px;
        }
    </style>
@endsection
@section('search')
    {{route('products.search')}}
@endsection
@section('link')
    {{route('products.index')}}
@endsection
@section('contents')
    <div class="content-wrapper">
        @include('partials.content-header',['name'=>'Product','key'=>'Search'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('products.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Name Author</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Content</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $productsItem)
                                <tr>
                                    <th scope="row">{{$productsItem->name}}</th>
                                    <td>{{$productsItem->name_author}}</td>
                                    <td>
                                        <img class="product_image_150_100" src="{{$productsItem->image_path}}"
                                             alt="{{$productsItem->image_name}}">
                                    </td>
                                    <td>{{optional($productsItem->category)->name }}</td>
                                    <td>{{$productsItem->content}}</td>
                                    <td>
                                        @can('product-edit',$productsItem->id)
                                            <a href="{{route('products.edit',['id' => $productsItem->id])}}"
                                               class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('product-delete', $productsItem->id)
                                            <a href="{{route('products.delete',['id'=>$productsItem->id])}}"
                                               class="btn btn-danger action_delete">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


