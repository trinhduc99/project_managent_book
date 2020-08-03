@extends('layouts.admin')
@section('title')
    <title>List category</title>
@endsection
@section('search')
    {{route('categories.search')}}
@endsection
@section('link')
    {{route('categories.index')}}
@endsection
@section('contents')
    <div class="content-wrapper">
        @include('partials.content-header',['name'=>'Category Book','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('category-delete','category-edit')
                            <a href="{{route('categories.create')}}" class="btn btn-success float-right m-2">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Book</th>
                                    @can('category-delete','category-edit')
                                        <th scope="col">Action</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->name}}</td>
                                        @can('category-edit','category-delete')
                                            <td>
                                                <a href="{{route('categories.edit',['id'=>$category->id])}}"
                                                   class="btn btn-default">Edit</a>
                                                <a href="{{route('categories.delete',['id'=>$category->id])}}"
                                                   class="btn btn-danger action_delete">Delete</a>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection

