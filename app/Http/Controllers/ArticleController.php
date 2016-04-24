<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tbl_article;
use App\Tbl_category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Input;


/**
 * ArticleController Created on 12/03/2016
 *
 * @author Kimchhoin Sok
 *        
 */
class ArticleController extends Controller {
	private $limite = 3;
	private $a;
	private $c;
	
	/**
	 * __construct
	 *
	 * @param Tbl_article $a        	
	 * @param Tbl_category $c        	
	 */
	function __construct(Tbl_article $a, Tbl_category $c) {
		$this->a = $a;
		$this->c = $c;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

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
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @return \Illuminate\Http\Response
	 */
	public function store(ArticleRequest $request) {

	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {

	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function update(ArticleRequest $request) {

	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {

	}
	/**
	 * search
	 */
	public function search(SearchRequest $request) {

	}
}
