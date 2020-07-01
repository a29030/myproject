<?php

namespace App\Http\Controllers;
use App\Http\Requests\authRequest;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Http\Requests\payment;
use App\product;
use App\User;
use App\cart;
use Illuminate\Support\Facades\Auth;
use App\discount;
use App\order;
use App\order_detail;
use App\comment;
use App\comment_product;
use App\review_product;
use Mail;

//khai bao request
use App\Http\Requests\profile;
use App\Http\Requests\changepassword;

class userController extends Controller
{
    //them vao gio hang
    public function addCart(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //neu nguoi dung da dang nhap thi cap nhat vao database
            if(Auth::check()){
                //bien count de dem so luong san pham co trong gio hang
                $count = 0;
                //bien check de kiem tra xem id san pham muon them vao gio hang da ton tai hay chua
                $check = 0;
                //them san pham vao gio hang
                $dbcart = new cart();
                $cart = $dbcart->where('id_user',Auth::user()->id)->get();
                //duyet gio hang cua nguoi dung trong database ,neu da ton tai id san pham do trong gio hang thi + 1, con chua thi them san pham co id do voi so luong = 1
                foreach($cart as $item){
                    //neu da ton tai id san pham do
                    if($item->id_product==$id){
                        $dbcart->where('id_user',Auth::user()->id)->where('id_product',$id)->update(['quantity'=>$item->quantity+1]);
                        $check = 1;
                        break;
                    }
                }
                //neu chua ton tai id san pham do trong gio hang
                if($check==0){
                    $dbcart->id_user = Auth::user()->id;
                    $dbcart->id_product = $id;
                    $dbcart->quantity = 1;
                    $dbcart->save();
                }
                //duyet lai 1 lan de cap nhat session
                $cart = $dbcart->where('id_user',Auth::user()->id)->get();
                foreach($cart as $item){
                    //set session gio hang
                    session()->put("fecart.{$item->id_product}",$item->quantity);
                    //cap nhat lai so luong san pham co trong gio hang
                    $count += $item->quantity;
                }
                session()->put("countcart",$count);
            }else{ //neu nguoi dung khong dang nhap
                if(session('countcart')&&session('countcart')>0){
                    $count = session('countcart');
                }else{
                    $count = 0;
                }
                if(session("fecart.{$id}")>0){
                    $oldQuantity = intval(session("fecart.{$id}"));
                    $newQuantity = $oldQuantity + 1;
                    session()->put("fecart.{$id}",$newQuantity);
                }else{
                    session()->put("fecart.{$id}",1);
                }
                //dem so san pham co trong gio hang tra ve cho header
                $count++;
                session()->put('countcart',$count);
            }
        }
        return $count;
    }

    public function getCart(){
        $database = new product();
        //lay ra cac key san pham co trong gio hang
        $arrayKeys = '0';
        if(!empty(session("fecart"))){
            $keys = array_keys(session('fecart'));
            foreach($keys as $key){
                //cho tat ca cac id san pham co trong gio hang vao chuoi de duyet 1 lan
                $arrayKeys = $arrayKeys . ',' . $key;
            }
            $data = $database->whereRaw("id IN({$arrayKeys})")->get()->toArray();
            return view('fontend.checkout',["data"=>$data]);
        }else{
            return view('fontend.checkout');
        }
    }

    public function resetCart(){
        session()->flush();
        return redirect('/');
    }

    public function updateCartDown(){
        if(isset($_GET['productId'])&&isset($_GET['oldquantity'])){
            $oldQuantity = $_GET['oldquantity'];
            $id = $_GET['productId'];
        }else{
            return redirect()->back();
        }
        if(Auth::check()){
            //bien count de dem so luong san pham co trong gio hang
            $count = 0;
            //giam san san pham vao gio hang
            $dbcart = new cart();
            $cart = $dbcart->where('id_user',Auth::user()->id)->get();
            //duyet gio hang cua nguoi dung trong database ,neu da ton tai id san pham do trong gio hang thi + 1, con chua thi them san pham co id do voi so luong = 1
            foreach($cart as $item){
                //neu da ton tai id san pham do
                if($item->id_product==$id){
                    $dbcart->where('id_user',Auth::user()->id)->where('id_product',$id)->update(['quantity'=>$item->quantity-1]);
                    break;
                }
            }
            //duyet lai 1 lan de cap nhat session
            $cart = $dbcart->where('id_user',Auth::user()->id)->get();
            foreach($cart as $item){
                //set session gio hang
                session()->put("fecart.{$item->id_product}",$item->quantity);
                //cap nhat lai so luong san pham co trong gio hang
                $count += $item->quantity;
            }
            session()->put("countcart",$count);
        }else{
            $count = intval(session("countcart"))-1;
            session()->put("countcart",$count);
            $newQuantity = intval(session("fecart")[$id])-1;
            session()->put("fecart.{$id}",$newQuantity);
        }
        $database = new product();
        //lay ra cac key san pham co trong gio hang
        $arrayKeys = '0';
        if(!empty(session("fecart"))){
            $keys = array_keys(session('fecart'));
            foreach($keys as $key){
                //cho tat ca cac id san pham co trong gio hang vao chuoi de duyet 1 lan
                $arrayKeys = $arrayKeys . ',' . $key;
            }
            $data = $database->whereRaw("id IN({$arrayKeys})")->get()->toArray();
            return view('fontend.ajaxcart',["data"=>$data]);
        }
    }

    public function updateCartUp(Request $request){
        if(isset($_GET['productId'])&&isset($_GET['oldquantity'])){
            $oldQuantity = $_GET['oldquantity'];
            $id = $_GET['productId'];
        }else{
            return redirect()->back();
        }
        if(Auth::check()){
            //bien count de dem so luong san pham co trong gio hang
            $count = 0;
            $dbcart = new cart();
            $cart = $dbcart->where('id_user',Auth::user()->id)->get();
            //duyet gio hang cua nguoi dung trong database ,neu da ton tai id san pham do trong gio hang thi + 1, con chua thi them san pham co id do voi so luong = 1
            foreach($cart as $item){
                //neu da ton tai id san pham do
                if($item->id_product==$id){
                    $dbcart->where('id_user',Auth::user()->id)->where('id_product',$id)->update(['quantity'=>$item->quantity+1]);
                    break;
                }
            }
            //duyet lai 1 lan de cap nhat session
            $cart = $dbcart->where('id_user',Auth::user()->id)->get();
            foreach($cart as $item){
                //set session gio hang
                session()->put("fecart.{$item->id_product}",$item->quantity);
                //cap nhat lai so luong san pham co trong gio hang
                $count += $item->quantity;
            }
            session()->put("countcart",$count);
        }else{
            $newQuantity = intval(session("fecart")[$id])+1;
            session()->put("fecart.{$id}",$newQuantity);
            $count = intval(session("countcart"))+1;
            session()->put("countcart",$count);
        }
        $database = new product();
        //lay ra cac key san pham co trong gio hang
        $arrayKeys = '0';
        if(!empty(session("fecart"))){
            $keys = array_keys(session('fecart'));
            foreach($keys as $key){
                //cho tat ca cac id san pham co trong gio hang vao chuoi de duyet 1 lan
                $arrayKeys = $arrayKeys . ',' . $key;
            }
            $data = $database->whereRaw("id IN({$arrayKeys})")->get()->toArray();
            return view('fontend.ajaxcart',["data"=>$data]);
        }
    }

    //update lai so luong san pham co trong gio hang tra ve cho header
    public function updateCountCartUp(){
        if(isset($_GET['countcart'])&&!empty($_GET['countcart'])){
            $countcart = $_GET['countcart']+1;
            return $countcart;
        }
    }

    //update lai so luong san pham co trong gio hang tra ve cho header
    public function updateCountCartDown(){
        if(isset($_GET['countcart'])&&!empty($_GET['countcart'])){
            $countcart = $_GET['countcart']-1;
            return $countcart;
        }
    }

    public function deleteCart($id){
        if(Auth::check()){
            $dbcart = new cart();
            $dbcart->where('id_user',Auth::user()->id)->where('id_product',$id)->delete();
        }
        //tao lai session dem so luong san pham co trong gio hang cho header
        if(session('countcart')&&session('countcart')>0){
            $oldCount = intval(session("fecart.{$id}"));
            $count = intval(session('countcart'));
            $newCount = $count - $oldCount;
            session()->put('countcart',$newCount);
        }
        session()->forget("fecart.{$id}");
        return redirect('/');
    }

    public function payment(){
        if(session("fecart")&&!empty(session('fecart'))){
            //khai bao database
            $database = new product();
            //khai bao chuoi rong de chua cac id san pham co trong gio hang
            $arrayKeys = '0';
            //neu nguoi dung da dang nhap thi gui kem thong tin cua nguoi dung cho view payment
            $keys = array_keys(session('fecart'));
            foreach($keys as $key){
                //luu cac id vao trong 1 chuoi
                $arrayKeys = $arrayKeys . ',' . $key;
            }
            //lay ra thong tin cua cac san pham do
            $dataproducts = $database->whereRaw("id IN({$arrayKeys})")->get()->toArray();
            if(Auth::check()){
                $db = new User();
                $data = $db->where('id',Auth::user()->id)->get();
                return view('fontend.payment',['data'=>$data[0],'dataproducts'=>$dataproducts]);
            }else{
                return view('fontend.payment',['dataproducts'=>$dataproducts]);
            }
        }else{
            return redirect('checkout');
        }
    }

    //ham xu ly post cua route payment
    public function postPayment(payment $request){
        if(session("fecart")&&!empty(session("fecart"))){
            $db = new order();
            // //lay ra id cua order gan nhat
            $currentID = $db->max('id');
            // //luu thong tin vao bang order
            $db->id = $currentID+1;
            $db->fullname = $request->fullname;
            $db->email = $request->email;
            $db->phone = $request->phone;
            $db->address = $request->address;
            $db->totalpay = $request->total;
            if(session('sale_percent2') && !empty(session('sale_percent2'))){
                $db->sale_percent = session('sale_percent2');
            }else{
                $db->sale_percent = 0;
            }
            $db->id_status = 1;
            if(Auth::check()){
                $db->id_user = Auth::user()->id;
            }
            $db->save();

            // //luu thong tin vao bang order_detail
            // //voi moi id co trong session luu vao 1 row tren database , bang order_detail
            $keys = array_keys(session('fecart'));
            foreach($keys as $key){
                $dbOrder_detail = new order_detail();
                $dbOrder_detail->id_order = $currentID+1;
                $dbOrder_detail->id_product = $key;
                $dbOrder_detail->quantity = intval(session("fecart.{$key}"));
                $dbOrder_detail->save();
            }
            session()->forget('fecart');
            session()->forget('countcart');
            if(Auth::check()){
                $dbcart = new cart();
                $dbcart->where('id_user',Auth::user()->id)->delete();
            }
            echo "<script>alert('Đặt hàng thành công, hàng sẽ giao trong vòng 5 - 7 ngày. Chúc bạn 1 ngày vui vẻ !');window.location.href='".URL::to('/')."';</script>";
            $content = 'Xin chào '.$request->fullname.'. Đặt hàng thành công, giá trị đơn hàng của bạn là '.number_format($request->total).' bộ phận xử lý đơn hàng sẽ xử lý đơn hàng của bạn và tiến hành giao hàng cho bạn sớm nhất. Cảm ơn bạn đã tin tưởng chúng tôi. Mọi thông tin liên hệ xin gửi về: Email: sunshineweb.vn@gmail.com Phone: 0989735559';
            Mail::raw($content, function ($message) use($request) {
                $message->from('sunshineweb.vn@gmail.com', 'SoftMart');
                $message->to($request->email,$request->fullname);
                $message->subject('Thư báo đặt hàng thành công');
            });
        }else{
            return redirect('/');
        }
    }

    public function wishlist(){
        if(Auth::check()){
            $dataproduct = new product();
            $wishlist =  Auth::user()->wishlist;
            if(!empty($wishlist)){
                $arraylist = explode(',',$wishlist);
                session()->put('wishlist',count($arraylist));
                $data = $dataproduct->whereRaw("id IN({$wishlist})")->get();
            }else{
                $data = [];
                session()->forget('wishlist');
            }
            return view('fontend.wishlist',['data'=>$data]);
        }else{
            return view('fontend.wishlist');
        }
    }

    public function addwishlist($id){
        if(Auth::check()){
            $wishlist =  Auth::user()->wishlist;
            $arraylist = explode(',',$wishlist);
            $check = 0;
            foreach($arraylist as $item){
                if($item==$id){
                    $check =1;
                }
            }
            if($check==0 && empty($wishlist)){
                $wishlist = $id;
            }else if($check==0 && !empty($wishlist)){
                $wishlist =  $wishlist .','. $id;
            }
            $update = User::find(Auth::user()->id);
            $update->wishlist = $wishlist;
            $update->save();
            $wishlist =  Auth::user()->wishlist;
            $arraylist = explode(',',$wishlist);
            session()->put('wishlist',count($arraylist));
            return redirect()->back();
        }else{
            echo "<script>alert('Bạn cần đăng nhập để thêm vào sản phẩm yêu thích!!');history.back();</script>";
        }
    }

    public function deletewishlist($id){
        if(Auth::check()){
            $wishlist =  Auth::user()->wishlist;
            $arraylist = explode(',',$wishlist);
            for($i=0;$i<count($arraylist);$i++){
                if($arraylist[$i]==$id){
                    unset($arraylist[$i]);
                }
            }
            $listupdate = implode(',',$arraylist);
            $update = User::find(Auth::user()->id);
            $update->wishlist = $listupdate;
            $update->save();

            if(!empty($arraylist)){
                $wishlist =  Auth::user()->wishlist;
                $arraylist = explode(',',$wishlist);
                session()->put('wishlist',count($arraylist));
            }else{
                session()->forget('wishlist');
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    //Kiem tra code dung hay sai va lay ra thong tin code
    public function checkcode(){
        if(isset($_GET['serrie'])&&!empty($_GET['serrie'])){
            //get tham so serrie tren url
            $serrie = $_GET['serrie'];
            //khai bao database de checkcode
            $db = new discount();
            //kiem tra code giam gia co ton tai hay khong
            $result = $db->where('code',$serrie)->get();
            //neu co ton tai
            if(isset($result[0]['sale_percent'])&&!empty($result[0]['sale_percent'])){
                echo $result[0]['sale_percent'];
                session()->flash("checkcodesuccess","true");
                session()->flash("sale_percent",$result[0]['sale_percent']);
                session()->flash('serriecode',$serrie);
                return redirect('payment')->with('resultcheckcode','Mã đã được áp dụng thành công!');
            }else{ //neu khong ton tai
                session()->flash("checkcodesuccess","false");
                session()->flash("sale_percent",0);
                session()->flash('serriecode',$serrie);
                return redirect('payment')->with('resultcheckcode','Mã không đúng!');
            }
        }else{
            return redirect()->back();
        }
    }

    //bam nut xoa code khi khong muon su dung code
    public function forgetcode(){
        session()->forget("checkcodesuccess");
        session()->forget("sale_percent");
        session()->forget("sale_percent2");
        session()->forget("resultcheckcode");
        session()->forget("serriecode");
        return redirect('payment');
    }


    public function login()
    {
        return view('fontend.login');
    }

    public function check(Request $request){
        $username= $request->username;
        $password= $request->password;
        if(Auth::attempt(['username'=>$username,'password'=>$password])){
            session()->forget('fecart');
            session()->forget('countcart');

            //phan quyen cho middleware
            if(Auth::user()->id_group != 1){
                return redirect()->route('admin');
            }else{
                return redirect()->route('index');
            }
        }
        else
        {
            return redirect('login')->with('thongbao1','username hoặc password không đúng');
        }

    }

    public function logout(){
        session()->flush();
        Auth::logout();
        return redirect()->back();
    }

    public function cancelorder(){
        if(Auth::check()){
            if(isset($_GET['id'])&&!empty($_GET['id'])){
                $id = $_GET['id'];
                $db = new order();
                $update = $db->where('id',$id)->update([
                    'id_status' => 5
                ]);
                return redirect()->back();
            }
        }
    }
    public function account(){
        if(Auth::check()){
            $db = new order();
            $listorder = $db->where('id_user',Auth::user()->id)->get();
        }else{
            $listorder = [];
        }
        return view('fontend.account',['listorder'=>$listorder]);
    }

    //nguoi dung update thong tin ca nhan
    public function updateAccount(profile $request){
        $db = new User();
        $db->where('id',Auth::user()->id)->update(['fullname'=>$request->fullname,'phone'=>$request->phone,'address'=>$request->address]);
        echo "<script>alert('Cập nhật thông tin thành công');window.location.href='".URL::to('/account')."'</script>";
    }

    //thuc hien doi mat khau
    public function changepassword(changepassword $request){
        $db = new User();
        if($request->password == Auth::user()->password){
            $db->where('id',Auth::user()->id)->update(['password'=>bcrypt($request->newpassword)]);
            echo "<script>alert('Đổi mật khẩu thành công');window.location.href='".URL::to('/account')."'</script>";
        }else{
            echo "<script>alert('Mật khẩu cũ không chính xác, vui lòng thử lại');history.back();</script>";
        }
    }

    public function postcomment(Request $request){
        $db = new comment();
        if(Auth::check()){
            if(isset($_POST['postcomment'])){
                $db->id_news = $request->id;
                $db->id_user = Auth::user()->id;
                $db->content = $request->input_comment;
                $db->save();
                return redirect()->back();
            }else if(isset($_POST['editcomment'])&&!empty($_POST['editcomment'])){
                if(!empty($_POST['id'])){
                    // $request = $request->toArray();
                    // dd($request);
                    $update = $db->where('id',$request->id)->update([
                        'content' => $request->input_comment
                    ]);
                    return redirect()->back();
                }
            }
        }else{
            echo "<script>alert('Bạn phải đăng nhập để được bình luận!!');history.back();</script>";
        }
    }

    public function deletecomment(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $db = new comment();
            $delete = $db->where('id',$id)->delete();
        }
        return redirect()->back();
    }

    public function register(){
        return view('fontend.register');
    }

    public function pregister(Request $request){
        $this->validate($request, [
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:32',
            'Repassword'=>'required|same:password',
            'phone'=>'numeric|regex:/(0)[0-9]{9}/'
        ], [
                'username.required' => 'Bạn chưa nhập username',
                'username.min' => 'uername ít nhất 3 kí tự',
                'username.unique' => 'username đã tồn tại',
                'email.required' => 'bạn chưa nhập email',
                'email.email' => 'bạn chưa nhập đúng định dạng email',
                'email.unique' => 'email đã có người sử dụng',
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'password có ít nhất 6 kí tự',
                'password.max' => 'password có nhiều nhất 32 kí tự',
                'phone.phone_number'=>'nhap khong dung dinh dang sdt',
                'phone.regex'=>'Số điện thoại không đúng định dạng',
                'Repassword.same'=>'password và repassword không đúng'
            ]
        );
        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->id_group = 1;
        $user->save();
        return redirect('login')->with('thongbao', 'Bạn đã đăng ký thành công');
    }

    //nguoi dung danh gia san pham
    public function addreview(Request $request){
        //khai bao database
        $db = new review_product();

        //neu nguoi dung tich vao so sao
        if(isset($request->rate)&&!empty($request->rate)){
            $rate = intval($request->rate);
        }else{
            $rate = 1;
        }

        //neu nguoi dung viet noi dung binh luan
        if(isset($request->contentreview)&&!empty($request->contentreview)){
            $content = $request->contentreview;
        }else{
            $content = '';
        }

        //kiem tra xem id nguoi dung do da danh gia san pham do hay chua, neu co bien review se tra ve > 0
        $review = $db->where('id_product',$request->id_product)->where('id_user',Auth::user()->id)->count();
        if($review == 0){
            $db->id_product = $request->id_product;
            $db->content = $content;
            $db->star = $rate;
            $db->id_user = Auth::user()->id;
            $db->save();
            echo "<script>alert('Cảm ơn bạn đã đánh giá sản phẩm !')</script>";
        }
        return redirect()->back();
    }

    //nguoi dung chinh sua san pham
    public function editreview(Request $request){
        //khai bao database
        $db = new review_product();

        //neu nguoi dung tich vao so sao
        if(isset($request->rate)&&!empty($request->rate)){
            $rate = intval($request->rate);
        }else{
            $rate = 1;
        }

        //neu nguoi dung viet noi dung binh luan
        if(!empty($request->contentreview)){
            $content = $request->contentreview;
        }else{
            $content = '';
        }

        //kiem tra xem id nguoi dung do da danh gia san pham do hay chua, neu co bien review se tra ve > 0
        $review = $db->where('id_product',$request->id_product)->where('id_user',Auth::user()->id)->count();
        if($review == 1){
            $db->where('id_product',$request->id_product)->where('id_user',Auth::user()->id)->update(['content'=>$content,'star'=>$rate]);
            echo "<script>alert('Cảm ơn bạn đã đánh giá sản phẩm !')</script>";
        }
        return redirect()->back();
    }

    public function addcomment(Request $request){
        $db = new comment_product();
        $db->id_product = $request->id_product;
        $db->id_user = Auth::user()->id;
        $db->comment = $request->contentcomment;
        $db->save();
        return redirect()->back();
    }

}
