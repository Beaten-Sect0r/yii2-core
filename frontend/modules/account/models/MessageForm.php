<?php

namespace frontend\modules\account\models;

use Yii;
use yii\base\Model;

/**
 * MessageForm is the model behind the contact form.
 */
class MessageForm extends Model
{
    public $subject;
    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // subject and body are required
            [['subject', 'body'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject' => Yii::t('frontend', 'Subject'),
            'body' => Yii::t('frontend', 'Text'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->user->identity->email => Yii::$app->user->identity->username])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
