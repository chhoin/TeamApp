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
                        <div class="panel-heading">{{ trans('lang.edit') }}</div>
                        <div class="panel-body">
                            <div class="box-body">
                                <form method="post" action="{{ URL::to(trans('lang.lang').'/article')."/update"}}" accept-charset="UTF-8">
                                    <div class="form-horizontal">
                                        <!--Input article name-->
                                        <div class="form-group {{ $errors->has('name')? 'has-error' : '' }} ">
                                            <label class="col-sm-2 control-label">{{trans('lang.art_name')}}</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" name="id"  value="{{ $article->art_id }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type='text' class="form-control" name='name' id='name' value="{{ $article->title }}">
                                                {!! $errors->first('name','<span class="text-danger">:message</span> ') !!}
                                            </div>
                                        </div>
                                        <!--Input article Description-->
                                        <div class="form-group {{ $errors->has('description')? 'has-error' : '' }} ">
                                            <label class="col-sm-2 control-label">{{trans('lang.description')}}</label>
                                            <div class="col-sm-10">
                                                <textarea rows="6" class="form-control" name='description' id='description'>{{ $article->description }}</textarea>
                                                {!! $errors->first('description','<span class="text-danger">:message</span> ') !!}
                                            </div>
                                        </div>
                                        
                                        <!--Input article image address-->
                                        <div class="form-group {{ $errors->has('image')? 'has-error' : '' }} ">
                                            <label class="col-sm-2 control-label">{{trans('lang.image')}}</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type='file' class="form-control" name='image' id='image' value="{{ old('image') }}">
                                                {!! $errors->first('image','<span class="text-danger">:message</span> ') !!}
                                            </div>
                                        </div>
                                        <!--Input article category-->
                                        <div class="form-group {{ $errors->has('category')? 'has-error' : '' }} ">
                                            <label class="col-sm-2 control-label">{{trans('lang.category')}}</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <select class="form-control" id='category' name="category">
                                                    @foreach($category as $cat)
                                                        <option>{{ $cat->cat_name }}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('category','<span class="text-danger">:message</span> ') !!}
                                            </div>
                                        </div>
                                        
                                        <!--Submit-->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-10">
                                                <input type="submit" value="{{trans('lang.save')}}" class="btn btn-success">
                                                <input type="button" class="btn btn-success" value="{{trans('lang.clear')}}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>       
       
       
    </div>

@stop