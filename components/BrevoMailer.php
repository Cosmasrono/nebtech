<?php

namespace app\components;

use Yii;
use yii\base\Component;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use GuzzleHttp\Client;

class BrevoMailer extends Component
{
    public $apiKey;

    public function sendVerificationEmail($email, $name, $verifyLink)
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->apiKey);
        $apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'to' => [['email' => $email, 'name' => $name]],
            'subject' => 'Verify your email',
            'htmlContent' => $this->renderEmailTemplate($name, $verifyLink),
            'sender' => ['name' => 'iansoft', 'email' => 'francismwaniki630@gmail.com']
        ]);

        Yii::info("Attempting to send email to $email", __METHOD__);

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            Yii::info("Email sent successfully to $email", __METHOD__);
            return true;
        } catch (\Exception $e) {
            Yii::error("Exception occurred while sending email: " . $e->getMessage(), __METHOD__);
            return false;
        }
    }

    private function renderEmailTemplate($name, $verifyLink)
    {
        // Your HTML email template here
        return "
            <html>
            <body>
                <h1>Hello $name,</h1>
                <p>Please click the link below to verify your email:</p>
                <a href='$verifyLink'>Verify Email</a>
            </body>
            </html>
        ";
    }
}
