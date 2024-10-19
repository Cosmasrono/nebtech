<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class OrderForm extends ActiveRecord
{
    public $order_number;
    public $status;
    public static function tableName()
    {
        return 'orders'; // Changed from 'order' to 'orders'
    }

    public function rules()
    {
        return [
            [['name', 'company_name', 'company_email', 'phone_number', 'services'], 'required'],
            ['company_email', 'email'],
            [['message'], 'safe'],
            ['services', 'safe'],
            ['status', 'string'],
            ['status', 'default', 'value' => 'pending'],
            ['order_number', 'string'],
            ['order_number', 'unique'],
        ];
    }

    public function getServicesList()
    {
        return [
            'IT Consulting' => 'IT Consulting',
            'Software Development' => 'Software Development',
            'Cloud Services' => 'Cloud Services',
            'Cybersecurity' => 'Cybersecurity',
            'Data Analytics' => 'Data Analytics',
            'IoT Solutions' => 'IoT Solutions',
        ];
    }
    public static function getOrders()
    {
        // This will fetch all orders without any conditions
        return self::find()->all();
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Convert services array to a comma-separated string
            if (is_array($this->services)) {
                $this->services = implode(', ', $this->services);
            }

            // Generate order number if it's a new record
            if ($this->isNewRecord) {
                $this->order_number = $this->generateOrderNumber();
            }

            return true;
        }
        return false;
    }

    private function generateOrderNumber()
    {
        $prefix = 'ORD-';
        $uniqueId = uniqid();
        return $prefix . $uniqueId;
    }
}
