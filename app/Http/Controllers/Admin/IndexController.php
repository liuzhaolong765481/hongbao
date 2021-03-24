<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;

class IndexController extends Controller
{

    public function home()
    {
        return $this->rView('home');
    }

    public function console()
    {
//
//        if($this->request->ajax()) {
//            $sql = "SELECT HOUR (create_time) as time ,SUM(pay_amount) as amount, count(*) as count FROM py_order WHERE (create_time)
//                    BETWEEN '".date('Y-m-d 00:00:00')."' AND '".date('Y-m-d H:i:s', time())."' and status = 2 GROUP BY HOUR (create_time)";
//            $res = \DB::select($sql);
//            $count =  $amount = $hours = [];
//
//            if(count($res)){
//                foreach ($res as $item){
//                    array_push($amount, $item->amount);
//                    array_push($hours, $item->time.':00');
//                    array_push($count, $item->count);
//                }
//            }
//
//            return $this->success(compact('amount','hours', 'count'));
//
//        }
//
//
//        $order =  Order::where('status', Order::STATUS_SUCCESS)->get();
//
//        //累计充值订单
//        $order_count = 0;
//
//        //累计充值金额
//        $total_amount = 0;
//
//        //今日充值金额
//        $day_amount = 0;
//
//        //昨日充值金额
//        $yesterday_amount = 0;
//
//        //累计抖音金额
//        $dou_amount = 0;
//
//        //累计快手金额
//        $kuai_amount = 0;
//
//        //累计繁星金额
//        $fan_amount = 0;
//
//        foreach ($order as $k => $item){
//            $order_count++;
//            $total_amount += $item->pay_amount;
//            if( (strtotime($item->create_time) > strtotime(date('Y-m-d 00:00:00'))) &&
//                (strtotime($item->create_time) < strtotime(date('Y-m-d 00:00:00')) + 86400 ) ){
//                $day_amount += $item->pay_amount;
//            }
//
//            if( (strtotime($item->create_time) > strtotime(date('Y-m-d 00:00:00')) - 86400) &&
//                (strtotime($item->create_time) < strtotime(date('Y-m-d 00:00:00')) ) ){
//                $yesterday_amount += $item->pay_amount;
//            }
//
//            if($item->type == 1){
//                $dou_amount += $item->pay_amount;
//            }
//
//            if($item->type == 2){
//                $kuai_amount += $item->pay_amount;
//            }
//
//            if($item->type == 3){
//                $fan_amount += $item->pay_amount;
//            }
//
//        }
//
//
//        //累计充值用户
//        $user_count = User::where('total_amount','>','0')->count();
//
//
//        return $this->rView('console', compact(
//            'day_amount', 'total_amount', 'user_count', 'order_count', 'yesterday_amount', 'dou_amount',
//            'kuai_amount', 'fan_amount'
//        ));
        return $this->rView('console');

    }


}