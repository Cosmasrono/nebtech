<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Welcome to ' . Yii::$app->name;

?>

<!-- Hero Section with Auto Carousel -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Carousel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
      body {
          margin: 0;
          padding: 0;
      }

      .carousel-item img {
          width: 100%;
          height: 100vh;
          object-fit: cover;
      }

      .carousel-caption {
          background: rgba(0, 0, 0, 0.6);
          color: #fff;
          padding: 20px;
          border-radius: 8px;
          max-width: 50%;
          margin: auto;
      }

      .carousel-caption h1 {
          font-size: 3vw;
          font-weight: bold;
      }

      .carousel-caption p {
          font-size: 1.2vw;
      }

      .btn-light {
          background-color: #007bff;
          border: none;
          color: #fff;
          font-weight: bold;
          padding: 10px 20px;
          transition: background-color 0.3s ease;
      }

      .btn-light:hover {
          background-color: #0056b3;
      }

      .carousel-control-prev, .carousel-control-next {
          top: 50%;
          transform: translateY(-50%);
      }

      .section {
          padding: 60px 0;
      }

      .section-title {
          margin-bottom: 40px;
          font-size: 2.5rem;
      }

      .card {
          border: none;
          transition: transform 0.3s;
      }

      .card:hover {
          transform: scale(1.05);
      }

      #about .section-title {
    margin-bottom: 2rem;
}

#about h3 {
    color: #333;
    margin-bottom: 1rem;
}

#about h4 {
    color: #0056b3;
    margin-bottom: 0.5rem;
}

#about .fas {
    margin-right: 0.5rem;
    color: #0056b3;
}

#about ul {
    padding-left: 1.5rem;
}

#about ul li {
    margin-bottom: 0.5rem;
}

/* New styles for transitions */
.tech-box {
    padding: 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.tech-box:hover {
    background-color: #f8f9fa;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-5px);
}

.fade-in {
    opacity: 0;
    transform: translateX(-50px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-in.visible {
    opacity: 1;
    transform: translateX(0);
}

/* Add alternating directions for even and odd elements */
.fade-in:nth-child(even) {
    transform: translateX(50px);
}

.fade-in:nth-child(even).visible {
    transform: translateX(0);
}

/* .service-box {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: all 0.3s ease;
    height: 100%;
} */

.service-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.service-box img {
    border-radius: 8px;
    margin-bottom: 15px;
}

.service-box h4 {
    color: #0056b3;
    margin-bottom: 10px;
}

.service-box p {
    color: #666;
}

.service-box .fas {
    margin-right: 10px;
    color: #0056b3;
}

#about {
    padding: 60px 0;
    background-color: #f8f9fa;
}

#about .section-title {
    margin-bottom: 40px;
    color: #333;
}

.about-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 30px;
    height: 100%;
    transition: all 0.3s ease;
}

.about-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.about-card h3 {
    color: #0056b3;
    margin-bottom: 20px;
    font-size: 24px;
}

.about-card p {
    color: #666;
    font-size: 16px;
    line-height: 1.6;
}

