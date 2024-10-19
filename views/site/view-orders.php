<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $orders app\models\Order[] */

$this->title = 'All Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-view-orders">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Services Requested</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $index => $order): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= Html::encode($order->name) ?></td>
                    <td><?= Html::encode($order->company_name) ?></td>
                    <td><?= Html::encode($order->company_email) ?></td>
                    <td><?= Html::encode($order->phone_number) ?></td>
                    <td><?= Html::encode(implode(', ', $order->services)) ?></td>
                    <td><?= Html::encode($order->message) ?></td>
                    <td><?= Html::encode($order->created_at) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
