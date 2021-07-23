<?php
/**
 * File name: UserAPIController.php
 * Last modified: 2020.06.11 at 12:09:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */
namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Student;
use App\Models\Category;
use App\Models\Branch;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Review;
use App\Models\Loyality;
use App\Models\Cart;
use App\Models\Thobe_cart;
use App\Models\Gift;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Gift_cart;
use App\Models\Thobe_Button_management;
use App\Models\Thobe_fabric_management;
use App\Models\Collar_managment;
use App\Models\Pocket;
use App\Models\Cuff;
use App\Models\Thobe_Add_Model;
use App\Models\Front_style;
use App\Models\Setting;
use Validator;
use DB;
use Hash;
use Mail;
use App\Traits\ApiResponseHelper;
use Carbon\Carbon;
use Image;

class UserController extends Controller
{
   use ApiResponseHelper;
    /**
     * Register User
     * @param token
     * @return message
     * author:Kundan Kuamr
     * Date:05/01/2020
     */
    public function get_category()
    {
        // $headers = apache_request_headers();
        // $token=$headers['Authorization'];
        $category=Category::where('status',1)->get();
        $url = url("/");
        if(!empty($category))
        {              
            foreach ($category as $row)
            {
                $row->image=$url.'/public/uploads/category/'.$row->image;
            }        
            return $this->successResponse($category, 'Category get successfully!', $this->success());
        }
        else
        {
            return $this->errResponse('', 'Token Does not match!', $this->failed());
        }
    }

    public function get_sliders()
    {
        // $headers = apache_request_headers();
        // $token=$headers['Authorization'];
        $slider=Slider::all();
        $url = url("/");
    
        if(!empty($slider))
        {   
          foreach ($slider as $row)
          {
            $row->image=$url.'/public/uploads/sliders/'.$row->image;
          }                  
            return $this->successResponse($slider, 'Slider get successfully!', $this->success());
        }
        else
        {
            return $this->errResponse('', 'Token Does not match!', $this->failed());
        }
    }
    public function about_us(){
      $about_us=Setting::pluck('about_us');
    
  if($about_us){
    return response()->json(['status'=>true,'data'=>$about_us]);
  }

      
    }
    public function terms(){
      $terms=Setting::pluck('terms');
    
  if($terms){
    return response()->json(['status'=>true,'data'=>$terms]);
  }

      
    }
    public function privacy(){
      $privacy=Setting::pluck('privacy');
    
  if($privacy){
    return response()->json(['status'=>true,'data'=>$privacy]);
  }

      
    }
    public function faq(){
      $faq=Setting::pluck('faq');
    
  if($faq){
    return response()->json(['status'=>true,'data'=>$faq]);
  }

      
    }

    public function get_banner()
    {
        // $headers = apache_request_headers();
        // $token=$headers['Authorization'];
        $category=Category::where('image','!=',NULL)->limit(3)->get();
        
        $url = url("/");
        
        if(!empty($category))
        {   
            foreach ($category as $row)
            {
                $row->image=$url.'/public/uploads/category/'.$row->image;
            }                  
            return $this->successResponse($category, 'Banner get successfully!', $this->success());
        }
        else
        {
            return $this->errResponse('', 'Token Does not match!', $this->failed());
        }
    }

    public function products($id)
    {
        // $headers = apache_request_headers();
        // $token=$headers['Authorization'];
        $product=Product::where('category_id',$id)->get();
        
        $url = url("/");
        
        if(!empty($product))
        {   
            foreach ($product as $row)
            {
                $image=explode('|',$row->image);
                $row->image=$url.'/public/uploads/product/'.$image[0];
            }                  
            return $this->successResponse($product, 'Product get successfully!', $this->success());
        }
        else
        {
            $product=array();
            return $this->errResponse($product, 'Product Does not match!', $this->failed());
        }
    }

