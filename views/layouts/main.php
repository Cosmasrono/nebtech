<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\OrderForm;
use app\models\Review;  // Add this line
 
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --background-color: #f8f9fa;
            --text-color: #333;
        }
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }
        .navbar {
            transition: all 0.4s;
            padding: 1rem 0;
            background-color: #87CEFA; /* Light Sky Blue */
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .navbar-scrolled {
            background-color: #fff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }
        .navbar-scrolled .nav-link {
            color: var(--secondary-color) !important;
        }
        .navbar-brand, .navbar .nav-link {
            color: #333333 !important; /* Dark gray text color for better contrast */
        }
        .navbar .nav-link:hover {
            color: #0056b3 !important; /* Darker blue on hover */
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(51, 51, 51, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        /* .hero-section {
            background-color: var(--primary-color);
            color: #fff;
            padding: 150px 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        } */
        .section {
            padding: 100px 0;
        }
        .section-title {
            margin-bottom: 50px;
            font-weight: 600;
            color: var(--secondary-color);
        }
        .card {
            transition: all 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            color: var(--primary-color);
            font-weight: 600;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        /* Navbar styling */
        .navbar .btn-link {
            color: #333333;
        }
        .navbar .btn-link:hover {
            color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div class="wrap">
    <header>
        <?php
        NavBar::begin([
            'brandImage' => Yii::$app->homeUrl . '../../web/images/NT.png',
            // 'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => '#about', 'linkOptions' => ['class' => 'scroll-link']],
                ['label' => 'Services', 'url' => '#services', 'linkOptions' => ['class' => 'scroll-link']],
                ['label' => 'Contact', 'url' => '#contact', 'linkOptions' => ['class' => 'scroll-link']],
                ['label' => 'Orders', 'url' => ['/site/orders']],
                // ['label' => 'Reviews', 'url' => ['/site/reviews']],
               
                Yii::$app->user->isGuest ? (
                    ['label' => '', 'url' => ['/site/login']]
                ) : (
                    '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->company_name . ')',
                        ['class' => 'btn btn-link logout nav-link']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>
    </header>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-md-end">
                <p class="footer-text">@Nebtech</p>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #f8f9fa; /* Light background */
        padding: 10px 0;
        z-index: 1000; /* Ensure it's above other content */
    }

    .footer-text {
        color: #007bff; /* Blue text color */
        font-weight: bold;
        margin: 0;
    }

    /* Add some padding to the body to prevent content from being hidden behind the footer */
    body {
        padding-bottom: 50px; /* Adjust this value based on your footer's height */
    }
</style>

<?php $this->endBody() ?>

<?php
$trackUrl = Url::to(['site/track']);
$js = <<<JS
function setTrackReturnUrl(event) {
    event.preventDefault();
    var loginUrl = $(event.target).attr('href');
    window.location.href = loginUrl + '?returnUrl=' + encodeURIComponent('$trackUrl');
    return false;
}
JS;
$this->registerJs($js);
?>
<script>

$(document).ready(function() {
    $('.scroll-link').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(target).offset().top
        }, 1000);
    });
});
</script>
</body>
</html>
<?php $this->endPage() ?>
