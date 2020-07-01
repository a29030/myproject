<!-- <?php

use Illuminate\Database\Seeder;

class product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $j = 1;
        for($i=1;$i<=100;$i++){
            DB::table('product')->insert([
                ['product_name'=>'Exchange online','link_image'=>"fontend/assets/img/{$j}.png",'price'=>250000,'sale_percent'=>10,'description'=>'Là dịch vụ thư điện tử trực tuyến của Microsoft và là một phần của ','id_category'=>$j,'id_user'=>1,'created_at'=>'2020-06-18 04:08:45']
            ]);
            $j++;
            if($j>=12){
                $j=1;
            }
        }
    }
}
