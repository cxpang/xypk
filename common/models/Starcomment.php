<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "starcomment".
 *
 * @property integer $starcommentid
 * @property string $starcommenttext
 * @property integer $uid
 * @property integer $starid
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property Star $star
 * @property XUser $u
 */
class Starcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'starcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['starcommenttext', 'uid', 'starid', 'createtime', 'updatetime'], 'required'],
            [['uid', 'starid', 'createtime', 'updatetime'], 'integer'],
            [['starcommenttext'], 'string', 'max' => 255],
            [['starid'], 'exist', 'skipOnError' => true, 'targetClass' => Star::className(), 'targetAttribute' => ['starid' => 'starid']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'starcommentid' => '追星评论id',
            'starcommenttext' => '追星评论内容',
            'uid' => '评论人id',
            'starid' => '追星id',
            'createtime' => '创建时间',
            'updatetime' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStar()
    {
        return $this->hasOne(Star::className(), ['starid' => 'starid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }
}
