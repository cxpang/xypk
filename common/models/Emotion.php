<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emotion".
 *
 * @property integer $emotionid
 * @property string $emotionname
 * @property string $emotioncontent
 * @property string $emotionimage
 * @property integer $uid
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property XUser $u
 * @property Emotioncomment[] $emotioncomments
 */
class Emotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emotionname', 'emotioncontent', 'emotionimage', 'uid',], 'required'],
            [['emotioncontent'], 'string'],
            [['uid', 'createtime', 'updatetime'], 'integer'],
            [['emotionname'], 'string', 'max' => 100],
            [['emotionimage'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg'],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emotionid' => '情感故事id',
            'emotionname' => '情感故事名',
            'emotioncontent' => '情感故事内容',
            'emotionimage' => '情感内容照片',
            'uid' => '发帖人',
            'createtime' => '创建时间',
            'updatetime' => '更新时间',
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
    public function getEmotioncomments()
    {
        return $this->hasMany(Emotioncomment::className(), ['emotionid' => 'emotionid']);
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
    public static function getstr($string){
        $len=strlen($string);
        if($len<400){
            return $len;
        }
        else{
            return substr($string,0,400).'**********';
        }
    }
}
