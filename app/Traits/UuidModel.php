<?php
    /**
     * Created by PhpStorm.
     * User: berdj
     * Date: 2018-11-27
     * Time: 4:39 PM
     */
    
    namespace App\Traits;
    
    use Illuminate\Support\Str;
    
    trait UuidModel
    {
        public static function bootUuidModel ()
        {
            self::creating(function ($model) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            });
        }
    }
