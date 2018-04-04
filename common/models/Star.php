<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "star".
 *
 * @property integer $starid
 * @property string $starname
 * @property string $starcontent
 * @property string $starimage
 * @property string $startime
 * @property integer $starprice
 * @property integer $uid
 * @property integer $createtime
 * @property integer $updatetime
 * @property string $status
 *
 * @property XUser $u
 * @property Starcomment[] $starcomments
 */
class Star extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'star';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['starname', 'starcontent', 'starimage', 'startime', 'starprice', 'uid', 'createtime', 'updatetime', 'status'], 'required'],
            [['starprice', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['starname'], 'string', 'max' => 200],
            [['starcontent'], 'string', 'max' => 255],
            [['starimage'], 'string', 'max' => 50],
            [['startime'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 10],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => XUser::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'starid' => '追星剧场id',
            'starname' => '追星剧场名',
            'starcontent' => '追星剧场内容',
            'starimage' => '追星剧场照片',
            'startime' => '开始时间',
            'starprice' => '价格',
            'uid' => '发表人',
            'createtime' => '发表时间',
            'updatetime' => '更新时间',
            'status' => '帖子状态',
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
    public function getStarcomments()
    {
        return $this->hasMany(Starcomment::className(), ['starid' => 'starid']);
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
