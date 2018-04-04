<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oldbook".
 *
 * @property integer $oldbookid
 * @property string $oldbookname
 * @property string $oldbookintro
 * @property integer $oldbookprice
 * @property string $oldbookimage
 * @property integer $uid
 * @property integer $createtime
 * @property integer $updatetime
 * @property string $status
 *
 * @property XUser $u
 * @property Oldbookcomment[] $oldbookcomments
 */
class Oldbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oldbook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldbookname', 'oldbookintro', 'oldbookprice', 'oldbookimage', 'uid', 'status'], 'required'],
            [['oldbookprice', 'uid', 'createtime', 'updatetime'], 'integer'],
            [['oldbookname'], 'string', 'max' => 200],
            [['oldbookintro'], 'string', 'max' => 255],
            [['oldbookimage'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg'],
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
            'oldbookid' => '旧书市场id',
            'oldbookname' => '旧书市场名',
            'oldbookintro' => '旧书市场介绍',
            'oldbookprice' => '旧书价格',
            'oldbookimage' => '旧书图片',
            'uid' => '发帖人',
            'createtime' => '新增时间',
            'updatetime' => '修改时间',
            'status' => 'Status',
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
    public function getOldbookcomments()
    {
        return $this->hasMany(Oldbookcomment::className(), ['oldbookid' => 'oldbookid']);
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
