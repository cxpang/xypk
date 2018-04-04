<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "travalcomment".
 *
 * @property integer $travalcommentid
 * @property integer $travalid
 * @property string $travalcontent
 * @property integer $uid
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property XUser $u
 * @property Traval $traval
 */
class Travalcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'travalcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['travalid', 'travalcontent', 'uid', 'createtime', 'updatetime'], 'required'],
            [['travalid', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['travalcontent'], 'string', 'max' => 255],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
            [['travalid'], 'exist', 'skipOnError' => true, 'targetClass' => Traval::className(), 'targetAttribute' => ['travalid' => 'travalid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'travalcommentid' => '旅行评论id',
            'travalid' => '旅行目的地',
            'travalcontent' => '评论内容',
            'uid' => '发表评论人',
            'createtime' => '评论时间',
            'updatetime' => '修改时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraval()
    {
        return $this->hasOne(Traval::className(), ['travalid' => 'travalid']);
    }
}
