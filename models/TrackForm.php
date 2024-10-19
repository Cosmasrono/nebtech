<?php

namespace app\models;

use yii\base\Model;

class TrackForm extends Model
{
    public $company_name;

    public function rules()
    {
        return [
            ['company_name', 'required'],
            ['company_name', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'company_name' => 'Company Name',
        ];
    }
}
