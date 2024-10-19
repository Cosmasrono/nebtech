<?php
 

namespace app\controllers;
use yii;
use yii\filters\AccessControl;
use yii\web\Controller; // Import the base Controller from yii\web
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\OrderForm;
use app\models\Review;
use app\models\SignupForm;
use app\models\User; // Add this line
use app\components\BrevoMailer; // Adjust according to the new namespace
use app\models\Order; // Add this line
use app\models\TrackForm; // Add this line
use SendGrid\Mail\Mail; // Adjust according to the actual library you are using
 

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $orderForm = new OrderForm();

        if (Yii::$app->request->isPost && $orderForm->load(Yii::$app->request->post())) {
            if ($orderForm->save()) {
                Yii::$app->session->setFlash('success', 'Thank you for your order. We will contact you shortly.');
                return $this->refresh();
            }
        }

        return $this->render('index', [
            'orderForm' => $orderForm,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */

    //  reviews
    public function actionReviews()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Thank you for your review!');
            return $this->refresh();
        }

        return $this->render('reviews', [
            'model' => $model,
        ]);
    }
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // Check if there's pending order data
            $pendingOrderData = Yii::$app->session->get('pendingOrderData');
            if ($pendingOrderData) {
                // Clear the session data
                Yii::$app->session->remove('pendingOrderData');
                
                // Process the pending order
                $orderModel = new OrderForm();
                if ($orderModel->load($pendingOrderData) && $orderModel->save()) {
                    Yii::$app->session->setFlash('success', 'Thank you for your order. We will contact you shortly.');
                } else {
                    Yii::$app->session->setFlash('error', 'There was an error submitting your order. Please try again.');
                }
            }
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionGetOrderCount()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return OrderForm::getOrderCount();
    }

    public function actionReviewForm()
    {
        $model = new Review();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Thank you for your review!');
            return $this->redirect(['index', '#' => 'reviews']);
        }

        return $this->render('review-form', [
            'model' => $model,
        ]);
    }

    public function actionViewOrders()
    {
        $orders = Order::find()->all(); // Fetch all orders from the database

        return $this->render('view-orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Signup action.
     *
     * @return Response|string
     */
    // public function actionSignup()
    // {
    //     $model = new SignupForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->signup()) {
    //         $user = User::findOne(['company_email' => $model->company_email]);
    //         if ($user) {
    //             if ($this->sendVerificationEmail($user)) {
    //                 Yii::$app->session->setFlash('success', 'Please check your email to verify your account.');
    //                 return $this->goHome();
    //             } else {
    //                 Yii::error('Failed to send verification email for user: ' . $user->company_email, __METHOD__);
    //                 Yii::$app->session->setFlash('error', 'Sorry, we are unable to send verification email for the registered email address.');
    //             }
    //         } else {
    //             Yii::error('User not found after signup: ' . $model->company_email, __METHOD__);
    //             Yii::$app->session->setFlash('error', 'An error occurred during signup.');
    //         }
    //     }
    
    //     return $this->render('signup', [
    //         'model' => $model,
    //     ]);
    
    //     return $this->render('signup', [
    //         'model' => $model,
    //     ]);
    // }
    // protected function sendVerificationEmail($user)
    // {
    //     Yii::info("Preparing to send verification email for user: {$user->company_email}", __METHOD__);
    
    //     $verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
    //     Yii::info("Generated verification link: $verifyLink", __METHOD__);
    
    //     /** @var \app\components\BrevoMailer $brevoMailer */
    //     $brevoMailer = Yii::$app->get('brevoMailer');
    //     $result = $brevoMailer->sendVerificationEmail($user->company_email, $user->company_name, $verifyLink);
    
    //     if (!$result) {
    //         Yii::error("Failed to send verification email to {$user->company_email}", __METHOD__);
    //     } else {
    //         Yii::info("Verification email sent successfully to {$user->company_email}", __METHOD__);
    //     }
    
    //     return $result;
    // }
    public function actionSignup()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->setPassword($model->password);
                $model->generateAuthKey();
                $model->generateEmailVerificationToken();
                if ($model->save()) {
                    // User saved successfully, now try to send verification email
                    if ($this->sendVerificationEmail($model)) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Thank you for registering. Please check your email to verify your account.');
                        return $this->redirect(['site/login']);
                    } else {
                        throw new \Exception('Failed to send verification email.');
                    }
                } else {
                    throw new \Exception('Failed to save user.');
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error('Signup failed: ' . $e->getMessage());
                Yii::error('User model errors: ' . print_r($model->errors, true));
                Yii::$app->session->setFlash('error', 'There was an error during registration: ' . $e->getMessage());
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    private function sendVerificationEmail($user)
    {
        try {
            $verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
            
            Yii::info("Attempting to send verification email to: {$user->company_email}", __METHOD__);
            Yii::info("Verification link: $verifyLink", __METHOD__);

            $brevoMailer = Yii::$app->brevoMailer;
            $result = $brevoMailer->sendVerificationEmail(
                $user->company_email,
                $user->company_name,
                $verifyLink
            );

            if (!$result) {
                Yii::error("Failed to send email via Brevo API.", __METHOD__);
                throw new \Exception('Brevo API failed to send email.');
            }

            Yii::info("Verification email sent successfully to {$user->company_email}", __METHOD__);
            return true;
        } catch (\Exception $e) {
            Yii::error('Error sending verification email: ' . $e->getMessage(), __METHOD__);
            Yii::error('Stack trace: ' . $e->getTraceAsString(), __METHOD__);
            return false;
        }
    }

    public function actionVerifyEmail($token)
    {
        $user = User::findOne(['verification_token' => $token]);

        if ($user !== null) {
            $user->status = User::STATUS_ACTIVE;
            $user->verification_token = null;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Your email has been verified. You can now log in.');
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        }

        return $this->redirect(['site/login']);
    }
    
    // public function actionVerify()
    // {
    //     $token = Yii::$app->request->get('token');
    //     $user = User::findOne(['verification_token' => $token]);

    //     if ($user) {
    //         $user->is_verified = 1; // Set user as verified
    //         $user->verification_token = null; // Clear the token
    //         $user->save();
    //         Yii::$app->session->setFlash('success', 'Your email has been verified successfully!');
    //     } else {
    //         Yii::$app->session->setFlash('error', 'Invalid verification link.');
    //     }

    //     return $this->redirect(['site/login']); // Redirect to login or another page
    // }

public function actionOrders()
{
    if (Yii::$app->user->isGuest) {
        Yii::$app->user->setReturnUrl(Yii::$app->request->url);
        Yii::$app->session->setFlash('info', 'Please sign in to view orders.');
        return $this->redirect(['site/login']);
    }

    $orders = OrderForm::getOrders();

    return $this->render('orders', [
        'orders' => $orders,
    ]);
}

public function actionRequestPasswordReset()
{
    $model = new PasswordResetRequestForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($model->sendEmail()) {
            Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
            return $this->goHome();
        } else {
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }
    }

    return $this->render('requestPasswordResetToken', [
        'model' => $model,
    ]);
}

public function actionResetPassword($token)
{
    try {
        $model = new ResetPasswordForm($token);
    } catch (InvalidArgumentException $e) {
        throw new BadRequestHttpException($e->getMessage());
    }

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
        Yii::$app->session->setFlash('success', 'New password saved.');
        return $this->goHome();
    }

    return $this->render('resetPassword', [
        'model' => $model,
    ]);
}

public function actionApproveOrder($id)
{
    $order = OrderForm::findOne($id);
    if ($order) {
        $order->status = 'approved';
        if ($order->save()) {
            Yii::$app->session->setFlash('success', 'Order approved successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to approve order.');
        }
    } else {
        Yii::$app->session->setFlash('error', 'Order not found.');
    }
    return $this->redirect(['orders']);
}

public function actionSubmitOrder()
{
    // Check if the user is logged in
    if (Yii::$app->user->isGuest) {
        // If not logged in, store the form data in session and redirect to login
        Yii::$app->session->set('pendingOrderData', Yii::$app->request->post());
        return $this->redirect(['site/login']);
    }

    // If logged in, process the form submission
    $model = new OrderForm();
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Thank you for your order. We will contact you shortly.');
        return $this->redirect(['site/index']);
    }

    // If there's an error in form submission, redirect back to the form
    Yii::$app->session->setFlash('error', 'There was an error submitting your order. Please try again.');
    return $this->redirect(['site/index']);
}

public function actionTrack()
{
    $model = new \app\models\TrackForm();
    $orders = [];

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $orders = OrderForm::find()
            ->select(['name', 'company_name', 'status'])
            ->where(['company_name' => $model->company_name])
            ->all();
    }

    return $this->render('track', [
        'model' => $model,
        'orders' => $orders,
    ]);
}

private function getMockOrderStatus($orderNumber)
{
    // This is a mock function. In a real application, you would query your database or API.
    $statuses = ['Processing', 'Shipped', 'Delivered'];
    return [
        'status' => $statuses[array_rand($statuses)],
        'last_update' => date('Y-m-d H:i:s'),
    ];
}

protected function sendAdminNotification($user)
{
    try {
        $adminEmail = 'your-admin-email@example.com';
        $subject = 'New User Registration Notification';
        $message = "A new user has registered: {$user->company_email}";

        $result = Yii::$app->mailer->compose()
            ->setTo($adminEmail)
            ->setSubject($subject)
            ->setTextBody($message)
            ->send();

        if ($result) {
            Yii::info("Notification email sent successfully to admin: {$adminEmail}");
        } else {
            Yii::error("Failed to send notification email to admin: {$adminEmail}");
        }
    } catch (\Exception $e) {
        Yii::error("Exception when sending notification email to admin: " . $e->getMessage());
    }
}
}




















