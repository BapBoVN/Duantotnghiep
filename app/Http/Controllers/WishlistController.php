<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
class WishlistController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function wishlist(Request $request){
        // dd($request->all());
        if (empty($request->slug)) {
            request()->session()->flash('error','Sản phẩm không tồn tại');
            return back();
        }        
        $product = Product::where('slug', $request->slug)->first();
        // return $product;
        if (empty($product)) {
            request()->session()->flash('error','Sản phẩm không tồn tại');
            return back();
        }

        $already_wishlist = Wishlist::where('user_id', auth()->user()->id)->where('cart_id',null)->where('product_id', $product->id)->first();
        // return $already_wishlist;
        if($already_wishlist) {
            request()->session()->flash('error','Bạn đã đặt vào danh sách yêu thích');
            return back();
        }else{
            
            $wishlist = new Wishlist;
            $wishlist->user_id = auth()->user()->id;
            $wishlist->product_id = $product->id;
            $wishlist->price = ($product->price-($product->price*$product->discount)/100);
            $wishlist->quantity = 1;
            $wishlist->amount=$wishlist->price*$wishlist->quantity;
            if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $wishlist->save();
        }
        request()->session()->flash('success','Thêm vào danh sách yêu thích thành công');
        return back();       
    }  
    
    public function wishlistDelete(Request $request){
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
            request()->session()->flash('success','Xóa danh sách yêu thích thành công');
            return back();  
        }
        request()->session()->flash('error','Lỗi, vui lòng thử lại');
        return back();       
    }     

    public function deleteAll()
    {
        Wishlist::where('user_id', auth()->user()->id)->delete();
        return back()->with('success', 'Đã xóa tất cả sản phẩm khỏi danh sách yêu thích.');
    }

    public function addAllToCart()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)
                            ->where('cart_id', null)
                            ->get();
        
        foreach($wishlists as $wishlist){
            // Kiểm tra tồn kho
            if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) {
                continue; // Bỏ qua sản phẩm hết hàng
            }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $existingCart = Cart::where('user_id', auth()->user()->id)
                               ->where('product_id', $wishlist->product_id)
                               ->first();

            if ($existingCart) {
                // Nếu sản phẩm đã có trong giỏ hàng, xóa khỏi wishlist
                $wishlist->delete();
                continue;
            }

            // Thêm vào giỏ hàng nếu chưa tồn tại
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $wishlist->product_id;
            $cart->price = $wishlist->price;
            $cart->quantity = $wishlist->quantity;
            $cart->amount = $wishlist->amount;
            $cart->save();

            // Xóa sản phẩm khỏi wishlist sau khi đã thêm vào giỏ hàng
            $wishlist->delete();
        }
        
        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }
}
