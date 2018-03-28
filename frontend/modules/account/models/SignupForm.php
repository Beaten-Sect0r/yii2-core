<?php

namespace frontend\modules\account\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form.
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::class],
            ['username', 'string', 'min' => 2, 'max' => 32],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],
            ['email', 'string', 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 32],

            ['password_confirm', 'required'],
            ['password_confirm', 'string', 'min' => 6, 'max' => 32],
            ['password_confirm', 'compare', 'compareAttribute' => 'password'],

            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend', 'Username'),
            'email' => Yii::t('frontend', 'Email'),
            'password' => Yii::t('frontend', 'Password'),
            'password_confirm' => Yii::t('frontend', 'Confirm password'),
            'verifyCode' => Yii::t('frontend', 'Verification code'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = Yii::$app->keyStorage->get('frontend.email-confirm') ? User::STATUS_INACTIVE : User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            $user->afterSignup();

            return $user;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_INACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            $user->generateAccessToken();
        } else {
            return false;
        }

        if (!$user->save()) {
            return false;
        }

        return Yii::$app->mailer->compose('activation', ['user' => $user])
            ->setFrom([Yii::$app->params['robotEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject(Yii::t('frontend', 'Activation for {name}', ['name' => Yii::$app->name]))
            ->send();
    }
}
