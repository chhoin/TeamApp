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
							  	<div class="panel-heading ">Form</div>
							  	<div class="panel-body">
									<div class="box-body">
										<form method="post" action="{{ URL::to('/product')."/store" }}" accept-charset="UTF-8" enctype="multipart/form-data">
											<div class="form-horizontal"  >
											<!-- Input name -->
											<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
												<label for="input-text" class="col-sm-2 control-label">Name:</label>
												<div class="col-sm-10">
													<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
													<input type="text" class="form-control" id="product" name="product" value="{{ old('product')}}" />
													{!! $errors->first('product','<span class="text-danger">:message</span>') !!}
												</div>
											</div>
											<!-- Description -->
											<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}" >
												<label for="input-text" class="col-sm-2 control-label">Description</label>
												<div class="col-sm-10">
													<textarea class="form-control" rows="5" id="editor-ckeditor"    name="description" value="" required="required">{{ Request::old('description') }}</textarea>
													{!! $errors->first('description','<span class="text-danger">:message</span>') !!}
												</div>
											</div>

											<!-- Input prize -->
											<div class="form-group{{ $errors->has('prize') ? ' has-error' : '' }}">
												<label for="input-text" class="col-sm-2 control-label">Prize:</label>
												<div class="col-sm-10">
													<input type="number" class="form-control" id="prize" name="prize" value="{{ old('prize')}}" />
													{!! $errors->first('prize','<span class="text-danger">:message</span>') !!}
												</div>
											</div>
											<!-- submit button-->
												<div class="form-group">
													<label class="col-sm-2 control-label"></label>
													<div class="col-sm-5">
														<input type="submit" value="Save"  class="btn btn-success">
														<button id="clear" onclick="myClear()" class="btn btn-success">Clear</button>
														
													</div>
												</div>
											</div>
										</form>
							  		</div>  
							</div>
						</div>
						</div> 
						<!-- inser and search-->
						<div class="row" >
							<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Insert Form</button>
								
							</div>
							<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
								<form method="get" action="{{ URL::to('/product')."/search" }}" accept-charset="UTF-8">
									<div class="input-group{{ $errors->has('key') ? ' has-error' : '' }}">
									  <input type="text" class="form-control" id="key" name="key" value="{{ old('key') }}" placeholder="Search for...">
										<span class="input-group-btn">
										  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
										  <input type="submit" value="Search" class="btn btn-success">
									  	</span>
									</div>
									@if($errors->has('key'))
										  	<span class="text-danger">
										  		<strong>{{ $errors->first('key') }}</strong>
										  	</span>
										  @endif
								</form>
							</div>
						</div>
						<br/>
						<!-- Table -->
						<div class="row" >
							<div class="panel panel-primary">
							  <div class="panel-heading ">List Article</div>
								<div class="panel-body">
									<p style="color: red;" class="text-center"><?php echo Session::get('messageDelete');  ?></p>
									<p style="color: darkblue" class="text-center"><?php echo Session::get('message');  ?></p>
									<table class="table table-condensed">
										<thead>
										  <tr class="success">
											<th width="10%">ID</th>
											<th width="20%">Name</th>
											<th width="20%">Prize</th>
											<th width="10%">created</th>
											<th width="20%">Activity</th>
										  </tr>
										</thead>
										<tbody>

											   @foreach($product as $pro)
												   <tr>
													   <td>{{ $pro->pro_id }}</td>
													   <td>{{ $pro->pro_name }}</td>
													   <td>{{ $pro->pro_prize }}</td>
													   <td>{{ $pro->created_at }}</td>
													   <td>
														   <a href="{{ URL::to('/product')."/view/".$pro->pro_id }}" class="btn btn-success btn-ms " >View</a> &nbsp;
														   <a href="{{ URL::to('/product')."/edit/".$pro->pro_id }}" class="btn btn-primary btn-ms">Edit</a> &nbsp;
														   <a href="{{ URL::to('/product')."/delete/".$pro->pro_id }}" class="btn btn-danger btn-ms">Delete</a>
													   </td>
												   </tr>
											   @endforeach
											 
											  
											 
										</tbody>
										
									 </table>
									  {!! $product->appends(['key' => Request::get('key')])->render() !!}
									   
									
		      					<div class="text-center">
									
								</div>
								
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
