<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/10
 * Time: 15:34
 */

namespace common\services;

use common\models\Star;
use common\models\Starcomment;
use common\models\Starcommentres;
class Delstarservice
{

    public function delstar($starid){

        $db=\Yii::$app->db;
        $translation=$db->beginTransaction();
        try{
            Starcommentres::deleteAll(['starid'=>$starid]);
            Starcomment::deleteAll(['starid'=>$starid]);
            Star::deleteAll(['starid'=>$starid]);
            $translation->commit();
            return true;
        }
        catch (\Exception $e ){

            $translation->rollBack();
            return $e->getMessage();
        }

    }
}