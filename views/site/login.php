<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" style="max-width: 300px; margin: 50px auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
    <h1 style="color: #003366; text-align: center;"><?= Html::encode($this->title) ?></h1>

    <p style="color: #003366; text-align: center;">Please fill out the fields to login:</p>

    <?php $form = ActiveForm::begin(['id' => 'form-login']); ?>

        <?= $form->field($model, 'company_email')->textInput(['autofocus' => true, 'style' => 'border-color: #6699cc;']) ?>

        <?= $form->field($model, 'password')->passwordInput(['style' => 'border-color: #6699cc;']) ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['style' => 'color: #003366;']) ?>

        <div class="form-group" style="text-align: center;">
            <?= Html::submitButton('Login', ['class' => 'btn', 'style' => 'background-color: #6699cc; color: #ffffff;', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="mt-3" style="text-align: center;">
        <p style="color: #003366;">
            Don't have an account? <?= Html::a('Sign up here', ['site/signup'], ['style' => 'color: #003366;']) ?>
        </p>
        <p style="color: #003366;">
            <?= Html::a('Forgot password?', ['site/request-password-reset'], ['style' => 'color: #003366;']) ?>
        </p>
    </div>
</div>
