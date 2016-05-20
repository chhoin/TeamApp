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
                            <div class="box-body">
                                <form method="post" action="{{ URL::to('article')."/store"}}" accept-charset="UTF-8">
                                    <div class="form-horizontal">
                                        <!--Input article name-->
                                        <div class="form-group {{ $errors->has('name')? 'has-error' : '' }} ">
                                            <label class="col-sm-2 control-label">Article Name</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type='text' class="form-control" name='name' id='name' value="{{ old('name') }}">
                                                {!! $errors->first('name','<span class="text-danger">:message</span> ') !!}
                                            </div>
                                        </div>
                                        <!--Input article Description-->
                                        <div class="form-group {{ $errors->has('description')? 'has-error' : '' }} ">
                                            <label class="col-sm-2 control-label">Article Description</label>
                                            <div class="col-sm-10">
                                                <textarea rows="6" class="form-control" name='description' id='description'>{{ old('description') }}</textarea>
                                                {!! $errors->first('description','<span class="text-danger">:message</span> ') !!}
                                            </div>
                                        </div>
                                        
                                        <!--Input article image address-->
                                        <div class="form-group {{ $errors->has('image')? 'has-error' : '' }} ">
                                            <label class="col-sm-2 control-label">Article image</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type='text' class="form-control" name='image' id='image' value="{{ old('image') }}">
                                                {!! $errors->first('image','<span class="text-danger">:message</span> ') !!}
                                            </div>
                                        </div>
                                        <!--Input article category-->
                                        <div class="form-group {{ $errors->has('category')? 'has-error' : '' }} ">
                                            <label class="col-sm-2 control-label">Article Category</label>
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
                                                <input type="submit" value="Save" class="btn btn-success">
                                                <input type="button" class="btn btn-success" value="Clear">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Search form-->
                <div class="row">
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <input type="button" class="btn btn-warning" value="Insert Form" data-toggle="collapse" data-target="#form">
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                        <form method="get" action="{{URL::to('/article')."/search" }}" accept-charset="UTF-8">
                            <div class="input-group {{ $errors->has('search') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="search" id="search" value="{{old('search')}}" placeholder="Search for....">
                                <span class="input-group-btn">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="submit" value="Search" class='btn btn-danger'>
                                </span>
                            </div>
                                @if($errors->has('search'))
                                    <span class="text-danger">
                                        <strong>
                                            {{ $errors->first('search') }}
                                        </strong>
                                    </span>
                                @endif
                        </form>
                    </div>
                </div>
                <br>
            <!--Table for list Article-->
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">List Article</div>
                        <div class="panel-body">
                            <p style='color:red;' class="text-center">{{ Session::get('messageDelete') }}</p>
                            <p style='color:darkblue;' class="text-center">{{ Session::get('messageD') }}</p>
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th width='10%'>ID</th>
                                        <th width='25%'>Article name</th>
                                        <th width='15%'>Category</th>
                                        <th width='10%'>Created</th>
                                        <th width='10%'>Updated</th>
                                        <th width='30%'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jointable as $key => $art)
                                        <tr>
                                            <td> {{ $art->art_id }} </td>
                                            <td> {{ $art->title }} </td>                                            
                                            <td> {{ $art->cat_name }} </td>                                                
                                            <td> {{ $art->created_at }} </td>
                                            <td> {{ $art->updated_at }} </td>
                                            <td> 
                                                <a class="btn btn-primary" href="{{ URL::to('article/').'/view/'.$art->art_id }}">View</a>
                                                <a class="btn btn-warning" href="{{ URL::to('article').'/edit/'.$art->art_id }}">Edit</a>
                                                <a class="btn btn-danger"href="{{ URL::to('article').'/delete/'.$art->art_id }}">Delete</a>
                                            </td>
                                        </tr>                                    
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $jointable->appends(['search' => Request::get('search')])->render()!!}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>       
       
       
    </div>

@stop