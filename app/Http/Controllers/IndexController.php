<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;

class IndexController extends Controller
{
    public function index(){
       $products =  Http::withHeaders([
            'Content-Type'=>'application/json',
            'X-Shopify-Access-Token'=>'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'
        ])->get('https://kabar-abdullrahman-baff.myshopify.com/admin/api/2022-04/products.json');
        $products =json_decode($products);
        $result = [];
        foreach ($products->products as $product ){
            $res=[];
            foreach ($product as $p_K=>$p_v ){
               if (is_array($p_v)){

                   $in = [];
                   foreach ($p_v as $val){
                      foreach ($val as $n=>$k){

                          if (is_null($k)|| $k==null){

                          }
                          else{

                            $e= [];
                            $e[$n]=$k;

                              $in[$n] =$k;

                          }
                      }

                   }



                   array_push($res,$in);
               }
               else{
                   if ($p_v==''){

                   }else{
                       $arr =[];
                       $arr[$p_K]=$p_v;
                       $res[$p_K]=$p_v;
                   }
               }

            }
            array_push($result,$res);

        }
        return $result;
    }
}
