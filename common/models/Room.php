<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property integer $roomid
 * @property string $roomname
 * @property string $roomimage
 * @property integer $roomprice
 * @property string $roomaddress
 * @property string $roomstatus
 * @property integer $uid
 * @property string $createtime
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roomname', 'roomprice', 'roomaddress', 'roomstatus', 'uid', 'createtime'], 'required'],
            [['roomprice', 'uid'], 'integer'],
            [['roomname'], 'string', 'max' => 20],
            [['roomimage'], 'file', 'skipOnEmpty' => true,'extensions' => 'png, jpg'],
            [['roomaddress'], 'string', 'max' => 255],
            [['roomstatus'], 'string', 'max' => 10],
            [['createtime'], 'integer'],
            [['uid'],'exist','skipOnError'=>true,'targetClass'=>XUser::className(),'targetAttribute'=>['uid'=>'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'roomid' => '合租房间发帖ID',
            'roomname' => '合租房间名',
            'roomimage' => '合租房间照片',
            'roomprice' => '合租房间价格',
            'roomaddress' => '合租房间地址',
            'roomstatus' => '合租房间状态',
            'uid' => '发帖人ID',
            'createtime' => '发表时间',

        ];
    }
    public function getStatus0(){
        return $this->hasOne(XUser::className(),['id'=>'uid']);
    }
    public static function findusername($id){
        return XUser::find()->where('id',$id);
    }
}
