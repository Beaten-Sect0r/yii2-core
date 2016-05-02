<?php

namespace frontend\modules\account\models;

use Yii;
use yii\base\InvalidParamException;
use yii\base\Model;
use common\models\User;

/**
 * Password reset form.
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $password_confirm;

    /**
     * @var \common\models\User
     */
    private $user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array  $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException(Yii::t('frontend', 'Password reset token cannot be blank.'));
        }
        $this->user = User::findOne([
            'access_token' => $token,
            'status' => User::STATUS_ACTIVE,
        ]);
        if (!$this->user) {
            throw new InvalidParamException(Yii::t('frontend', 'Wrong password reset token.'));
        }
        parent::__construct($config);
    }

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
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->user;
        $user->setPassword($this->password);
        $user->removeAccessToken();

        return $user->save(false);
    }
}