    public function products_details($id)
    {
        // $headers = apache_request_headers();
        // $token=$headers['Authorization'];
        $product=Product::where('id',$id)->first();
        
        $url = url("/");
        
        if(!empty($product))
        {   
            $image=explode('|',$product->image);
            foreach ($image as $prow)
            {
                $newimage[]=$url.'/public/uploads/product/'.$prow;
            }
            $product->image=$newimage;
            
                $category=Product::where('category_id',$product->category_id)->limit(4)->get();
                $category_name=Category::where('id',$product->category_id)->first();
                $review=Review::join('users', 'reviews.user_token', '=', 'users.token')
                ->where('reviews.product_id',$id)
                ->orderBy('reviews.id', 'DESC')
               ->get(['reviews.*', 'users.name','users.image']);
                $product->category_name=$category_name->category_name;
               $product->review='';
               $product->like='';
               if(!empty($review))
               {
                    foreach ($review as $row)
               {
                    $row->image=$url.'/public/uploads/user/'.$row->image;
               }

               $product->review=$review;
               }
               if(!empty($category))
               {
                    foreach ($category as $roww)
               {
                    $cimage=explode('|',$roww->image);
                    $cnewimage=array();
                    foreach ($cimage as $crow)
                    {
                        $cnewimage[]=$url.'/public/uploads/product/'.$crow;
                    }
                    $roww->image=$cnewimage;
               }

                $product->like=$category;
               }
               
                 
            return $this->successResponse($product, 'Product details get successfully!', $this->success());
        }
        else
        {
            $product=array();
            return $this->errResponse($product, 'Token Does not match!', $this->failed());
        }
    }

    public function search_products($search)
    {
        
        $product=Product::where('title','like','%'.$search.'%')->get();
        
        $url = url("/");
        
        if(!empty($product))
        {   
            foreach ($product as $row)
            {
                $image=explode('|',$row->image);
                $row->image=$url.'/public/uploads/product/'.$image[0];  
            }    
            return $this->successResponse($product, 'Product details get successfully!', $this->success());
        }
        else
        {
            $product=array();
            return $this->errResponse($product, 'Products not founds!', $this->failed());
        }
    }

