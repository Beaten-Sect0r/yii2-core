<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property string $id
 * @property integer $level
 * @property string $category
 * @property float $log_time
 * @property string $prefix
 * @property string $message
 */
class Log extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['level', 'integer'],
            ['log_time', 'number'],
            [['prefix', 'message'], 'string'],
            ['category', 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'level' => Yii::t('backend', 'Level'),
            'category' => Yii::t('backend', 'Category'),
            'log_time' => Yii::t('backend', 'Log time'),
            'prefix' => Yii::t('backend', 'Prefix'),
            'message' => Yii::t('backend', 'Message'),
        ];
    }
}
