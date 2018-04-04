<?php
/**
 * Created by PhpStorm.
 * User: pangchenxu
 * Date: 2018/2/27
 * Time: 15:25
 */
namespace common\services;

use common\models\Traval;
use common\models\Travalcomment;
use common\models\Travalcommentres;
use yii\db\Exception;
use yii\web\NotFoundHttpException;


class DeltravalService
{
    public function delTraval($travalid){

        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            Travalcommentres::deleteAll(['travalid'=>$travalid]);
            Travalcomment::deleteAll(['travalid'=>$travalid]);
            Traval::deleteAll(['travalid'=>$travalid]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }

    }


}