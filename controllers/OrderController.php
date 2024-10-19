<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\OrderForm;

class OrderController extends Controller
{
    public function actionSubmit()
    {
        $model = new OrderForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Thank you for your order. We will contact you shortly.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error saving your order. Please try again.');
            }
            return $this->redirect(['site/index', '#' => 'order-services']);
        }

        // If we got this far, something went wrong
        Yii::$app->session->setFlash('error', 'There was an error processing your order. Please try again.');
        return $this->redirect(['site/index', '#' => 'order-services']);
    }
}
