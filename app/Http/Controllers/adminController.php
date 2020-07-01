<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\validateproduct;
use App\category_product;
use App\product;
use Carbon\Carbon;
use Mail;
use App\inforcontact;
use App\order;
use App\order_detail;
use App\status_order;
use App\User;
use Illuminate\Support\Facades\Auth;

//khai bao request
use App\Http\Requests\profile;

class adminController extends Controller
{
    public function admin(Carbon $carbon){
        //thong ke doanh thu theo thang
        //khai bao bien doanh thu theo thang
        $revenue = 0;
        $revenueLastMonth = 0;
        $ordercomplete = 0;
        $ordercancel = 0;
        $orderofmonth =0;
        $totalOrder = \App\order::all();
        foreach($totalOrder as $order){
            //cat chuoi de lay thang cua order
            $month = explode('-',$order->created_at);
            //neu thoi gian order nam trong thang hien tai thi cong vao doanh thu
            if($month[1] == $carbon->month){
                $orderofmonth += 1;
            }
            if($month[1] == $carbon->month && $order->id_status == 4){
                $ordercomplete += 1;
                $revenue += $order->totalpay;
            }
            if($month[1] == $carbon->month && $order->id_status == 5){
                $ordercancel += 1;
            }
            if($month[1]== (($carbon->month)-1) && $order->id_status == 4){
                $revenueLastMonth += $order->totalpay;
            }
        }

        //tinh do trang truong doang thu thang nay so voi thang truoc
        if($revenueLastMonth > 0){
            $grow = (($revenue / $revenueLastMonth) -1) * 100;
        }else{
            $grow = 0;
        }

        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }

