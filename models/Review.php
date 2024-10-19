<?php

namespace app\models;

use yii\db\ActiveRecord;

class Review extends ActiveRecord
{
    public static function tableName()
    {
        return 'reviews';
    }

    public function rules()
    {
        return [
            [['client_name', 'review_text'], 'required'],
            [['client_name'], 'string', 'max' => 255],
            [['review_text'], 'string'],
            [['rating'], 'integer', 'min' => 1, 'max' => 5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'client_name' => 'Client Name',
            'review_text' => 'Review',
            'rating' => 'Rating',
        ];
    }

    public static function getReviewCount()
    {
        return static::find()->count();
    }
}
