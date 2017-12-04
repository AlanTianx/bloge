<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;

    public function tree(){
        $cate = $this->orderBy('cate_order')->get();
        return $this->get_tree($cate);
    }

    protected function get_tree($data){
        $arr = array();
        foreach($data as $k=>$v){
            if($v->cate_pid==0){
                $data[$k]['_cate_name'] = $data[$k]['cate_name'];
                $arr[]=$data[$k];
                foreach($data as $m => $n){
                    if($n->cate_pid == $v->cate_id){
                        $data[$m]['_cate_name'] = '   |--- '.$data[$m]['cate_name'];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
