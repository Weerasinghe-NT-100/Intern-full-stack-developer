<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'name'=>'required|max:100',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'price'=>'required',
            'status'=>'required'
        ]);

        if($validator->fails()){

           return response()->json([

             'status'=>500,
             'errors'=>$validator->messages(),
           ]); 
        }

        else{

            $product=new Product;
            $product->name=$request->input('name');
            $product->price=$request->input('price');
            $product->status=$request->input('status');
        
            if($request->hasFile('image')){

                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('images/',$filename);
                $product->image=''.$filename;
            
            }

            $product->save();

            return response()->json([

                'status'=>200,
                'message'=>'Product details are saved',
              ]); 

        }
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $product=Product::all();
        return response()->json([

            'status'=>200,
            'details'=>$product
        ]);
    }

    public function show($id)
    {
        $product=Product::find($id);

        if($product)
        {
            return response()->json([
                
                'status'=>200,
                'details'=>$product
            
              ]);
        }

        else
        {
            return response()->json([

                'status'=>400,
                'message'=>'Product id is not found'
          
              ]);
        }
    }

    public function edit($id)
    {
        $product=Product::find($id);

        if($product)
        {
            return response()->json([

              'status'=>200,
              'details'=>$product
            ]);
        }

        else
        {
            return response()->json([

                'status'=>404,
                'message'=>'Product id is not found'
            ]);
        }
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
        $validator=Validator::make($request->all(),[

            'name'=>'required|max:100',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'price'=>'required',
            'status'=>'required'
        ]);

        if($validator->fails()){

           return response()->json([

             'status'=>500,
             'errors'=>$validator->messages(),
           ]); 
        }

        else
        {
            $product=Product::find($id);

            if($product)
            {
                $product->name=$request->input('name');
                $product->price=$request->input('price');
                $product->status=$request->input('status');

                if($request->hasFile('image')){

                    $file=$request->file('image');
                    $extension=$file->getClientOriginalExtension();
                    $filename=time().'.'.$extension;
                    $file->move('images/',$filename);
                    $product->image=''.$filename;
                
                }

                $product->save();
                
                return response()->json([
                  'status'=>200,
                  'message'=>'Product details are updated',
              
                ]);
            }

            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Product id not found',
                
                  ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $product=Product::find($id);

        if($product)
        {
            $product->delete();

            return response()->json([
                
                'status'=>200,
                'message'=>'Product is deleted'
            
              ]);
        }

        else
        {
            return response()->json([

                'status'=>400,
                'message'=>'Product id is not found'
          
              ]);
        }
    }
}
