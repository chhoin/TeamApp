<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tbl_product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchRequest;


/**
 * ProductController created on 16/03/2016
 * 
 * @author Sok Kimchhoin
 *
 */
class ProductController extends Controller
{
	
	private $limite = 3;
	
	private $p;
	
	/**
	 * __construct
	 *
	 * @param Tbl_product $c
	 */
	function __construct(Tbl_product $p) {
		$this->p = $p;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$product = $this->p->orderBy ( 'pro_id', 'desc' )->paginate ( $this->limite );
		return view ( 'admin/product', compact ( 'product' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
		$this->p->pro_name = $request->product;
		$this->p->pro_description = $request->description;
		$this->p->pro_prize = $request->prize;

		$this->p->save();
		\Session::flash('message', 'Insert Successful');
		return redirect('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$my_id = preg_replace ( '#[^0-9]#', '', $id );
		if (! empty ( $my_id )) {
			$product = $this->p->where ( 'pro_id', $id )->first ();
			return view ( 'admin.viewproduct', compact ( 'product' ) );
		} else {
			return redirect ('product');
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$my_id = preg_replace ( '#[^0-9]#', '', $id );
		if (! empty ( $my_id )) {
			$product = $this->p->where ( 'pro_id', $id )->first ();
			return view ( 'admin.editproduct', compact ( 'product' ) );
		} else {
			return redirect ('product');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$my_id = preg_replace ('#[^0-9]#', '', $request->get ( 'id'));

		if (! empty ($my_id)) {
			$this->p->where ('pro_id', $my_id )->update ( [
				'pro_name' => $request->get ( 'product' ),
				'pro_description' => $request->get ( 'description' ),
				'pro_prize' => $request->get ( 'prize' )
			] );
			\Session::flash ('message', 'Update Successful');
			return redirect ('product');
		}
		$this->edit ();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$my_id = preg_replace ( '#[^0-9]#', '', $id );
		if (! empty ( $my_id )) {
			$this->p->where ( 'pro_id', $my_id )->delete ();
			\Session::flash ( 'messageDelete', 'Delete Successful' );
			return redirect ( 'product' );
		} else {
			return redirect ( 'product' );
		}
    }

	/**
	 * search
	 *
	 * @param SearchRequest $request
	 */
	public function search(SearchRequest $request) {
		$key = $request->get( 'key' );
		$product = $this->p->where ( 'pro_name', 'like', '%' . $key . '%' )->orderBy ( 'pro_id', 'desc' )->paginate ($this->limite );
		return view ( 'admin.product', compact ( 'product', 'key' ) );
	}
    

}
