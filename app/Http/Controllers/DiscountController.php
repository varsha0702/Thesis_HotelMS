<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $data=Discount::all();
        return view('discount.index',compact('data'));
    }
    public function create()
    {
        return view('discount.create');
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'discount_date'=>'required',
            'amount'=>'required|min:0',
        ]);

        
        $data=new Discount();
        $data->discount_date=$request->discount_date;
        $data->amount=$request->amount;
        $data->save();

        $ref=$request->ref;
        if($ref=='front'){
            return redirect('register')->with('success','Data has been saved.');
        }

        return redirect('admin/discount/create')->with('success','Data has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Discount::find($id);
        return view('discount.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data=Discount::find($id);
        return view('discount.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'discount_date'=>'required',
            'amount'=>'required|min:0',
        ]);

      
        
        $data=Discount::find($id);
        $data->discount_date=$request->discount_date;
        $data->amount=$request->amount;
        $data->save();

        return redirect('admin/discount/'.$id.'/edit')->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Discount::where('id',$id)->delete();
       return redirect('admin/discount')->with('success','Data has been deleted.');
    }
}
