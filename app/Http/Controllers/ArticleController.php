<?php


namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tbl_article;
use App\Tbl_category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Input;

use Intervention\Image\Facades\Image;
use Carbon\Carbon;



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
	public function index($local) {
        	App::setlocale($local); 
		

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
	public function store($local,Request $request) {    
            
             $catid= $this->c->where('tbl_categories.cat_name',$request->category)
                     ->select('tbl_categories.cat_id')->first();  
             
            if ($request->hasFile('image')) {
            		$path = 'image/';
             		$photo = $request->file('image'); 
             		$extension = $photo->getClientOriginalExtension();
             		$fileName=sha1(Carbon::now()).'.'.$extension;
                    $this->a->title = $request->name;
                    $this->a->description =$request->description;
                    $this->a->image = asset($path).'/'.$fileName;
                    $this->a->cat_id_for = $catid->cat_id;                     
                                       
                    $photo->move($path,$fileName);              
                    
            		$this->a->save();
            		Image::make($path.$fileName)->resize(300,200)->save();

            		return redirect($local.'/article');
            }
            else {
                echo 'error';
            }
           return redirect('article');
	}


	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function show($local,$id) {            
        	App::setlocale($local);
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
	public function edit($local,$id) {
			App::setlocale($local);
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
	public function update($local,Request $request) {
             $catid= $this->c->where('tbl_categories.cat_name',$request->category)->first();
             
            
           $my_id = preg_replace ('#[^0-9]#', '', $request->get('id'));


            if($my_id){
            	if ($request->hasFile('image')) {

                 $path = 'image/';
	             $photo = $request->file('image'); 
	             $extension = $photo->getClientOriginalExtension();
	             $fileName=sha1(Carbon::now()).'.'.$extension;
	             $this->a
                    ->where('tbl_articles.art_id',$my_id)
                    ->update([
                        'title' => $request->name,
                        'description' => $request->description,
                        'image' => asset($path).'/'.$fileName,
                        'cat_id_for' => $catid->cat_id,
                    ]);            
                 
	             $photo->move($path,$fileName);    
            	 $this->a->save();

            	$editing = Image::make($path.$fileName)->resize(300,200)->save();
	            	echo '<script>alertify.warning("Image not update!");</script>';
            	return redirect($local.'/article');
	            }	
	            else{
					$this->a
	                    ->where('tbl_articles.art_id',$my_id)
	                    ->update([
	                        'title' => $request->name,
	                        'description' => $request->description,
	                        'cat_id_for' => $catid->cat_id,
	                    ]);         

	            		echo '<script>alertify.warning("Image not update!");</script>';
	                    return redirect($local.'/article');  	
	            }
            }    
            else{
            	return 'Error';
            }       
                
                

            
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($local,$id) {
            $my_id =  preg_replace('#[^0-9]#', '', $id);
            if(! empty($my_id)){
                $this->a->where('art_id', $my_id)->delete();
                \Session::flash('Delete','Deleted!');
                //echo $local;
                return redirect($local.'/article');
            }
            else{
            	echo $local;
                return redirect($local.'/article');
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
        public function  imageupload(Requests $request){
            
        }
}
