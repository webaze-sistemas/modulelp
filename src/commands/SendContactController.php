<?php

namespace webaze\modulelp\commands;

use Exception;
use SendGrid\Mail\Mail;
use webaze\modulelp\models\Lead;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\web\View;

class SendContactController extends Controller
{
    public function actionIndex()
    {
        $key = ArrayHelper::getValue(\Yii::$app->params, 'sendgrid.apiKey');
        $receiverEmail = ArrayHelper::getValue(\Yii::$app->params, 'receiverEmail');
        $senderEmail = ArrayHelper::getValue(\Yii::$app->params, 'senderEmail');

        $leads = $this->getAllLeadToSend();
        foreach ($leads as $lead) {
            $html = $this->view()->render('@app/mail/contact', [
                'lead' => $lead
            ]);

            $email = new Mail();
            $email->setFrom($senderEmail);
            $email->setReplyTo($lead->email);
            $email->setSubject('Contato da Land Page');
            $email->addTo($receiverEmail);
            $email->addContent('text/html', $html);

            $send = new \SendGrid($key);
            try {
                $response = $send->send($email);
                if (in_array($response->statusCode(), [200, 201, 202])) {
                    $lead->requiredReCaptcha = false;
                    $lead->send = 1;
                    $lead->save();
                }

            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }
        }
    }

    protected function view(): View
    {
        return new View();
    }

    /**
     * @return Lead[]
     */
    protected function getAllLeadToSend()
    {
        return Lead::find()->where(['send' => 0])->all();
    }
}