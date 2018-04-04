<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "competcomment".
 *
 * @property integer $competcommentid
 * @property string $competcommenttext
 * @property integer $uid
 * @property integer $competid
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property Compet $compet
 * @property XUser $u
 * @property XUser $u0
 */
class Competcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'competcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['competcommenttext', 'uid', 'competid', 'createtime', 'updatetime'], 'required'],
            [['uid', 'competid', 'createtime', 'updatetime'], 'integer'],
            [['competcommenttext'], 'string', 'max' => 255],
            [['competid'], 'exist', 'skipOnError' => true, 'targetClass' => Compet::className(), 'targetAttribute' => ['competid' => 'competid']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'competcommentid' => '竞技空间评论ID',
            'competcommenttext' => '竞技空间评论内容',
            'uid' => '评论人id',
            'competid' => '评论帖子id',
            'createtime' => '创建时间',
            'updatetime' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompet()
    {
        return $this->hasOne(Compet::className(), ['competid' => 'competid']);
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
    public function getU0()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }
}
