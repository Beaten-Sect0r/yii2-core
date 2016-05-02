<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use common\models\query\MenuQuery;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $label
 * @property integer $parent_id
 * @property integer $status
 * @property integer $sort_index
 *
 * @property Menu $parent
 * @property Menu $childs
 */
class Menu extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'label'], 'required'],
            [['parent_id', 'sort_index'], 'integer'],
            [['url', 'label'], 'string', 'max' => 255],
            ['parent_id', 'exist', 'skipOnError' => true, 'targetClass' => self::className(), 'targetAttribute' => ['parent_id' => 'id']],
            ['status', 'default', 'value' => self::STATUS_DRAFT],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url' => Yii::t('common', 'Link'),
            'label' => Yii::t('common', 'Name'),
            'parent_id' => Yii::t('common', 'Parent'),
            'status' => Yii::t('common', 'Status'),
            'sort_index' => Yii::t('common', 'Sort index'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChilds()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}
