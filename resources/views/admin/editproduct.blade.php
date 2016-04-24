@extends('app')

@section('head')

@stop


@section('body')
    <div class='container-fluid'>
        <div class='row'>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" >
                <div class="panel panel-primary">
                    <div class="panel-heading ">menu</div>
                    <div class="panel-body">
                        <ul class="nav  bg-info">
                            <li><a href="{{ URL::to('/article') }}">Article</a></li>
                            <li><a href="{{ URL::to('/category') }}">Category</a></li>
                            <li><a href="{{ URL::to('/product') }}">Product</a></li>
                            <li><a href="#">Log Out</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                <div id="demo" >
                    <div class='row' >

                        <div class="panel panel-primary">
                            <div class="panel-heading ">Edit product</div>
                            <div class="panel-body">
                                <div class="box-body">

                                    <form method="post" action="{{ URL::to('/product').'/update' }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                        <div class="form-horizontal" >
                                            <!-- Input name -->
                                            <div class="form-group {{ $errors->has('product') ? 'has-error' : '' }}" >
                                                <label for="input-text" class="col-sm-2 control-label">Name</label>
                                                <div class="col-sm-10">

                                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                    <input type="hidden" name="id"  value="{{ $product->pro_id }}">
                                                    <input type="text" class="form-control" id="product" name="product" value="{{ $product->pro_name }}"/>
                                                    {!! $errors->first('product','<span class="text-danger">:message</span>') !!}

                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}" >
                                                <label for="input-text" class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" rows="5" id="editor-ckeditor"    name="description" value="" required="required">{{ $product->pro_description }}</textarea>
                                                    {!! $errors->first('description','<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>

                                            <!-- Input prize -->
                                            <div class="form-group{{ $errors->has('prize') ? ' has-error' : '' }}">
                                                <label for="input-text" class="col-sm-2 control-label">Prize:</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="prize" name="prize" value="{{ $product->pro_prize }}" />
                                                    {!! $errors->first('prize','<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <!-- submit button-->
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-5">

                                                    <input type="submit" value="Save"  class="btn btn-success">
                                                    <a href="{{ URL::to('/product') }}" class="btn btn-success">Back</a>

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


@section('foot')

@stop
