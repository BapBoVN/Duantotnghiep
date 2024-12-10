<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return view('backend.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::get();
        $category=Category::where('is_parent',1)->get();
        // return $category;
        return view('backend.product.create')->with('categories',$category)->with('brands',$brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        $data['discount'] = $request->input('discount') ?? 0;
        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $size;
        // return $data;
        $status=Product::create($data);
        if($status){
            request()->session()->flash('success','Thêm sản phẩm thành công');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại');
        }
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::get();
        $product=Product::findOrFail($id);
        $category=Category::where('is_parent',1)->get();
        $items=Product::where('id',$id)->get();
        // return $items;
        return view('backend.product.edit')->with('product',$product)
                    ->with('brands',$brand)
                    ->with('categories',$category)->with('items',$items);
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
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'stock'=>"required|numeric",
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'brand_id'=>'nullable|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'condition'=>'required|in:default,new,hot',
            'price'=>'required|numeric',
            'discount'=>'nullable|numeric'
        ]);

        $data=$request->all();
        $data['is_featured']=$request->input('is_featured',0);
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        // return $data;
        $status=$product->fill($data)->save();
        if($status){
            request()->session()->flash('success','Sửa sản phẩm thành công');
        }
        else{
            request()->session()->flash('error','Vui lòng thử lại');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Xóa sản phẩm thành công');
        }
        else{
            request()->session()->flash('error','Lỗi, vui lòng thử lại');
        }
        return redirect()->route('product.index');
    }

    public function productFilter(Request $request)
    {
        $data = $request->all();
        
        // Khởi tạo query
        $products = Product::query();
        
        // Lọc theo category nếu có
        if (!empty($data['category'])) {
            $products = $products->where('cat_id', $data['category']);
        }
        
        // Áp dụng các điều kiện lọc khác (nếu có)
        // ...
        
        // Sắp xếp
        if (!empty($data['sortBy'])) {
            if ($data['sortBy'] == 'price_asc') {
                $products = $products->selectRaw('*, (price - (price * discount / 100)) as final_price')
                                    ->orderBy('final_price', 'ASC');
            }
            elseif ($data['sortBy'] == 'price_desc') {
                $products = $products->selectRaw('*, (price - (price * discount / 100)) as final_price')
                                    ->orderBy('final_price', 'DESC');
            }
            elseif ($data['sortBy'] == 'title') {
                $products = $products->orderBy('title', 'ASC');
            }
            elseif ($data['sortBy'] == 'category') {
                $products = $products->orderBy('cat_id', 'ASC');
            }
            elseif ($data['sortBy'] == 'brand') {
                $products = $products->orderBy('brand_id', 'ASC');
            }
        }
        
        // Thực hiện query và phân trang
        $products = $products->paginate(12);
        
        return $products;
    }
}
