@extends('app')
@section('body')
   <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Menu
                    </div>
                    <div class="panel-body">
                        <ul class="nav bg-info">
                            <li><a href="{{ URL::to('article') }}">Article</a></li>
                            <li><a href="{{ URL::to('category') }}">Category</a></li>
                            <li><a href="{{ URL::to('product') }}">Product</a></li>
                            <li><a href="{{ URL::to('/') }}">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row" id="form">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Adding Article</div>
                        <div class="panel-body">
                            <h1 align="center">{{ $article->title }}</h1>
                            <p align="center">{{ 'Article id: '.$article->art_id }}</p>
                            <p>{{ 'Category :'.$article->cat_name }}</p>
                            <p>{{ 'Image :'.$article->image }}</p>
                            <br/>
                            <br/>
                            <p>{{ 'Description :'.$article->description }}</p>
                            <p>Article created : {{ $article->created_at }}</p>
                            <p>Article update date :{{ $article->updated_at }}</p>
                        </div>
                    </div>
                    <div class="">
                        <a href="{{ URL::to('article') }}" class="btn btn-success">Back</a>
                    </div>
                </div>
                
            </div>
            
        </div>       
       
       
    </div>

@stop