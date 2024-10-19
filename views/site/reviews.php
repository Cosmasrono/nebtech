<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Review */
/* @var $form ActiveForm */

$this->title = 'Submit a Review';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="review-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'client_name') ?>
        <?= $form->field($model, 'rating')->dropDownList([
            1 => '1 Star',
            2 => '2 Stars',
            3 => '3 Stars',
            4 => '4 Stars',
            5 => '5 Stars',
        ]) ?>
        <?= $form->field($model, 'review_text')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
