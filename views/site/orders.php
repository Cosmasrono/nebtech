<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("
    .table-responsive {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        background-color: #e6f2ff; /* Light blue background */
    }
    .table thead th {
        background-color: #cce0ff; /* Lighter blue for table headers */
        border-top: none;
        color: #004080; /* Dark blue text for headers */
    }
    .table-hover tbody tr:hover {
        background-color: #b3d1ff; /* Hover effect with a deeper light blue */
    }
    .table-hover tbody tr {
        background-color: #e6f2ff; /* Light blue row background */
    }
    .order-count {
        font-size: 1.2em;
        margin-bottom: 20px;
        color: #004080; /* Dark blue text for order count */
    }
    h1 {
        color: #004080; /* Dark blue for heading */
    }
    .alert-info {
        background-color: #cce0ff; /* Light blue for alert background */
        color: #004080; /* Dark blue text for alert */
    }
    .btn-approve {
        background-color: #28a745;
        color: white;
    }
    .btn-approve:hover {
        background-color: #218838;
        color: white;
    }
    .status-approved {
        color: #28a745;
        font-weight: bold;
    }
");

?>

<div class="container mt-4">
    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info" role="alert">
            No orders found.
        </div>
    <?php else: ?>
        <p class="order-count text-muted">Total orders: <?= count($orders) ?></p>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Company Name</th>
                        <th>Company Email</th>
                        <th>Services</th>
                        <th>Created At</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= Html::encode($order->id) ?></td>
                        <td><?= Html::encode($order->name) ?></td>
                        <td><?= Html::encode($order->phone_number) ?></td>
                        <td><?= Html::encode($order->company_name) ?></td>
                        <td><?= Html::encode($order->company_email) ?></td>
                        <td><?= Html::encode($order->services) ?></td>
                        <td><?= Yii::$app->formatter->asDatetime($order->created_at) ?></td>
                        <td>
                            <?php if ($order->status === 'approved'): ?>
                                <span class="status-approved">Approved</span>
                            <?php else: ?>
                                <?= Html::a('Approve', ['approve-order', 'id' => $order->id], [
                                    'class' => 'btn btn-sm btn-approve',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to approve this order?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
