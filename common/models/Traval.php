<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "traval".
 *
 * @property integer $travalid
 * @property string $travalname
 * @property string $travaltime
 * @property string $travalcontent
 * @property integer $travalprice
 * @property integer $travaldays
 * @property string $travalimage
 * @property integer $uid
 * @property string $status
 * @property integer $createtime
 * @property integer $updatetime
 *
 * @property XUser $u
 * @property Travalcomment[] $travalcomments
 */
class Traval extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'traval';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['travalname', 'travaltime', 'travalcontent', 'travalprice', 'travaldays', 'uid', 'status',], 'required'],
            [['travalprice', 'travaldays', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['travalname', 'travaltime'], 'string', 'max' => 100],
            [['travalcontent'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
            [['travalimage'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg'],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'travalid' => '旅行故事id',
            'travalname' => '旅行目的地',
            'travaltime' => '旅行时间',
            'travalcontent' => '旅行安排',
            'travalprice' => '旅行价格',
            'travaldays' => '旅行天数',
            'travalimage' => '目的地照片',
            'uid' => '发帖人',
            'status' => '状态',
            'createtime' => '发布时间',
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
    public function getTravalcomments()
    {
        return $this->hasMany(Travalcomment::className(), ['travalid' => 'travalid']);
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
