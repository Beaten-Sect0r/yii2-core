<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use vova07\fileapi\behaviors\UploadBehavior;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property integer $birthday
 * @property string $avatar_path
 * @property integer $gender
 * @property string $website
 * @property string $other
 */
class UserProfile extends ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::class,
                'attributes' => [
                    'avatar_path' => [
                        'path' => '@storage/avatars',
                        'tempPath' => '@storage/tmp',
                        'url' => Yii::getAlias('@storageUrl/avatars'),
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['birthday', 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            ['gender', 'in', 'range' => [null, self::GENDER_MALE, self::GENDER_FEMALE]],
            ['website', 'trim'],
            ['website', 'url', 'defaultScheme' => 'http', 'validSchemes' => ['http', 'https']],
            ['other', 'string', 'max' => 1024],
            [['firstname', 'lastname', 'avatar_path', 'website'], 'string', 'max' => 255],
            ['firstname', 'match', 'pattern' => '/^[a-zа-яё]+$/iu'],
            ['lastname', 'match', 'pattern' => '/^[a-zа-яё]+(-[a-zа-яё]+)?$/iu'],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['firstname', 'lastname', 'birthday', 'gender', 'website', 'other'], 'default', 'value' => null],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firstname' => Yii::t('common', 'Firstname'),
            'lastname' => Yii::t('common', 'Lastname'),
            'birthday' => Yii::t('common', 'Birthday'),
            'avatar_path' => Yii::t('common', 'Avatar'),
            'gender' => Yii::t('common', 'Gender'),
            'website' => Yii::t('common', 'Website'),
            'other' => Yii::t('common', 'Other'),
        ];
    }
}
