<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use Illuminate\Support\Facades\DB;
use Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        $result = DB::table('shops')->get();
        return view('shop.shopIndex',[  
                    'product' => $result
                     ]); 
        //
    }
    public function Write()
    {
        return view('shop.shopWrite'); 
        //
    }
    
    //상품 등록
    public function productUp(Request $request)
    {
        $product_img = $request->file('img');
        if(!$product_img) {
            
            echo "<script>
                window.alert('이미지를 등록하세요');
                history.go(-1);
            </script>";
        }
        $product_name = $request->product_name;
        $product_contents = $request->product_contents;
        $product_price = $request->product_price;
        $product_num = $request->product_num;
        
        
        //이미지 경로 설정
        $img_dir = '/shop_img/'.$product_name.'/';
        $img_Path = '.'.$img_dir;
        $img_name = $product_name.'_img.'.$product_img->getClientOriginalExtension();
        $img_dir = $img_dir.$img_name;
        
        // 이미지 저장
        $product_img->move($img_Path, $img_name );
        
        
         DB::table('shops')->insert([
            "product_name"  => $product_name,
            "product_contents" => $product_contents,
            "product_num" => $product_num,
            "product_price"  => $product_price,
            "product_iamge" => $img_dir
        ]);
        
        
        
        $res =  DB::table('shops')->get();
        return view('shop.shopIndex',[  
                    'product' => $res
                     ]); 
        //
    }
    
    //상품 정보
    public function details($id)
    {
        $result = DB::table('shops')->where('product_id',$id)->get();
        return view('shop.productDetails',[  
                    'product' => $result
                     ]); 
        //
    }
    
    //상품 관리
    public function admin()
    {
        
        $result = DB::table('shops')->get();
        return view('shop.productAdmin',[  
                    'product' => $result
                     ]); 
        //
    }
    
    //상품 삭제
    public function productDelete($id)
    {
        DB::table('shops')->where('product_id',$id)->delete();    
        $result = DB::table('shops')->get();
        
        echo "<script>
                window.alert('상품이 삭제 되었습니다.');
        
            </script>";
        return view('shop.productAdmin',[  
                    'product' => $result
                     ]);
        //
    }
    
    //상품 수정페이지 이동
    public function productModifyPage($id) 
    {  
        $result = DB::table('shops')->where('product_id',$id)->get();
        return view('shop.productModifyPage',[  
                    'product' => $result
                     ]);
        //
    }
    
    //상품 수정
    public function productModify(Request $request)
    {  
        
         $product_img = $request->file('img');

        $product_name = $request->product_name;
        $product_contents = $request->product_contents;
        $product_price = $request->product_price;
        $product_num = $request->product_num;
        $product_id = $request->product_id;
        $img_dir = $request->product_img;
        
         if($product_img) {
            
            //이미지 경로 설정
            $img_dir = '/shop_img/'.$product_name.'/';
            $img_Path = '.'.$img_dir;
            $img_name = $product_name.'_img.'.$product_img->getClientOriginalExtension();
            $img_dir = $img_dir.$img_name;
            
            // 이미지 저장
            $product_img->move($img_Path, $img_name );
        } 

        
        
         DB::table('shops')->where('product_id',$product_id)->update([
            "product_name"  => $product_name,
            "product_contents" => $product_contents,
            "product_num" => $product_num,
            "product_price"  => $product_price,
            "product_iamge" => $img_dir
        ]);
        
        
        $res =  DB::table('shops')->get();
        
        return view('shop.productAdmin',[  
                    'product' => $res
                     ]); 
        //
    }
//상품구매_재고만 줄어들게함
    public function productBuy($id)
    {


        $result = DB::table('shops')->where('product_id',$id)->get();
        
        foreach ($result as $user){
            $num= $user->product_num;
        }
        if($num!=0){
            $num -= 1;
            DB::table('shops')->where('product_id',$id)->update(['product_num' => $num]);
            
            echo "<script>
                window.alert('구매 되었습니다.');
            </script>";
            
        }else{
            echo "<script>
                window.alert('상품이 품절 되었습니다.');
            </script>";
        }
        
        
        
        $result = DB::table('shops')->where('product_id',$id)->get();
        
        return view('shop.productDetails',[  
                    'product' => $result
                     ]); 
        //
    }
    
    
    //장바구니 페이지이동  state = 1 (장바구니), state = 2 (구매)
    //상품정보페이지, 상품index페이지 2곳에서 넘어오는 함수
    public function productBasket($id)
    {
        
        $user_id = Auth::user()->id;
        
        if($id != 00){
            
            $result = DB::table('shops')->where('product_id',$id)->get();
        

        
            $product_id = $result[0]->product_id;
            $product_name = $result[0]->product_name;
            $product_num = $result[0]->product_num;
            $product_price = $result[0]->product_price;
            $product_image = $result[0]->product_iamge;
            $state = 1;
            
            DB::table('shopProductStates')->insert([
                "product_id"  => $product_id,
                "product_name" => $product_name,
                "product_num" => $product_num,
                "product_price"  => $product_price,
                "product_image" => $product_image,
                "user_id" => $user_id,
                "state" => $state
            ]);
            
            echo "<script>
                window.alert('장바구니에 추가되었습니다!');
            </script>";
            
            return view('shop.productDetails',[  
            'product' => $result
            ]); 
             
        }else{
            
            $result = DB::table('shopProductStates')->where('user_id',$user_id)->get();
            return view('shop.productBasket',[  
                        'product' => $result
                         ]); 
        }
        

        
        
    }
    //장바구니 상품 삭제
    public function productBasketDelete($id)
    {
        // $board = Board::find($id);
        // $board->delete();
        
        // return redirect('/board/boardList');
        
        
        
        DB::table('shopProductStates')->where('index_id',$id)->delete();    
        $result = DB::table('shopProductStates')->get();
        
        echo "<script>
                window.alert('목록에서 삭제했습니다.');
        
            </script>";
        return view('shop.productBasket',[  
                 'product' => $result
                     ]);
        
        DB::table('shopProductStates')->where('index_id',$id)->delete();    
        // $result = DB::table('shopProductStates')->get();
        
        echo"<script>
                window.alert('목록에서 삭제했습니다.');
        
            </script>";
        
        return redirect('/shop/productBasket/{id}');
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
        //
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
        // $path = $request->file('avatar')->store('avatars');

        // return $path;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
