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
            
            $category = $this->c->get();          
            $jointable = $this->a
                    ->join('tbl_categories', 'tbl_articles.cat_id_for', '=', 'tbl_categories.cat_id')                    
                    ->orderBy('art_id','desc')
                    ->paginate($this->limite);  

             return view('admin/article',  compact('jointable','category'));
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
	public function store(Request $request) {    
            
             $catid= $this->c->where('tbl_categories.cat_name',$request->category)
                     ->select('tbl_categories.cat_id')->first();

            $this->a->title = $request->name;
            $this->a->description =$request->description;
            $this->a->image = $request->image;
            $this->a->cat_id_for = $catid->cat_id;
            $this->a->save();
            return redirect('article');
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {            
        
            $my_id = preg_replace('#[^0-9]#', '', $id);
            if(! empty($my_id)){
                $article = $this->a
                    ->join('tbl_categories', 'tbl_articles.cat_id_for', '=', 'tbl_categories.cat_id')
                    ->where('tbl_articles.art_id',$my_id)
                       ->first();
             return view('admin/viewarticle',  compact('article'));
            }
            else {
                return redirect('article');
            }
             
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
            $category = $this->c->get();
            $my_id = preg_replace('#[^0-9]#', '', $id);
            $article = $this->a->where('art_id', $my_id)->first();
            return view('admin.editarticle',  compact('article','category'));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request) {
             $catid= $this->c->where('tbl_categories.cat_name',$request->category)->first();
             
            
           $my_id = preg_replace ('#[^0-9]#', '', $request->get('id'));
           echo $request->get ( 'id');
                $this->a
                    ->where('tbl_articles.art_id',$my_id)
                    ->update([
                        'title' => $request->name,
                        'description' => $request->description,
                        'image' => $request->image,
                        'cat_id_for' => $catid->cat_id,
                    ]);
                return redirect('article');
                
                

            
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
            $my_id =  preg_replace('#[^0-9]#', '', $id);
            if(! empty($my_id)){
                $this->a->where('art_id', $my_id)->delete();
                \Session::flash('Delete','Deleted!');
                return redirect('article');
            }
            else{
                return redirect('article');
            }
            
            
            
	}
	/**
	 * search
	 */
	public function search(Request $request) {         
            
            $key = $request->get ( 'search' );
		$category = $this->c->orderBy ( 'cat_id', 'desc' )
		->get ();
		$jointable = $this->a
                        ->join('tbl_categories','tbl_articles.cat_id_for','=','tbl_categories.cat_id')
                        ->where ( 'title', 'like', '%' . $key . '%' )
                        ->orderBy ( 'art_id', 'desc' )->paginate ( $this->limite );
		return view ( 'admin.article', compact ( 'jointable', 'key', 'category' ) );
                

	}
}
