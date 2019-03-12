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
class Images extends Model
{
    public $img_sort;
    public $img_path;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['img_sort', 'img_path'], 'required'],
            [['img_sort', 'img_path'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'img_path' => Yii::t('app', 'Картинка тавар'),
            'img_sort' => Yii::t('app', 'Сорт номер'),
        ];
    }


}
