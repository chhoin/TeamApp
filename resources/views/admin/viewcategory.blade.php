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
                <div class='row' >
                    <div class="panel panel-primary">
                        <div class="panel-heading ">Form</div>
                        <div class="panel-body">
                            <div class="box-body">

                                <h2>This is view Category</h2>
                                <h3>Name: {{ $category->cat_name }}</h3>
                                <p>Created: {!! $category->created_at !!}</p>
                                <p>Updated: {!! $category->updated_at !!}</p>

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