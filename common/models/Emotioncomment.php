<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emotioncomment".
 *
 * @property integer $emotioncommentid
 * @property integer $emotionid
 * @property string $emotioncontent
 * @property integer $uid
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property Emotion $emotion
 * @property XUser $u
 */
class Emotioncomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emotioncomment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emotionid', 'emotioncontent', 'uid'], 'required'],
            [['emotionid', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['emotioncontent'], 'string', 'max' => 255],
            [['emotionid'], 'exist', 'skipOnError' => true, 'targetClass' => Emotion::className(), 'targetAttribute' => ['emotionid' => 'emotionid']],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emotioncommentid' => '情感故事评论id',
            'emotionid' => '情感故事id',
            'emotioncontent' => '评论内容',
            'uid' => '发帖人',
            'createtime' => '创建时间',
            'updatetime' => '修改时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmotion()
    {
        return $this->hasOne(Emotion::className(), ['emotionid' => 'emotionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(XUser::className(), ['id' => 'uid']);
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->createtime=time();
                $this->updatetime=time();
            }
            else{
                $this->updatetime=time();
            }
            return true;
        }
        else{
            return false;
        }
    }
}
