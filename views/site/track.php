<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Track Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-track">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'company_name') ?>
        <div class="form-group">
            <?= Html::submitButton('Track Orders', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <?php if (!empty($orders)): ?>
        <h2>Orders for <?= Html::encode($model->company_name) ?></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= Html::encode($order->name) ?></td>
                        <td><?= Html::encode(ucfirst($order->status)) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($model->company_name): ?>
        <p>No orders found for this company.</p>
    <?php endif; ?>
</div>
