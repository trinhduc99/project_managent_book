@extends('layouts.admin')

@section('title')
    <title>List Product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admins/product/not_found.css')}}">
@endsection
@section('search')
    {{route('products.search')}}
@endsection
@section('link')
    {{route('products.index')}}
@endsection
@section('contents')
    <div class="content-wrapper">
        @include('partials.content-header',['name'=>'Category','key'=>'Search'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('category-create')
                    <div class="col-md-12">
                        <a href="{{route('categories.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    @endcan
                    <div class="col-md-12">
                        <div id="notfound">
                            <div class="notfound">
                                <div class="notfound-404">
                                    <h1>4<span>0</span>4</h1>
                                </div>
                                <h2>The name search not found</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


