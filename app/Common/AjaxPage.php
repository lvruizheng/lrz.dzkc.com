<?php
namespace App\Common;

class AjaxPage
{
    
    /*
     * $model
     * $where
     */
    public static function ajaxPage($model,$where,$page){
        //总条数
        $count = $model::where($where)->count();
        
        //设置显示条数
        $rev = 2;
        
        //3、求总页数
        $sums = ceil($count/$rev);
        
        //5、设置上一页、下一页
        $prev = ($page-1)>0?$page-1:1;
        $next = ($page+1)<$sums?$page+1:$sums;
        
        //6、求偏移量
        $offset = ($page-1)*$rev;
        
        //7、sql查询数据库
        $data = $model::where($where)->offset($offset)->limit($rev)->get();
        
        //8、数字分页(可有可无)
        $pp = array();
        for($i=1;$i<=$sums;$i++){
            $pp[$i]=$i;
        }
        
        /*
        $obj = new class{};
        $obj->count = $count;
        $obj->sums = $sums;
        $obj->page = $page;
        $obj->prev = $prev;
        $obj->next = $next;
        $obj->data = $data;
        $obj->pp = $pp;
        */
        
        return array(
            'count'=>$count,
            'sums'=>$sums,
            'page'=>$page,
            'prev'=>$prev,
            'next'=>$next,
            'data'=>$data->toArray(),
            'pp'=>$pp,
        );
    }
}
