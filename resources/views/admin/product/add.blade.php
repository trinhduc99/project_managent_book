@extends('layouts.admin')
@section('title')
    <title>Add product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admins/product/add.css')}}">
@endsection
@section('search')
    {{route('products.search')}}
@endsection
@section('link')
    {{route('products.index')}}
@endsection
@section('contents')
    <div class="content-wrapper">
        <div class="col-md-12">
        </div>
        @include('partials.content-header',['name'=>'Product','key'=>'Add'])
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Name book</label>
                                <input type="text"
                                       name="name"
                                       value="{{old('name')}}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Insert name of product"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Name Author</label>
                                <input type="text"
                                       name="name_author"
                                       value="{{old('name_author')}}"
                                       class="form-control @error('name_author') is-invalid @enderror"
                                       placeholder="Insert name author"
                                >
                                @error('name_author')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Avatar Book</label>
                                <input type="file"
                                       name="feature_image_path"
                                       class="form-control @error('feature_image_path') is-invalid @enderror"
                                >
                                @error('feature_image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Choose Category</label>
                                <select class="form-control  @error('category_id') is-invalid @enderror" name="category_id">
                                    <option value="">Choose Category</option>
                                    {!! $htmlOptions  !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Insert Content</label>
                                <textarea name="contents"
                                          class="form-control @error('contents') is-invalid @enderror" rows="5">{{old('contents')}}</textarea>
                            </div>
                            @error('contents')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection


