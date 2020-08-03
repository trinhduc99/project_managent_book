@extends('layouts.admin')
@section('title')
    <title>Edit Category Book</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admins/category/add.css')}}">
@endsection
@section('search')
    {{route('categories.search')}}
@endsection
@section('link')
    {{route('categories.index')}}
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name'=>'Category Book','key'=>'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('categories.update',['id'=>$category->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label >Name Category Book</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Insert Category Book"
                                       name="name"
                                       value="{{$category->name}}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label ></label>
                                <select class="form-control @error('parent_id') is-invalid @enderror"
                                        name="parent_id" >
                                    <option value="0">Choose Category Book Parent</option>
                                    {!! $htmlOptions  !!}
                                </select>
                                @error('parent_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

