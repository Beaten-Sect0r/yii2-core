<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%key_storage_item}}".
 *
 * @property integer $key
 * @property integer $value
 */
class KeyStorageItem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%key_storage_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            ['key', 'unique'],
            ['key', 'string', 'max' => 128],
            ['comment', 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('common', 'Key'),
            'value' => Yii::t('common', 'Value'),
            'comment' => Yii::t('common', 'Comment'),
        ];
    }
}
