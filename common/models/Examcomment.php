<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "examcomment".
 *
 * @property integer $examcommentid
 * @property string $examcommenttext
 * @property integer $uid
 * @property integer $examid
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property Exam $exam
 * @property XUser $u
 */
class Examcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'examcomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['examcommenttext', 'uid', 'examid', 'createtime', 'updatetime'], 'required'],
            [['uid', 'examid', 'createtime', 'updatetime'], 'integer'],
            [['examcommenttext'], 'string', 'max' => 255],
            [['examid'], 'exist', 'skipOnError' => true, 'targetClass' => Exam::className(), 'targetAttribute' => ['examid' => 'examid']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'examcommentid' => '考试有方评论id',
            'examcommenttext' => '考试有方评论内容',
            'uid' => '评论人id',
            'examid' => '考试有方id',
            'createtime' => '创建时间',
            'updatetime' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['examid' => 'examid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }
}
