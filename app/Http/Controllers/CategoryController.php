<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tbl_category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SearchRequest;


/**
 * CategoryController Created on 12/03/2016
 *
 * @author Kimchhoin Sok
 *        
 */
class CategoryController extends Controller {
	
	private $limite = 2;
	
	private $c;
	
	/**
	 * __construct
	 *
	 * @param Tbl_category $c        	
	 */
	function __construct(Tbl_category $c) {
		$this->c = $c;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$category = $this->c->orderBy ( 'cat_id', 'desc' )->paginate ( $this->limite );;
		return view('admin/category', compact('category'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 * Using CategoryRequest to Validate Field
	 * @param \Illuminate\Http\Request $request        	
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
			$this->c->cat_name=$request->cat_name;
			$this->c->save();
		\Session::flash('message','Add category success!!');
		return redirect('category');
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
			// List data by id Than Ravy
			$my_id=preg_replace('#[^0-9]#','',$id);
		if(!empty($my_id)){
			$category=$this->c->where('cat_id',$id)->first();
			return view('admin.viewcategory',compact('category'));
		}
		else{
			return redirect('category');
		}
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//Edit category by Than Ravy
			$my_id=preg_replace('#[^0-9]#','',$id);
			if(!empty($my_id)){
				$category=$this->c->where('cat_id',$id)->first();
				return view('admin.editcategory',compact('category'));
			}
		else{
			return redirect('category');
		}
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request) {
			// Update product by Than Ravy

		$my_id=preg_replace('#[^0-9]#','',$request->get('id'));
		if(!empty($my_id)){
			$this->c->where('cat_id',$my_id)->update([
				'cat_name'=>$request->get('cat_name')
			]);
			\Session::flash ('message', 'Update Successful');
			return redirect ('category');
		}
		$this->edit ();
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
			$my_id=preg_replace('#[^0-9]#','',$id);
		if(!empty($my_id)){
			$this->c->where('cat_id',$my_id)->delete();
			\Session::flash('messageDelete','Delete success');
			return redirect('category');
		}
		else{
			return redirect('category');
		}
	}
	
	/**
	 * search
	 *
	 * @param SearchRequest $request        	
	 */
	public function search(SearchRequest $request) {
			$key=$request->get('key');
			$category=$this->c->where('cat_name','like','%'.$key.'%')->paginate($this->limite);
			return view('admin.category',compact('category','key'));
	}
}