        //thong ke so nguoi dung moi dang ky trong thang
        $newUsers = 0;
        $totalUsers = \App\User::all();
        foreach($totalUsers as $user){
            //cat chuoi de lay thang cua order
            $month = explode('-',$user->created_at);
            //neu thoi gian order nam trong thang hien tai thi cong vao doanh thu
            if($month[1] == $carbon->month){
                $newUsers += 1;
            }
        }
        $rateorder = array(
            "complete" => ($ordercomplete/$orderofmonth)*100,
            'cancel' => ($ordercancel/$orderofmonth)*100
        );
        return view('fontend.admin-dashboard',['revenue'=>$revenue,'newUsers'=>$newUsers,'grow'=>$grow,'quantityMessageUnread'=>$quantityMessageUnread,'rateorder'=>$rateorder]);
    }

    public function addproduct(){
        //duong them vao
        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }

        $category = new category_product();
        $listcategory = $category->get();
        return view('fontend.admin-addproduct',['listcategory'=>$listcategory,'quantityMessageUnread'=>$quantityMessageUnread]);
    }

    public function postaddproduct(validateproduct $request){
        $db = new product();
        $db->product_name = $request->nameproduct;
        $db->link_image = $request->linkimage;
        $db->price = $request->price;
        $db->sale_percent = $request->sale;
        $db->quantity = $request->quantity;
        $db->id_category = $request->id_category;
        $db->id_user = 1;
        $db->save();
        echo "<script>alert('Thêm thành công!!');history.back();</script>";
        return view('fontend.admin-addproduct');
    }

    public function product(){
        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }

        $db = new product();
        $ca = new category_product();
        $listca = $ca->get();
        if(isset($_GET['category'])&&!empty($_GET['category'])){
            $category = $_GET['category'];
            foreach($listca as $item){
                if($category == $item->slug_name){
                    $list = $db->where('id_category',$item->id)->orderBy('created_at','DESC')->get();
                }
            }
        }else if(empty($_GET['category'])){
            $list = $db->orderBy('created_at','DESC')->get();
        }
        // Paginate(15)
        return view('fontend.admin-product',['list'=>$list,'listca'=>$listca,'quantityMessageUnread'=>$quantityMessageUnread]);
    }

    public function searchproduct(){
        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }

        if(isset($_GET['q']) && !empty($_GET['q'])){
            $q = $_GET['q'];
        }else{
            $q = "noresult";
        }
        $db = new product();
        $ca = new category_product();
        $listca = $ca->get();
        if(isset($_GET['category'])&&!empty($_GET['category'])){
            $category = $_GET['category'];
            foreach($listca as $item){
                if($category == $item->slug_name){
                    $list = $db->where('id_category',$item->id)->orderBy('created_at','DESC')->get();
                }
            }
        }else if(empty($_GET['category'])){
            $list = $db->orderBy('created_at','DESC')->get();
        }
        $list = $db->where('id',$q)->orwhereRaw("product_name LIKE '%{$q}%' ")->get();;
        // Paginate(15)
        return view('fontend.admin-product',['list'=>$list,'listca'=>$listca,'quantityMessageUnread'=>$quantityMessageUnread]);
    }

    public function deleteproduct(){
        $id = $_GET['id'];
        $db = new product();
        $delete = $db->where('id',$id)->delete();
        return redirect()->back();
    }

    public function editproduct(){
        $id = $_GET['id'];
        $category = new category_product();
        $listcategory = $category->get();
        $db = new product();
        $product = $db->where('id',$id)->get();
        return view('fontend.admin-editproduct',['listcategory'=>$listcategory,'product'=>$product[0]]);
    }

    public function posteditproduct(validateproduct $request){
        $id = $_GET['id'];
        $db = new product();
        $db->where('id',$id)->update([
            'product_name' => $request->nameproduct,
            'link_image' => $request->linkimage,
            'price' => $request->price,
            'sale_percent' => $request->sale,
            'quantity' => $request->quantity,
            'id_category' => $request->id_category,
            'id_user' => 1
            ]);
        echo "<script>alert('Sửa thành công!!');history.back();</script>";
        return redirect()->route('product');
    }

    public function manageorder(){
        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }

        $db = new order();
        if(isset($_GET['status'])&&!empty($_GET['status'])){
            $status = $_GET['status'];
            if($status == 'all'){
                $data = $db->orderBy('created_at','DESC')->get();
            }elseif($status == 'approval'){
                $data = $db->where('id_status',2)->orderBy('created_at','DESC')->get();
            }elseif($status == 'cancel'){
                $data = $db->where('id_status',5)->orderBy('created_at','DESC')->get();
            }elseif($status == 'wait'){
                $data = $db->where('id_status',1)->orderBy('created_at','DESC')->get();
            }elseif($status == 'delivery'){
                $data = $db->where('id_status',3)->orderBy('created_at','DESC')->get();
            }elseif($status == 'delivered'){
                $data = $db->where('id_status',4)->orderBy('created_at','DESC')->get();
            }
        }elseif(empty($_GET['status'])){
            $data = $db->orderBy('created_at','DESC')->get();
        }
        return view('fontend.admin-manageorder',['data'=>$data,'quantityMessageUnread'=>$quantityMessageUnread]);
    }

    public function detailorder(){
        $id = $_GET['id'];
        $dborder = new order();
        $dataorder = $dborder->where('id',$id)->get();
        $dborderproduct = new order_detail();
        $dataorderproduct = $dborderproduct->where('id_order',$id)->get();
        return view('fontend.admin-detailorder',['dataorder'=>$dataorder[0],'dataorderproduct'=>$dataorderproduct]);
    }

    public function processorder(Request $request){
        $id = $request->id;
        $db = new order();
        $data = $db->where('id',$id)->get();
        if(isset($_POST['approval'])){
            $update = $db->where('id',$id)->update([
                'id_status' => 2
            ]);
            $content = 'Xin chào '.$data[0]->fullname.'. Đơn hàng của bạn đã được duyệt thành công và sẽ được giao trong vòng 5-7 ngày tới. Cảm ơn bạn đã tin tưởng chúng tôi. Mọi thông tin liên hệ xin gửi về: Email: sunshineweb.vn@gmail.com Phone: 0989735559';
            Mail::raw($content, function ($message) use($data) {
                $message->from('sunshineweb.vn@gmail.com', 'SoftMart');
                $message->to($data[0]->email,$data[0]->fullname);
                $message->subject('Thư xác nhận đơn hàng');
            });
        }else if(isset($_POST['cancel'])){
            $update = $db->where('id',$id)->update([
                'id_status' => 5
            ]);
            $content = 'Xin chào '.$data[0]->fullname.'. Đơn hàng của bạn đã bị hủy do vi phạm chính sách mua hàng của SoftMart. Cảm ơn bạn đã tin tưởng chúng tôi. Mọi thông tin liên hệ xin gửi về: Email: sunshineweb.vn@gmail.com Phone: 0989735559';
            Mail::raw($content, function ($message) use($data) {
                $message->from('sunshineweb.vn@gmail.com', 'SoftMart');
                $message->to($data[0]->email,$data[0]->fullname);
                $message->subject('Thư báo đơn hàng bị hủy');
            });
        }else if(isset($_POST['delivery'])){
            $update = $db->where('id',$id)->update([
                'id_status' => 3
            ]);
            $content = 'Xin chào '.$data[0]->fullname.'. Sản phẩm của bạn đã rời khỏi kho và sẽ được giao tới bạn trong vòng 5-7 ngày tới. Cảm ơn bạn đã tin tưởng chúng tôi. Mọi thông tin liên hệ xin gửi về: Email: sunshineweb.vn@gmail.com Phone: 0989735559';
            Mail::raw($content, function ($message) use($data) {
                $message->from('sunshineweb.vn@gmail.com', 'SoftMart');
                $message->to($data[0]->email,$data[0]->fullname);
                $message->subject('Thư báo thông tin đơn hàng');
            });
        }else if(isset($_POST['delivered'])){
            $update = $db->where('id',$id)->update([
                'id_status' => 4
            ]);
            $content = 'Xin chào '.$data[0]->fullname.'. Đơn hàng của bạn đã được giao thành công. Cảm ơn bạn đã tin tưởng chúng tôi. Mọi thông tin liên hệ xin gửi về: Email: sunshineweb.vn@gmail.com Phone: 0989735559';
            Mail::raw($content, function ($message) use($data) {
                $message->from('sunshineweb.vn@gmail.com', 'SoftMart');
                $message->to($data[0]->email,$data[0]->fullname);
                $message->subject('Thư báo giao hàng thành công');
            });
        }
        return redirect()->back();
    }

    //ham xu ly khi nguoi dung dat cau hoi
    public function contact(){
        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }
        //khai bao bang lay trong database
        $db = new inforcontact();
        if(isset($_GET['status'])&&!empty($_GET['status'])){
            $status = $_GET['status'];
            if($status == 'unread'){
                $data = $db->where('status',0)->orderBy('id','DESC')->Paginate(20);
            }else{
                if($status == 'read'){
                    $data = $db->where('status',1)->orderBy('created_at','DESC')->Paginate(20);
                }else{
                    $data = $db->orderBy('id','DESC')->Paginate(20);
                }
            }
        }else{
            $data = $db->orderBy('id','DESC')->SimplePaginate(20);
        }
        return view('fontend.admin-contact',['data'=>$data,'quantityMessageUnread'=>$quantityMessageUnread]);
    }

    //bieu do thong ke
    public function chart(Carbon $carbon){
        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }
        //doanh thu 12 thang nam hien tai
        $revenue1 = 0;
        $revenue2 = 0;
        $revenue3 = 0;
        $revenue4 = 0;
        $revenue5 = 0;
        $revenue6 = 0;
        $revenue7 = 0;
        $revenue8 = 0;
        $revenue9 = 0;
        $revenue10 = 0;
        $revenue11 = 0;
        $revenue12 = 0;

        //doanh thu 12 thang nam truoc
        $revenueLastYear1 = 0;
        $revenueLastYear2 = 0;
        $revenueLastYear3 = 0;
        $revenueLastYear4 = 0;
        $revenueLastYear5 = 0;
        $revenueLastYear6 = 0;
        $revenueLastYear7 = 0;
        $revenueLastYear8 = 0;
        $revenueLastYear9 = 0;
        $revenueLastYear10 = 0;
        $revenueLastYear11 = 0;
        $revenueLastYear12 = 0;
        $lastYear = $carbon->year - 1;

        $totalOrder = \App\order::all();
        foreach($totalOrder as $order){
            //cat chuoi de lay thang cua order
            $date = explode('-',$order->created_at);
            $year = $date[0];
            //neu thoi gian order nam trong thang hien tai thi cong vao doanh thu
            if($date[1] == 1 && $year == $carbon->year && $order->id_status == 4){
                $revenue1 += $order->totalpay;
            }
            if($date[1] == 2 && $year == $carbon->year && $order->id_status == 4){
                $revenue2 += $order->totalpay;
            }
            if($date[1] == 3 && $year == $carbon->year && $order->id_status == 4){
                $revenue3 += $order->totalpay;
            }
            if($date[1] == 4 && $year == $carbon->year && $order->id_status == 4){
                $revenue4 += $order->totalpay;
            }
            if($date[1] == 5 && $year == $carbon->year && $order->id_status == 4){
                $revenue5 += $order->totalpay;
            }
            if($date[1] == 6 && $year == $carbon->year && $order->id_status == 4){
                $revenue6 += $order->totalpay;
            }
            if($date[1] == 7 && $year == $carbon->year && $order->id_status == 4){
                $revenue7 += $order->totalpay;
            }
            if($date[1] == 8 && $year == $carbon->year && $order->id_status == 4){
                $revenue8 += $order->totalpay;
            }
            if($date[1] == 9 && $year == $carbon->year && $order->id_status == 4){
                $revenue9 += $order->totalpay;
            }
            if($date[1] == 10 && $year == $carbon->year && $order->id_status == 4){
                $revenue10 += $order->totalpay;
            }
            if($date[1] == 11 && $year == $carbon->year && $order->id_status == 4){
                $revenue11 += $order->totalpay;
            }
            if($date[1] == 12 && $year == $carbon->year && $order->id_status == 4){
                $revenue12 += $order->totalpay;
            }

            //neu thoi gian nam trong nam truoc thi cong doanh thu vao thang do nam truoc
            if($date[1] == 1 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear1 += $order->totalpay;
            }
            if($date[1] == 2 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear2 += $order->totalpay;
            }
            if($date[1] == 3 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear3 += $order->totalpay;
            }
            if($date[1] == 4 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear4 += $order->totalpay;
            }
            if($date[1] == 5 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear5 += $order->totalpay;
            }
            if($date[1] == 6 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear6 += $order->totalpay;
            }
            if($date[1] == 7 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear7 += $order->totalpay;
            }
            if($date[1] == 8 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear8 += $order->totalpay;
            }
            if($date[1] == 9 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear9 += $order->totalpay;
            }
            if($date[1] == 10 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear10 += $order->totalpay;
            }
            if($date[1] == 11 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear11 += $order->totalpay;
            }
            if($date[1] == 12 && $year == $lastYear && $order->id_status == 4){
                $revenueLastYear12 += $order->lastYear;
            }

        }
        $arrRevenue = [$revenue1,$revenue2,$revenue3,$revenue4,$revenue5,$revenue6,$revenue7,$revenue8,$revenue9,$revenue10,$revenue11,$revenue12];
        $arrRevenueLastYear = [$revenueLastYear1,$revenueLastYear2,$revenueLastYear3,$revenue4,$revenueLastYear5,$revenueLastYear6,$revenueLastYear7,$revenueLastYear8,$revenueLastYear9,$revenueLastYear10,$revenueLastYear11,$revenueLastYear12];

        return view('fontend.admin-chart',['revenue'=>$arrRevenue,'currentYear'=>$carbon->year,'lastYear'=>$lastYear,'revenueLastYear'=>$arrRevenueLastYear,'quantityMessageUnread'=>$quantityMessageUnread]);
    }

    //xem chi tiet message cua nguoi dung gui
    public function detailmessage($id){
        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }

        $data = \App\inforcontact::find($id);
        return view('fontend.admin-detailmessage',['data'=>$data,'quantityMessageUnread'=>$quantityMessageUnread]);
    }

    //xu ly ham post cua detail message
    public function postdetailmessage($id,Request $request){
        $data = [];
        $content = $request->contentreply;
        Mail::raw($content, function ($message) use($request) {
            $message->from('sunshineweb.vn@gmail.com', 'SoftMart');
            $message->to($request->email,$request->fullname);
            $message->subject('Thư trả lời');
        });
        $db = new inforcontact();
        $db->where('id',$id)->update(['status'=>1]);
        return redirect('admin/contact');
    }

    //Show danh sach user
    public function getAllUsers(){
        //thong ke so tin nhan chua tra loi (tra ve cho header)
        $dbinforcontact = new inforcontact();
        $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
        //neu khong ton tai tin nhan chua doc nao thi tra ve 0
        if($quantityMessageUnread<=0){
            $quantityMessageUnread = 0;
        }

        $db = new User();
        //lay ra list user theo the loai neu co bien type tren URL
        if(isset($_GET['type'])&&!empty($_GET['type'])){
            //lay ra bien type de loc theo the loai
            $type = $_GET['type'];
            //loai thuong
            if($type == 'normal'){
                $data = $db->where('id_group',1)->Paginate(20);
            }else{
                //loai admin
                if($type == 'admin'){
                    $data = $db->where('id_group',3)->Paginate(20);
                }else{
                    //loai quan li
                    if($type == 'manager'){
                        $data = $db->where('id_group',2)->Paginate(20);
                    }else{
                        $data = $db->Paginate(20);
                    }
                }
            }
        }else{
            //neu khong co bien type tren URL => show danh sach tat ca user
            $data = $db->Paginate(20);
        }

        return view('fontend.admin-listuser',['data'=>$data,'quantityMessageUnread'=>$quantityMessageUnread]);
    }
    public function getedituser(){
        if(isset($_GET['id'])&&!empty($_GET['id'])){

            $id = $_GET['id'];
            $db = new User();
            $data = $db->findOrFail($id);
            return view('fontend.admin-edituser',['data'=>$data]);
        }else{
            return redirect('admin');
        }

    }
    public function postedituser(Request $request){
        $check = 0;
        foreach(Auth::user()->group_user->permission as $permission){
            if($permission->permission == 'edituser'){
                $check = 1;
                break;
            }
        }
        // neu nguoi dung co quyen update user
        if($check == 1){
            if(isset($_GET['id'])&&!empty($_GET['id'])){
                $id = $_GET['id'];
                $db = new User();
                $db->where('id',$id)->update(['fullname'=>$request->fullname,'phone'=>$request->phone,'address'=>$request->address,'id_group'=>$request->position]);
                return redirect("admin/listuser")->with('thongbao','sửa user thành công');
            }else{
                return redirect('admin');
            }
        }else{
            echo "<script>alert('Bạn không đủ thẩm quyền để làm điều này');history.back();</script>";
        }
    }

    //xoa user
    public function deleteUser(){
        //khai bao bien check de kiem tra xem nguoi dung co quyen xoa user hay khong
        $check = 0;
        //duyet tat ca cac quyen cua nguoi dung hien tai
        if(Auth::check()){
            foreach(Auth::user()->group_user->permission as $permission){
            //neu nguoi dung co quyen xoa user
            if($permission->permission == 'deleteuser'){
                $check = 1;
                break;

            }
            }
        }
        else{
            return view('login');
        }

        //thuc hien khi biet nguoi dung co quyen xoa user
        if($check == 1){
            if(isset($_GET['id'])&&!empty($_GET['id'])){
                $id = $_GET['id'];
                $db = new User();
                $db->where('id',$id)->delete();
                return redirect()->back();
            }
        }else{
            echo "<script>alert('Bạn không đủ thẩm quyền để làm điều này');history.back();</script>";
        }
    }

    //show profile cua tai khoan
    public function getProfile(){
        if(isset($_GET['id'])&&!empty($_GET['id'])){
            //thong ke so tin nhan chua tra loi (tra ve cho header)
            $dbinforcontact = new inforcontact();
            $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
            //neu khong ton tai tin nhan chua doc nao thi tra ve 0
            if($quantityMessageUnread<=0){
                $quantityMessageUnread = 0;
            }

            $id = $_GET['id'];
            $db = new User();
            $data = $db->findOrFail($id);
            return view('fontend.admin-profile',['data'=>$data,'quantityMessageUnread'=>$quantityMessageUnread]);
        }else{
            return redirect('admin');
        }
    }

    public function updateProfile(profile $request){

        // neu nguoi dung co quyen update user

            if(isset($_GET['id'])&&!empty($_GET['id'])){
                $id = $_GET['id'];
                $db = new User();
                $db->where('id',$id)->update(['fullname'=>$request->fullname,'phone'=>$request->phone,'address'=>$request->address]);
                return redirect()->back();
            }else{
                return redirect('admin');
            }

    }

    //admin tim kiem nguoi dung trong muc quan li user
    public function searchUser(){
        if(isset($_GET['q'])&&!empty($_GET['q'])){
            //thong ke so tin nhan chua tra loi (tra ve cho header)
            $dbinforcontact = new inforcontact();
            $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
            //neu khong ton tai tin nhan chua doc nao thi tra ve 0
            if($quantityMessageUnread<=0){
                $quantityMessageUnread = 0;
            }

            //tim kiem theo request
            $q = $_GET['q'];
            $db = new User();
            $data = $db->where('id',$q)->orWhereRaw("username LIKE '%{$q}%'")->orWhereRaw("email LIKE '%{$q}%'")->Paginate(20);
            return view('fontend.admin-listuser',['data'=>$data,'quantityMessageUnread'=>$quantityMessageUnread]);
        }else{
            return redirect()->route('showlistuser');
        }
    }

    //admin tim kiem nguoi dung dat cau hoi trong phan contact
    public function searchMessage(){
        if(isset($_GET['q'])&&!empty($_GET['q'])){
            //thong ke so tin nhan chua tra loi (tra ve cho header)
            $dbinforcontact = new inforcontact();
            $quantityMessageUnread = $dbinforcontact->where('status',0)->count();
            //neu khong ton tai tin nhan chua doc nao thi tra ve 0
            if($quantityMessageUnread<=0){
                $quantityMessageUnread = 0;
            }

            //tim kiem theo request
            $q = $_GET['q'];
            $db = new inforcontact();
            $data = $db->whereRaw("fullname LIKE '%{$q}%'")->orWhereRaw("email LIKE '%{$q}%'")->Paginate(20);
            return view('fontend.admin-contact',['data'=>$data,'quantityMessageUnread'=>$quantityMessageUnread]);
        }
    }
}
