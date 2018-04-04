<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/9
 * Time: 17:54
 */
namespace common\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $file;
    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }


}