     function review_add(Request $request)
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];

        $validator = Validator::make($request->all(), [
            'star' => ['required'],
            'product_id' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }

        $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            $product = Review::select('*')->where(['user_token'=>$token,'product_id'=>$request->product_id])->first();
            if(empty($product))
            {
                $revieww  = new Review;
                $revieww->star = $request->star;
                $revieww->user_token = $token;
                 $revieww->product_id = $request->product_id;
                 $revieww->comments = $request->comments;
                 $revieww->save();
                 $user=(object) array();
             return $this->successResponse($user, 'Review successfully added!', $this->success());

            }
            else
            {
                $user=(object) array();
          return $this->errResponse($user, 'All ready review added!', $this->failed());
            }
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function add_to_cart(Request $request)
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];

         $validator = Validator::make($request->all(), [
            'quantity' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->messages(), $this->validation()); 
        }

         $user = User::select('*')->where(['token'=>$token])->first();
        
        if(!empty($user))
        {
                if($request->type=='normal')
                {
                $pid=$request->product_id;
                $qnty=$request->quantity;
                $cartcheck = Cart::select('*')->where(['token'=>$token,'product_id'=>$pid,'status'=>1])->first();
                if(empty($cartcheck))
                {
                    $cart  = new Cart;
                    $cart->product_id = $pid;
                    $cart->quantity = $qnty;
                    $cart->token = $token;
                    $cart->save();
                }
                else
                {
                    $update = Cart::where(['token'=>$token,'product_id'=>$pid,'status'=>1])->update(
                            [
                              'quantity' =>$qnty,
                            ]);
                }
                $cartcheck = Cart::select('*')->where(['token'=>$token,'product_id'=>$pid,'status'=>1])->first();
                }
                if($request->type=='customize')
                {
                    $id=$request->cart_id;   
                    $quantity=$request->quantity;   
                     $user = User::select('*')->where(['token'=>$token])->first();
                    if(!empty($user))
                 {
                     $update = Thobe_cart::where(['token'=>$token,'id'=>$id])->update(
                    [
                      'quantity' =>$quantity,
                    ]);
                 }
                 }
                return $this->successResponse($user, ' Add to cart successfully!', $this->success());
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
        
    }

     public function get_cart()
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];

         $user = User::select('*')->where(['token'=>$token])->first();
         $total_qty=0;
        if(!empty($user))
        {
                $cartcheck=array();
                $url = url("/");
                //$cartcheck = Cart::select('*')->where(['token'=>$token,'status'=>1])->get();
                $cartcheck=Cart::join('products', 'carts.product_id', '=', 'products.id')
                ->where('carts.status',1)
                ->where('carts.token',$token)
                ->orderBy('carts.id', 'DESC')
               ->get(['carts.*', 'products.title','products.image','products.description','products.cost']);
               $tnormal=0;
               $coupon_price=0;
               $points=0;
               foreach ($cartcheck as $row)
               {
                   $image=explode('|',$row->image);
                    $row->image=$url.'/public/uploads/product/'.$image[0];
                   $tcost=$row->cost*$row->quantity;
                   $row->total_cost=(string)$tcost;
                   $total_qty+=$row->quantity;
                   $tnormaln=$row->cost*$row->quantity;
                   $tnormal=$tnormal+$tnormaln;
                   $row->type='normal';
                   $coupon_price=$row->coupon_price;
                   $points=$row->points_price;
                   $status=$row->status;
                   $row->status=(string)$status;
               }
               $giftcheck=Gift_cart::join('gifts', 'gift_carts.gift_id', '=', 'gifts.id')
                ->where('gift_carts.status',1)
                ->where('gift_carts.token',$token)
                ->orderBy('gift_carts.id', 'DESC')
               ->get(['gift_carts.*', 'gifts.title','gifts.image','gifts.description','gifts.price']);
               $tgift=0;
               foreach ($giftcheck as $grow)
               {
                   $image=explode('|',$grow->image);
                    $grow->image=$url.'/public/uploads/gifts/'.$image[0];
                    $grow->type='gift_card';
                    $tgift=$tgift+$grow->price;
               }
               $totalprice=0;
               $customize=array();
               $ad_py=0;
               $sdata=array();
               $customize_price=0;
               $cust_total=0;
               $customize = Thobe_cart::select('*')->where(['status'=>1,'token'=>$token,'older_status'=>0])->orderBy('id','DESC')->get();
               foreach ($customize as $crow)
               {
                 $fabric = Thobe_fabric_management::select('*')->where(['id'=>$crow->fabric])->orderBy('id','DESC')->first();
               
                 $collar = Collar_managment::select('*')->where(['id'=>$crow->collar])->orderBy('id','DESC')->first();
                 $cuffs = Cuff::select('*')->where(['id'=>$crow->cuffs])->orderBy('id','DESC')->first();
                 $pocket = Pocket::select('*')->where(['id'=>$crow->pocket])->orderBy('id','DESC')->first();
                 $placket = Front_style::select('*')->where(['id'=>$crow->placket])->orderBy('id','DESC')->first();
                 $button = Thobe_Button_management::select('*')->where(['id'=>$crow->button])->orderBy('id','DESC')->first();
                 $total_qty+=$crow->quantity;
                 $totalprice=$fabric['price']+$collar['price']+$cuffs['price']+$pocket['price']+$placket['price']+$button['price'];
               $totalprice=$totalprice*$crow->quantity;
                 $url = url("/");
                 $img='thobe_model.png';
                 
                  $imgg=$url.'/public/uploads/thobeimage/'.$img;
               $ad_py=($totalprice*25)/100;
               $rem_py=$totalprice-$ad_py;
                 $moredata=array('fabric'=>$fabric['price'],'color_code'=>$fabric['color_code'],'collar'=>$collar['price'],'cuffs'=>$cuffs['price'],'pocket'=>$pocket['price'],'placket'=>$placket['price'],'button'=>$button['price'],'Customization_charge'=>$totalprice,'visiting_charge'=>(string)0,'advanced_payment'=>(string)$ad_py,'remaining'=>(string)$rem_py);
                 $sdata[]=array('id'=>$crow->id,'title'=>'Customized Thobe','description'=>'My Customized Thobe','price'=>$totalprice,'image'=>$imgg,'quantity'=>$crow->quantity,'type'=>'customize','view_more'=>$moredata);
                 $customize_price+=$totalprice;
                 $cust_total+=$ad_py;
                
               }
            
               $points=$points/10;
            
               $grandtotal=$tnormal+$tgift+$cust_total+0;
               $grandtotal=$grandtotal-$coupon_price;
               $grandtotal=$grandtotal-$points;
               
               $sdata=array('normal'=>$cartcheck, 'gift_cart'=>$giftcheck,'customize'=>$sdata,'thobe_total'=>$customize_price,'accessories_total'=>$tnormal,'gift_card_amount'=>$tgift,'delivery_charge'=>0,'coupon_applied'=>$coupon_price,'points_apply'=>$points,'grand_total'=>(string)$grandtotal,'loyality_point'=>$points,'total_quantity'=>$total_qty);

                return $this->successResponse($sdata, ' Get cart successfully!', $this->success());
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
        
    }

    public function thobe_cart_quantity(Request $request)
    {
     
        $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $id=$request->cart_id;   
         $quantity=$request->quantity; 

         $user = User::select('*')->where(['token'=>$token])->first();
      
        $tp= Thobe_cart::where(['token'=>$token,'id'=>$id])->first();
        if(!empty($user))
        {
            $update = Thobe_cart::where(['token'=>$token,'id'=>$id])->update(
                    [
                      'quantity' =>$quantity,
                      'thobe_total_price'=>$quantity*$tp->thobe_total_price
                      
                    ]);
                    if($update){
                      return $this->successResponse($update, ' Quantity update successfully!', $this->success());
                    }else{
                      return response()->json(['status'=>false,'msg'=>'Quantity not updated']);
                    }
       
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }

    }

    public function remove_cart(Request $request)
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $id=$request->cart_id;
         $type=$request->type;
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
                if($type=='normal')
                {
                    $cart=Cart::findOrFail($id);
                    $cart->delete();
                }

                if($type=='gift_card')
                {
                    $giftcart=Gift_cart::findOrFail($id);
                    $giftcart->delete();
                }

                if($type=='customize')
                {
                    $giftcart=Thobe_cart::findOrFail($id);
                    $giftcart->delete();
                }
                
                return $this->successResponse($user, ' Remove cart successfully!', $this->success());
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
        
    }

    public function gifts()
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            $gift = Gift::select('*')->where(['status'=>1])->orderBy('id','DESC')->get();
        
        $url = url("/");
        
        if(!empty($gift))
        {   
            foreach ($gift as $row)
            {
                $row->image=$url.'/public/uploads/gifts/'.$row->image;
            }                  
            return $this->successResponse($gift, 'Gifts get successfully!', $this->success());
        }
        else
        {
            $gift=array();
            return $this->errResponse($gift, 'Gifts empty!', $this->failed());
        }
        }
        else
        {
          $user=array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function offers()
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            $offer = Offer::select('*')->where(['status'=>1])->orderBy('id','DESC')->get();
        
        $url = url("/");
        
        if(!empty($offer))
        {   
            foreach ($offer as $row)
            {
                $row->image=$url.'/public/uploads/gifts/'.$row->image;
            }                  
            return $this->successResponse($offer, 'Offers get successfully!', $this->success());
        }
        else
        {
            $offer=array();
            return $this->errResponse($offer, 'Offers empty!', $this->failed());
        }
        }
        else
        {
          $user=array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function gift_description($id)
    {
         $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
        $gift = Gift::select('*')->where(['id'=>$id,'status'=>1])->first();
        
        $url = url("/");
        
        if(!empty($gift))
        {   
            $gift->image=$url.'/public/uploads/gifts/'.$gift->image;
                              
            return $this->successResponse($gift, 'Gifts get successfully!', $this->success());
        }
        
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

     function gift_create(Request $request)
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];
        $validator = Validator::make($request->all(), [
            'gift_id' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'g_to' => ['required'],
            'message' => ['required'],
            'g_from' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }
      $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
                $giftcart  = new Gift_cart;
                $giftcart->token = $token;
                 $giftcart->gift_id = $request->gift_id;
                 $giftcart->date = $request->date;
                 $giftcart->time = $request->time;
                 $giftcart->g_to = $request->g_to;
                 $giftcart->g_from = $request->g_from;
                 $giftcart->message = $request->message;
                 $giftcart->mobile = $request->mobile;
                 $giftcart->receiver_name = $request->receiver_name;
                 $giftcart->save();
                 $user=(object) array();
             return $this->successResponse($user, 'Gift successfully added!', $this->success());
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    function coupon(Request $request)
    {
        $headers = apache_request_headers();
        $token=$headers['Authorization'];
        $validator = Validator::make($request->all(), [
            'coupon_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }
      $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
                $offer = Offer::select('*')->where(['code'=>$request->coupon_id])->first();
                if(!empty($offer))
                {
                  $curentedate=date('d F, Y');
                  $curentedate=strtotime($curentedate);
                  $expiry_date=strtotime($offer->expiry_date);

                  if($expiry_date >= $curentedate)
                  {
                    $update = Cart::where(['token'=>$token,'status'=>1])->update(
                            [
                              'coupon' =>$request->coupon_id,
                              'coupon_price' =>$offer->price,
                            ]);
                    $user=(object) array();
                    return $this->successResponse($user, 'Coupon apply successfully!', $this->success());
                  }
                  else
                  {
                    $user=(object) array();
                    return $this->successResponse($user, 'Coupon expired!', $this->success());
                  }
                }
                else
                {
                  $user=(object) array();
                    return $this->successResponse($user, 'Coupon not matched!', $this->success());
                }
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    function order(Request $request)
    {
      
        $headers = apache_request_headers();
        $token=$headers['Authorization'];

        
        $validator = Validator::make($request->all(), [
            'address_id' => ['required'],
            'grand_total' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],401); 
        }
      $user = User::select('*')->where(['token'=>$token])->first();
  
        if(!empty($user))
        {
                $cartcheck = Cart::select('*')->where(['token'=>$token,'status'=>1])->get();
              
                $giftcheck = Gift_cart::select('*')->where(['token'=>$token,'status'=>1])->get();
                $thobecartcheck = Thobe_cart::select('*')->where(['token'=>$token,'status'=>1])->get();
          // $buffer=Setting::where('id',1)->value('buffer_date');
//           $estimate=Order::where('order_number','order1689')->value('estimate_delivery');
         
         
 
// // Add days to date and display it
// return date('Y-m-d', strtotime($estimate. ' + '.$buffer.' days'));
        
            
                $sorder=0;
                $j=1;
                if($cartcheck)
                {
                  $morder = mt_rand(1000,9999);
            $morder='order'.$morder;

            
                  foreach ($cartcheck as $row)
                  {
                    $sorder='sorder'.time().$j;
                    $order  = new Order;
                $order->token = $token;
                 $order->address_id = $request->address_id;
                 $order->grand_total = $request->grand_total;
                 $order->cart_id = $row->id;
                 $order->product_id = $row->product_id;
                 $order->order_number = $morder;
                 $order->sorder_number = $sorder;
                 $order->o_quantity = $row->quantity;
                 $order->type = 'normal';
                 $order->save();

                 $update = Cart::where(['id'=>$row->id,'status'=>1])->update(
                            [
                              'status' =>0,
                            ]);
                  $j++;
                  }
              }
              if($giftcheck)
              {
                  
                  foreach ($giftcheck as $grow)
                  {
                    
                    $sorder='sorder'.time().$j;
                    $order  = new Order;
                $order->token = $token;
                 $order->address_id = $request->address_id;
                 $order->grand_total = $request->grand_total;
                 $order->cart_id = $grow->id;
                 $order->gift_id = $grow->gift_id;
                 $order->order_number = $morder;
                 $order->sorder_number = $sorder;
                 $order->o_quantity = 1;
                 $order->type = 'gift_cart';
                 $order->save();

                 $update = Gift_cart::where(['id'=>$grow->id,'status'=>1])->update(
                            [
                              'status' =>0,
                            ]);

                  $j++;
                  }
              }

              if($thobecartcheck)
              {
                  
                  foreach ($thobecartcheck as $trow)
                  {
                    
                    $sorder='sorder'.time().$j;
                    $order  = new Order;
                $order->token = $token;
                 $order->address_id = $trow->home_address??'3';
                 $order->grand_total = $request->grand_total;
                 $order->cart_id = $trow->id;
                 $order->thobe_id = $trow->id;
                 $order->order_number = $morder;
                 $order->sorder_number = $sorder;
                 $order->o_quantity = $trow->quantity;
                 $order->type = 'thobe_cart';
                 $order->save();

                 $update = Thobe_cart::where(['id'=>$trow->id,'status'=>1])->update(
                            [
                              'status' =>0,
                            ]);

                  $j++;
                  }
              }
                  if($j!=1)
                  {
                  
                  $points=$request->grand_total/100;
                    $lpoint  = new Loyality;
                $lpoint->token = $token;
                 $lpoint->points = $points;
                 $lpoint->orderid = $morder;
                 $lpoint->save();
                 $points=$points+$user->loyality_point;
                 $update = User::where(['token'=>$token])->update(
                            [
                              'loyality_point' =>$points,
                            ]);
                  $user=(object) array();
                    return $this->successResponse($morder, 'Order successfully!', $this->success());          
                }
                else
                {
                    
                  $user=(object) array();
                    return $this->successResponse($user, 'Cart empty!', $this->success());
                }
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function order_history()
    {
        $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
         $ad_py=0;
         $pending_amount=0;
        if(!empty($user))
        {
            $sdata=array();
            $gdata=array();
            $tdata=array();
            $order_history=array();
          $ordercheck=Order::join('products', 'orders.product_id', '=', 'products.id')
               ->where('orders.delivery_status','!=',4)
                ->where('orders.token',$token)
                ->orderBy('orders.id', 'DESC')
         
               ->get(['orders.*', 'products.title','products.image','products.description','products.cost']);

               $giftcheck=Order::join('gifts', 'orders.gift_id', '=', 'gifts.id')
               ->where('orders.delivery_status','!=',4)
                ->where('orders.token',$token)
                ->orderBy('orders.id', 'DESC')
               ->get(['orders.*', 'gifts.title','gifts.image','gifts.description','gifts.price']);

               $thobecartcheck = Order::select('*')->where(['token'=>$token,'type'=>'thobe_cart'])->orderBy('id','DESC')->get();

               $url = url("/");
            foreach ($ordercheck as $row)
            {
              $image=explode('|',$row->image);
              $pimage=$url.'/public/uploads/product/'.$image[0];
              $sdata[]=array('order_id'=>$row->id,'sub_order_id'=>$row->sorder_number,'type'=>$row->type,'title'=>$row->title,'description'=>$row->description,'price'=>(string)$row->cost,'quantity'=>$row->o_quantity,'image'=>$pimage);
            }

            foreach ($giftcheck as $grow)
            {
              $image=explode('|',$grow->image);
              $pimage=$url.'/public/uploads/gifts/'.$image[0];
              $gdata[]=array('order_id'=>$grow->id,'sub_order_id'=>$grow->sorder_number,'type'=>$grow->type,'title'=>$grow->title,'description'=>$grow->description,'price'=>(string)$grow->price,'quantity'=>$grow->o_quantity,'image'=>$pimage);
            }
            
            foreach ($thobecartcheck as $trow)
            {
                $totalprice=0;
                $thobeid = Thobe_cart::select('*')->where(['id'=>$trow->cart_id])->first();
                $fabric = Thobe_fabric_management::select('*')->where(['id'=>$thobeid->fabric])->orderBy('id','DESC')->first();
               
                 $collar = Collar_managment::select('*')->where(['id'=>$thobeid->collar])->orderBy('id','DESC')->first();
                 $cuffs = Cuff::select('*')->where(['id'=>$thobeid->cuffs])->orderBy('id','DESC')->first();
                 $pocket = Pocket::select('*')->where(['id'=>$thobeid->pocket])->orderBy('id','DESC')->first();
                 $placket = Front_style::select('*')->where(['id'=>$thobeid->placket])->orderBy('id','DESC')->first();
                 $button = Thobe_Button_management::select('*')->where(['id'=>$thobeid->button])->orderBy('id','DESC')->first();
                 
                 $totalprice=$fabric['price']+$collar['price']+$cuffs['price']+$pocket['price']+$placket['price']+$button['price'];
               $totalprice=$totalprice*$thobeid->quantity;
               $ad_py=($totalprice*25)/100;
               $pending_amount=$totalprice-$ad_py;

               $url = url("/");
                 $img='thobe_model.png';
                 
                  $imgg=$url.'/public/uploads/thobeimage/'.$img;
                 


               $tdata[]=array('order_id'=>$trow->id,'sub_order_id'=>$trow->sorder_number,'type'=>$trow->type,'title'=>'Customize','description'=>'customize','price'=>(string)$totalprice,'quantity'=>$trow->o_quantity,'image'=>$imgg);
            }

            $order_history=array_merge($sdata,$gdata,$tdata);
            //$history=array('normal'=>$sdata,'gift'=>$gdata);
            return $this->successResponse($order_history, ' Get order successfully!', $this->success());
        }
        else
        {
          $user=array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }

    public function previous_order()
    {
        $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
        if(!empty($user))
        {
            $sdata=array();
            $gdata=array();
            $order_history=array();
          $ordercheck=Order::join('products', 'orders.product_id', '=', 'products.id')
                ->where('orders.delivery_status',4)
                ->where('orders.token',$token)
                ->orderBy('orders.id', 'DESC')
               ->get(['orders.*', 'products.title','products.image','products.description','products.cost']);

               $giftcheck=Order::join('gifts', 'orders.gift_id', '=', 'gifts.id')
                ->where('orders.delivery_status',4)
                ->where('orders.token',$token)
                ->orderBy('orders.id', 'DESC')
               ->get(['orders.*', 'gifts.title','gifts.image','gifts.description','gifts.price']);

               $url = url("/");
            foreach ($ordercheck as $row)
            {
              $image=explode('|',$row->image);
              $pimage=$url.'/public/uploads/product/'.$image[0];
              $sdata[]=array('order_id'=>$row->id,'sub_order_id'=>$row->sorder_number,'type'=>$row->type,'title'=>$row->title,'description'=>$row->description,'price'=>(string)$row->cost,'quantity'=>$row->o_quantity,'image'=>$pimage);
            }

            foreach ($giftcheck as $grow)
            {
              $image=explode('|',$grow->image);
              $pimage=$url.'/public/uploads/gifts/'.$image[0];
              $gdata[]=array('order_id'=>$grow->id,'sub_order_id'=>$grow->sorder_number,'type'=>$grow->type,'title'=>$grow->title,'description'=>$grow->description,'price'=>(string)$grow->price,'quantity'=>$grow->o_quantity,'image'=>$pimage);
            }
            $order_history=array_merge($sdata,$gdata);
            //$history=array('normal'=>$sdata,'gift'=>$gdata);
            return $this->successResponse($order_history, ' Get previous order successfully!', $this->success());
        }
        else
        {
          $user=array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }


    public function get_gift_carts(){
      $headers = apache_request_headers();
      $token=$headers['Authorization'];
      $order_id=request()->input('order_id');
    $gift_id=Order::where('sorder_number',$order_id)->value('gift_id');
    $grand_total=Gift::where('id',$gift_id)->value('price');
    $user = User::select('*')->where(['token'=>$token])->first();
     if(!empty($user))
     {
$gift=Gift_cart::where(['token'=>$token,'gift_id'=>$gift_id])->first();
if($gift){
  $gift['gift_cart_amount']=$grand_total;
  return response()->json(['status'=>true,'msg'=>'Gift cart found','data'=>$gift]);
}else{
  return response()->json(['status'=>false,'msg'=>'Gift cart not found']);
}
     }
    }

    public function track_order($sorder_number)
    {
    
     
         $headers = apache_request_headers();
         $token=$headers['Authorization'];
         $user = User::select('*')->where(['token'=>$token])->first();
 
      $ad_py=0;
        if(!empty($user))
        {
         
        $order = Order::select('*')->where(['sorder_number'=>$sorder_number])->first();

       
        if(!empty($order))
        {   
        
          $url = url("/");
          if(!empty($order->product_id))
          {
            
              $product = Product::select('*')->where(['id'=>$order->product_id])->first();
           
              $imagee=explode('|',$product->image);
                $image=$url.'/public/uploads/product/'.$imagee[0];
                $price=$product->cost;
                $title=$product->title;
                $description=$product->description;
          }
        
          elseif(!empty($order->thobe_id))
          {
      
            $thobe = Thobe_cart::select('*')->where(['id'=>$order->thobe_id])->first();
         
                $url = url("/");
                 $img='thobe_model.png';
                 
                  $image=$url.'/public/uploads/thobeimage/'.$img;


                  $fabric = Thobe_fabric_management::select('*')->where(['id'=>$thobe->fabric])->orderBy('id','DESC')->first();
               
                 $collar = Collar_managment::select('*')->where(['id'=>$thobe->collar])->orderBy('id','DESC')->first();
                 $cuffs = Cuff::select('*')->where(['id'=>$thobe->cuffs])->orderBy('id','DESC')->first();
                 $pocket = Pocket::select('*')->where(['id'=>$thobe->pocket])->orderBy('id','DESC')->first();
                 $placket = Front_style::select('*')->where(['id'=>$thobe->placket])->orderBy('id','DESC')->first();
                 $button = Thobe_Button_management::select('*')->where(['id'=>$thobe->button])->orderBy('id','DESC')->first();
                 
                 $totalprice=$fabric['price']+$collar['price']+$cuffs['price']+$pocket['price']+$placket['price']+$button['price'];
               $price=$totalprice*$thobe->quantity;
               $ad_py=($price*25)/100;
              
               $title='Customize';
               $description='Customize';
          }
          else
          { 
              $product = Gift::select('*')->where(['id'=>$order->gift_id])->first();
              $image=$url.'/public/uploads/gifts/'.$product->image;
              $price=$product->price;
              $title=$product->title;
              $description=$product->description;
          }
          if(!empty($cart->coupon_price))
          {
            $coupon_price=$cart->coupon_price;
            $coupon=$cart->coupon;
          }
          else
          {
            $coupon_price=0;
            $coupon=0;
          }
          $pdate=date('d F, Y',strtotime($order->created_at));
          $address = Address::select('*')->where(['id'=>$order->address_id])->first();
        
          $cart = Cart::select('*')->where(['id'=>$order->cart_id])->first();
          if(!empty($address))
          {
            $delivery_address=$address->home_type .' '. $address->name .' '. $address->address;
          }
        
          else
          {
            $branchh = Branch::select('*')->where(['id'=>$thobe['branch']])->first();
           
            $b='branch';
            $delivery_address=$branchh->b .' '. $branchh->branch .' '. $branchh->address;
          }
          $status_message=['Order Placed','Order Packed','Order Shipped','Order Delivered'];
        $rem_price=  $price-$ad_py;
          $sdata=array('id'=>$order->id,'delivery_status'=>$order->delivery_status,'image'=>$image,'title'=>$title,'description'=>$description,'price'=>(string)$price,'quantity'=>$order->o_quantity,'order_id'=>$order->sorder_number,'placed_on'=>$pdate,'delivery_time'=>'20-25 Days','address'=>$delivery_address,'total'=>(string)$price,'delivery_charge'=>0,'coupon_applied'=>$coupon_price,'coupon'=>$coupon,'visiting_charge'=>(string)0,'advanced_payment'=> (string)$ad_py,'remaining'=>(string)$rem_price,'status_message'=>$status_message);
            return $this->successResponse($sdata, 'Track successfully!', $this->success());
        }
        
        }
        else
        {
          $user=(object) array();
          return $this->errResponse($user, 'Token Does not match!', $this->failed());
        }
    }


 }