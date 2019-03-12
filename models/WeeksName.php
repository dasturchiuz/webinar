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
class WeeksName extends Model
{
    const MONDAY=1;
    const TUESDAY=2;
    const WEDNESDAY=3;
    const THURSDAY=4;
    const FRIDAY=5;
    const SATURDAY=6;
    const SUNDAY=7;

    public static function weeks(){
        return [
          self::MONDAY => "Понедельник",
          self::TUESDAY => "Вторник",
          self::WEDNESDAY => "Среда",
          self::THURSDAY => "Четверг",
          self::FRIDAY => "Пятница",
          self::SATURDAY => "Суббота",
          self::SUNDAY => "Воскресенье",
        ];
    }
}