/* Existing fade-in styles */
.fade-in {
    opacity: 0;
    transform: translateX(-50px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-in.visible {
    opacity: 1;
    transform: translateX(0);
}

.fade-in:nth-child(even) {
    transform: translateX(50px);
}

.fade-in:nth-child(even).visible {
    transform: translateX(0);
}

/* Add this to your existing CSS */

.about-card ul.why-choose-list {
    padding-left: 20px;
    margin-bottom: 0;
}

.about-card ul.why-choose-list li {
    color: #666;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 10px;
}

.about-card ul.why-choose-list li:last-child {
    margin-bottom: 0;
}

/* You can add a custom bullet style if desired */
.about-card ul.why-choose-list li::marker {
    color: #0056b3;
}

.row {
    display: flex;
    flex-wrap: wrap;
}

.col-md-6 {
    display: flex;
    margin-bottom: 30px;
}

.about-card {
    display: flex;
    flex-direction: column;
    width: 100%;
}

/* Add this to the top of your existing styles */
body {
    padding-top: 60px; /* Adjust this value as needed */
}

.cylinder-container {
    perspective: 1000px;
    width: 100%;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 50px 0;
    padding-top: 60px; /* Add this line */
}
    </style>
</head>
<body>

<!-- Replace the existing carousel with this new structure -->
<div id="imageCylinder" class="cylinder-container">
    <div class="cylinder">
        <div class="cylinder-item" style="--i:1;">
            <img src="https://www.fgee.co.ke/wp-content/uploads/2024/08/Untitled-design-23.png" alt="Web Development">
            <div class="service-name">App Development</div>
        </div>
        <div class="cylinder-item" style="--i:2;">
            <img src="https://cdn.pixabay.com/photo/2020/10/21/18/07/laptop-5673901_1280.jpg" alt="Mobile App Development">
            <div class="service-name">Web Development</div>
        </div>
        <div class="cylinder-item" style="--i:3;">
            <img src="https://cdn.corporatefinanceinstitute.com/assets/cloud-services-1024x401.jpeg" alt="Cloud Services">
            <div class="service-name">Cloud Services</div>
        </div>
        <div class="cylinder-item" style="--i:4;">
            <img src="https://www.simplilearn.com/ice9/free_resources_article_thumb/What_is_the_Importance_of_Technology.jpg" alt="AI & Machine Learning">
            <div class="service-name">AI & Machine Learning</div>
        </div>
        <div class="cylinder-item" style="--i:5;">
            <img src="https://www.northeastern.edu/graduate/blog/wp-content/uploads/2019/09/iStock-1150384596-2.jpg" alt="Cybersecurity">
            <div class="service-name">Cybersecurity</div>
        </div>
    </div>
</div>

<style>
    .cylinder-container {
        perspective: 1000px;
        width: 100%;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 50px 0;
        padding-top: 60px; /* Add this line */
    }

    .cylinder {
        position: relative;
        width: 200px;
        height: 200px;
        transform-style: preserve-3d;
        animation: rotate 20s linear infinite;
    }

    .cylinder-item {
        position: absolute;
        width: 100%;
        height: 100%;
        transform-origin: center;
        transform: rotateY(calc(var(--i) * 72deg)) translateZ(250px);
    }

    .cylinder-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .service-name {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px;
        text-align: center;
        font-size: 14px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    @keyframes rotate {
        0% {
            transform: rotateY(0);
        }
        100% {
            transform: rotateY(360deg);
        }
    }
</style>

<!-- Remove or comment out the existing carousel JavaScript -->

<!-- About Us Section -->
<div id="about" class="section">
    <div class="container">
        <h2 class="section-title text-center fade-in">About Nebtech Innovations</h2>
        <div class="row mb-4">
            <div class="col-md-6 fade-in">
                <div class="about-card">
                    <h3>Our Mission</h3>
                    <p>At Nebtech Innovations, we're on a mission to revolutionize businesses through cutting-edge technology. We strive to provide leading IT solutions that drive your business forward, transforming ideas into powerful, scalable realities.</p>
                </div>
            </div>
            <div class="col-md-6 fade-in">
                <div class="about-card">
                    <h3>Our Expertise</h3>
                    <p>With a focus on innovation and excellence, we offer a comprehensive range of services designed to meet the unique needs of each client. Our expertise spans across various domains of technology, ensuring we can tackle any challenge.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Our Services Section -->
<div id="services" class="section">
    <div class="container">
        <h2 class="section-title text-center fade-in">Our Services</h2>
        
        <div class="row mb-4">
            <div class="col-md-4 fade-in">
                <div class="service-box">
                    <img src="https://geeks4learning.com/wp-content/uploads/2021/04/software-dev-australia.jpg" alt="Software Development" class="img-fluid mb-3">
                    <h4><i class="fas fa-code"></i> Software Development</h4>
                    <p>Custom software solutions, web applications, mobile apps, and enterprise systems tailored to your specific needs.</p>
                </div>
            </div>
            <div class="col-md-4 fade-in">
                <div class="service-box">
                    <img src="https://cdn.ahzassociates.co.uk/wp-content/uploads/2021/07/23155029/cloud-computing-msc.jpg" alt="Cloud Services" class="img-fluid mb-3">
                    <h4><i class="fas fa-cloud"></i> Cloud Services</h4>
                    <p>Cloud migration, management, and optimization across major platforms like AWS, Azure, and Google Cloud.</p>
                </div>
            </div>
            <div class="col-md-4 fade-in">
                <div class="service-box">
                    <img src="https://www.kaspersky.com/content/en-global/images/repository/isc/2017-images/What-is-Cyber-Security.jpg" alt="Cybersecurity" class="img-fluid mb-3">
                    <h4><i class="fas fa-shield-alt"></i> Cybersecurity</h4>
                    <p>Robust security solutions to protect your digital assets, including threat detection, prevention, and incident response.</p>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-4 fade-in">
                <div class="service-box">
                    <img src="https://miro.medium.com/v2/resize:fit:1400/1*cG6U1qstYDijh9bPL42e-Q.jpeg" alt="AI & Machine Learning" class="img-fluid mb-3">
                    <h4><i class="fas fa-robot"></i> AI & Machine Learning</h4>
                    <p>Leveraging AI and ML to create intelligent systems, predictive analytics, and data-driven insights.</p>
                </div>
            </div>
            <div class="col-md-4 fade-in">
                <div class="service-box">
                    <img src="https://lirp.cdn-website.com/f499246c/dms3rep/multi/opt/20+Things+to+Consider+When+Planning+an+IoT+Solution+-+Part+1-1920w.jpeg" alt="IoT Solutions" class="img-fluid mb-3">
                    <h4><i class="fas fa-network-wired"></i> IoT Solutions</h4>
                    <p>Connecting devices and systems to create smart, efficient environments for homes and businesses.</p>
                </div>
            </div>
            <div class="col-md-4 fade-in">
                <div class="service-box">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxQQZZkNCR32GGSI3CFoebGxYzjCXf_NMTZQ&s" alt="Big Data & Analytics" class="img-fluid mb-3">
                    <h4><i class="fas fa-database"></i> Big Data & Analytics</h4>
                    <p>Harnessing the power of data with advanced analytics, visualization, and business intelligence tools.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6 fade-in">
        <div class="about-card">
            <h3>Our Approach</h3>
            <p>We believe in a collaborative approach, working closely with our clients to understand their unique challenges and goals. Our agile methodology ensures rapid development and continuous improvement, delivering solutions that evolve with your business needs.</p>
        </div>
    </div>
    <div class="col-md-6 fade-in">
        <div class="about-card">
            <h3>Why Choose Us</h3>
            <ul class="why-choose-list">
                <li>Cutting-edge technology expertise</li>
                <li>Tailored solutions for your specific needs</li>
                <li>Scalable and future-proof implementations</li>
                <li>Dedicated support and maintenance</li>
                <li>Commitment to innovation and excellence</li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact Us Section -->
<div id="contact" class="section">
    <div class="container">
        <h2 class="section-title text-center">Contact Us</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="floating-card">
                    <?php $form = ActiveForm::begin([
                        'id' => 'contact-form',
                        'action' => ['site/submit-order'], // Custom action for form submission
                    ]); ?>

                    <?= $form->field($orderForm, 'name')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($orderForm, 'company_name') ?>
                    <?= $form->field($orderForm, 'company_email') ?>
                    <?= $form->field($orderForm, 'phone_number') ?>
                    <?= $form->field($orderForm, 'services')->checkboxList($orderForm->getServicesList()) ?>
                    <?= $form->field($orderForm, 'message')->textarea(['rows' => 6]) ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Submit Request', ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #contact {
        background-color: #f8f9fa;
        padding: 60px 0;
    }

    .floating-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        transition: all 0.3s ease;
    }

    .floating-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .section-title {
        margin-bottom: 40px;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #ffffff;
        padding: 12px 30px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fadeElements = document.querySelectorAll('.fade-in');
    
    function checkFade() {
        fadeElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            
            if (elementTop < window.innerHeight - 100 && elementBottom > 0) {
                element.classList.add('visible');
            }
        });
    }
    
    window.addEventListener('scroll', checkFade);
    window.addEventListener('resize', checkFade);
    
    // Initial check
    setTimeout(checkFade, 100); // Small delay to ensure proper initial state
});
</script>




















