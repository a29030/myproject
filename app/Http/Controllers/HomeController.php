<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\category_product;
use App\category_news;
use App\comment;
use App\product;
use App\news;
use App\review_product;
use App\User;
use App\inforcontact;
use App\cart;
use App\comment_product;
use Illuminate\Support\Facades\Auth;
use Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // Hàm xử lý index
    public function index()
    {
        $count = 0;
        //neu nguoi dung dang nhap se lay ra gio hang co trong database
        if(Auth::check()){
            $countcart = 0;
            $dbcart = new cart();
            $cart = $dbcart->where('id_user',Auth::user()->id)->get();
            foreach($cart as $item){
                session()->put("fecart.{$item->id_product}",$item->quantity);
                $countcart += $item->quantity;
            }
            session()->put("countcart",$countcart);

            $wishlist =  Auth::user()->wishlist;
            $arraylist = explode(',',$wishlist);
            if(empty($wishlist)){
                session()->forget('wishlist');
            }else{
                session()->put('wishlist',count($arraylist));
            }
        }
        $DetailProduct = \App\product::all()->take(12);
        //duong lam tiep
        //lay ra id cua tat ca danh muc
        $categories = \App\category_product::all();
        $list = [];
        $i = 0;
        $count = 0;
        foreach($categories as $category){
            //dua 6 san pham cua moi danh muc vao 1 mang
            $list[$i] = \App\category_product::find($category->id)->products->take(6);
            $i++;
            //bien count de dem co bao nhieu danh muc
            $count++;
        }

        //lay ra thong tin cua 6 bai viet
        $news = \App\news::all()->take(6);

        return view('fontend.index',['DProduct'=>$DetailProduct,'list'=>$list,'quantityCategory'=>$count,'listNameCategory'=>$categories,'news'=>$news]);
    }

    public function blog()
    {
        $datanew = news::Paginate(3);
        $datacategory = category_news::all();
        return view('fontend.blog',['datacategory'=>$datacategory,'datanew'=>$datanew]);
    }

    public function detailnew()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $datanew = news::find($id);
            $datacategory = category_news::all();
            $db = new comment();
            $comment = $db->join('users','users.id','comment.id_user')->where('comment.id_news','=',$id)->get();
            return view('fontend.detailnew',['datacategory'=>$datacategory,'datanew'=>$datanew,'datacomment'=>$comment]);
        }else{
            $datanew = news::all();
            $datacategory = category_news::all();
            return view('fontend.blog',['datacategory'=>$datacategory,'datanew'=>$datanew]);
        }
    }

    public function searchnew()
    {
        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = $_GET['q'];
        }else{
            $q = "noresult";
        }
        $db = new news();
        $datanew = $db->where('id',$q)->orwhereRaw("title LIKE '%{$q}%' ")->get();
        $datacategory = category_news::all();
        return view('fontend.blog',['datacategory'=>$datacategory,'datanew'=>$datanew]);
    }

    public function detailcategory(Request $request)
    {
        $path = $request->path();
        $split = explode('/',$path);
        $db = new news();
        $datanew = $db->join('category_news','category_news.id','news.id_category')->where('category_news.slug_name',$split[1])->Paginate(3);
        $datacategory = category_news::all();
        return view('fontend.category_news',['datacategory'=>$datacategory,'datanew'=>$datanew]);
    }

    // Hàm xử lý ctsp
    public function ctsp()
    {
        if(isset($_GET['id'])&&!empty($_GET['id'])){
            $id = $_GET['id'];
            $product = \App\product::findOrFail($id);
            $db = new review_product();
            $reviews = $db->join('users','users.id','review_product.id_user')->where('review_product.id_product','=',$id)->get();
            $check = 0;
            $checkreviewexist = 0;
            $dbcomment = new comment_product();
            $comments = $dbcomment->join('users','users.id','comment_product.id_user')->where('comment_product.id_product','=',$id)->select('comment_product.id','comment_product.id_product','comment_product.id_user','comment_product.comment','users.fullname','comment_product.created_at')->orderBy('id','DESC')->get();
            if(Auth::check()){
                $wishlist =  Auth::user()->wishlist;
                $arraylist = explode(',',$wishlist);
                foreach($arraylist as $item){
                    if($item==$id){
                        $check =1;
                    }
                }
                $checkoldreview = $db->where('id_product',$id)->where('id_user',Auth::user()->id)->count();
                if($checkoldreview>0){
                    $oldreview = $db->where('id_product',$id)->where('id_user',Auth::user()->id)->get();
                }
                if(!empty($oldreview)){
                    $checkreviewexist = 1;
                }
                if(!empty($product) && !empty($oldreview) && $checkreviewexist == 1){
                    return view('fontend.chi-tiet-sp',['data'=>$product,'reviews'=>$reviews,'check'=>$check,'checkreviewexist'=>$checkreviewexist,'oldreview'=>$oldreview,'comments'=>$comments]);
                }else{
                    if(!empty($product)){
                        return view('fontend.chi-tiet-sp',['data'=>$product,'reviews'=>$reviews,'check'=>$check,'checkreviewexist'=>$checkreviewexist,'comments'=>$comments]);
                    }else{
                        return redirect('/');
                    }
                }
            }else{
                return view('fontend.chi-tiet-sp',['data'=>$product,'reviews'=>$reviews,'check'=>$check,'checkreviewexist'=>$checkreviewexist,'comments'=>$comments]);
            }
        }else{
            return redirect('/');
        }
    }


    // Hàm xử lý index
    public function contact()
    {
        return view('fontend.contact');
    }

    public function sendinfor(Request $request)
    {
        $db = new inforcontact();
        $db->fullname = $request->fullname;
        $db->email = $request->email;
        $db->phone = $request->phone;
        $db->content = $request->content;
        $db->save();
        $data = [
            'name' => $request->fullname
        ];
        $clientmail = $request->email;
        $clientname = $request->fullname;
        Mail::send('fontend.mail', $data, function ($message) use($request) {
            $message->from('sunshineweb.vn@gmail.com', 'SoftMart');
            $message->to($request->email,$request->fullname);
            $message->subject('Thư xác nhận');
        });
        echo "<script>alert('Thông tin của bạn đã gửi thành công!!');history.back();</script>";
        $request = null;
        return view('fontend.contact');
    }

    // Hàm xử lý index
    public function policy()
    {
        return view('fontend.policy');
    }

    public function shop()
    {
        $db = new category_product();
        $categories = $db->all();
        $db2 = new product();
        //lay du lieu va phan trang
        $data = $db2->Paginate(15);
        return view('fontend.shop',['data'=>$data,'categories'=>$categories]);
    }

    public function search(){
        if(isset($_GET['q'])&&!empty($_GET['q'])){
            $q = $_GET['q'];
        }else{
            $q = "noresult";
        }
        $db2 = new product();
        //tim kiem theo id va ten san pham
        $result = $db2->where('id',$q)->orwhereRaw("product_name LIKE '%{$q}%' ")->Paginate(15);
        $db = new category_product();
        $categories = $db->all();
        return view('fontend.search',['data'=>$result,'categories'=>$categories]);
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
    public function update(Request $request, $id)
    {
        //
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

    public function getProductWithCategory($slug_name){
        $categories = \App\category_product::all();
        $db = new category_product();
        $products = $db->join('product','product.id_category','category_product.id')->where('category_product.slug_name',$slug_name)->Paginate(15);
        return view('fontend.category',['data'=>$products,'categories'=>$categories]);
    }
}
