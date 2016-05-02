<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use common\models\query\ArticleQuery;
use creocoder\taggable\TaggableBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $keywords
 * @property string $preview
 * @property string $body
 * @property integer $status
 * @property integer $category_id
 * @property integer $author_id
 * @property integer $updater_id
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property string $tagValues
 *
 * @property User $author
 * @property ArticleCategory $category
 * @property User $updater
 * @property Tag[] $tags
 */
class Article extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => 'updater_id',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
                'immutable' => true,
            ],
            TaggableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'preview', 'body', 'category_id'], 'required'],
            [['preview', 'body'], 'string'],
            ['published_at', 'default',
                'value' => function () {
                    return date(DATE_ISO8601);
                }
            ],
            ['published_at', 'filter', 'filter' => 'strtotime'],
            [['status', 'category_id', 'author_id', 'updater_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'description', 'keywords'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_DRAFT],
            ['author_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            ['category_id', 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            ['updater_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updater_id' => 'id']],
            ['tagValues', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('common', 'Title'),
            'slug' => Yii::t('common', 'Slug'),
            'description' => Yii::t('common', 'Description'),
            'keywords' => Yii::t('common', 'Keywords'),
            'preview' => Yii::t('common', 'Preview'),
            'body' => Yii::t('common', 'Text'),
            'status' => Yii::t('common', 'Status'),
            'category_id' => Yii::t('common', 'Category'),
            'author_id' => Yii::t('common', 'Author'),
            'updater_id' => Yii::t('common', 'Updater'),
            'published_at' => Yii::t('common', 'Published at'),
            'created_at' => Yii::t('common', 'Created at'),
            'updated_at' => Yii::t('common', 'Updated at'),
            'tagValues' => Yii::t('common', 'Tags'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%article_tag}}', ['article_id' => 'id']);
    }

    /**
     * Returns tags that post is tagged with (as links).
     *
     * @return string 
     */
    public function getTagLinks()
    {
        $tagLinks = [];

        foreach ($this->tags as $tag) {
            $tagLinks[] = Html::a($tag->name, ['tag', 'slug' => $tag->slug]);
        }

        return implode(', ', $tagLinks);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }
}
