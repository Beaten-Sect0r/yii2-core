<?php

namespace frontend\modules\account\models;

use Yii;
use yii\base\Model;

/**
 * Password form.
 */
class PasswordForm extends Model
{
    public $password;
    public $password_confirm;

    private $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 32],

            ['password_confirm', 'required'],
            ['password_confirm', 'string', 'min' => 6, 'max' => 32],
            ['password_confirm', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::t('frontend', 'Password'),
            'password_confirm' => Yii::t('frontend', 'Confirm password'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if ($this->password) {
            $this->user->setPassword($this->password);
        }

        return $this->user->save();
    }
}
