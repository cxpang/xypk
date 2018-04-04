<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "musium".
 *
 * @property integer $musiumid
 * @property string $musiumname
 * @property string $musiumcontent
 * @property string $musiumimage
 * @property integer $uid
 * @property integer $createtime
 * @property integer $updatetime
 * @property string $status
 *
 * @property XUser $u
 * @property Musiumcomment[] $musiumcomments
 */
class Musium extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'musium';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['musiumname', 'musiumcontent', 'musiumimage', 'uid', 'status'], 'required'],
            [['uid', 'createtime', 'updatetime'], 'integer'],
            [['musiumname'], 'string', 'max' => 200],
            [['musiumcontent'], 'string', 'max' => 255],
            [['musiumimage'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg'],
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
            'musiumid' => '图书馆约id',
            'musiumname' => '图书馆约名',
            'musiumcontent' => '图书馆约内容',
            'musiumimage' => '图书馆约图片',
            'uid' => '发帖人',
            'createtime' => '创建时间',
            'updatetime' => '修改时间',
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
    public function getMusiumcomments()
    {
        return $this->hasMany(Musiumcomment::className(), ['musiumid' => 'musiumid']);
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
