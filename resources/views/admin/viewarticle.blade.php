@extends('app')
@section('body')
   <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        {{trans('lang.menu')}}
                    </div>
                    <div class="panel-body">
                        <ul class="nav bg-info">
                            <li><a href="{{ '/'.trans('lang.lang').('/article') }}">{{trans('lang.article')}}</a></li>
                            <li><a href="{{ '/'.trans('lang.lang').('/category') }}">{{trans('lang.category')}}</a></li>
                            <li><a href="{{ '/'.trans('lang.lang').('/product') }}">{{trans('lang.product')}}</a></li>
                            <li><a href="{{ URL::to('/') }}">{{trans('lang.logout')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row" id="form">
                    <div class="panel panel-primary">
                        <div class="panel-heading">{{trans('lang.view')}}</div>
                        <div class="panel-body">
                            <h1 align="center">{{ $article->title }}</h1>
                            <p align="center">{{ trans("lang.id").': '.$article->art_id }}</p>
                            <p>{{ trans('lang.category').':'.$article->cat_name }}</p>
                            <p>{{trans('lang.image')}}<img src="{{$article->image }}"></p>
                            <br/>
                            <br/>
                            <p>{{ trans('lang.description').':'.$article->description }}</p>
                            <p>{{trans('lang.created')}} : {{ $article->created_at }}</p>
                            <p>{{trans('lang.updated')}} :{{ $article->updated_at }}</p>
                        </div>
                    </div>
                    <div class="">
                        <a href="{{ URL::to(trans('lang.lang').'/article') }}" class="btn btn-success">{{trans('lang.back')}}</a>
                    </div>
                </div>
                
            </div>
            
        </div>       
       
       
    </div>

@stop