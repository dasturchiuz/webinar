<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SortList extends Model
{
    public $data;
    public $prefix='   ';


    protected function getPath($category_id, $prefix=false)
    {
        foreach($this->data as $item){
            if($category_id==$item['id']){
                $prefix=$prefix ? $this->prefix.$prefix : $item['name'];
                if($item['parent_id']){
                    return $this->getPath($item['parent_id'], $prefix);

                }else{
                    return $prefix;
                }
            }
        }
        return "";

    }

    public function getList($parent_id=0){
        $data = [];
        foreach($this->data as $item){
            if($parent_id==$item['parent_id']){
                $data[]=[
                    'id'=>$item['id'],
                    'name'=>$this->getPath($item['id'])
                ];
                $data=array_merge($data, $this->getList($item['id']));

            }
        }
        return $data;
    }

}
