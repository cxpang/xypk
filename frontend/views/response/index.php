<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = '回复中心';
//var_dump($roomresponse);
?>
<div class="container" style="margin-top: 80px">
    <div class="row clearfix">
        <div class="col-md-1 column">
        </div>
        <div class="col-md-10 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index'])?>">首页</a>
                </li>
                <li class="active">
                    回复中心
                </li>

            </ul>
            <?php if(!empty($roomresponse)){?>
                <a href="<?=Url::to(['room/detail','roomid'=>$roomresponse[0]['roomid']])?>" style="text-decoration: none">
                    <div class="panel panel-primary" style="cursor: pointer">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$roomresponse[0]['upicture']?>"><?=$roomresponse[0]['username']?>
                                :<?=$roomresponse[0]['contenttext']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?php  echo Yii::$app->user->identity->upicture;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$roomresponse[0]['roomname']?>
                            <h2>发表于合租空间</h2>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$roomresponse[0]['createtime'])?>
                        </div>
                    </div>
                </a>
            <?php }?>
            <?php if(!empty($emotionresponse)){?>
                <a href="<?=Url::to(['emotion/detail','emotionid'=>$emotionresponse[0]['emotionid']])?>" style="text-decoration: none">
                    <div class="panel panel-primary" style="cursor: pointer">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$emotionresponse[0]['upicture']?>"><?=$emotionresponse[0]['username']?>
                                :<?=$emotionresponse[0]['emotioncontent']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?php  echo Yii::$app->user->identity->upicture;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$emotionresponse[0]['emotionname']?>
                            <h2>发表于情感天地</h2>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$emotionresponse[0]['createtime'])?>
                        </div>
                    </div>
                </a>
            <?php }?>

            <?php if(!empty($travelresponse)){?>
                <a href="<?=Url::to(['travel/detail','travalid'=>$travelresponse[0]['travalid']])?>" style="text-decoration: none">
                    <div class="panel panel-primary" style="cursor: pointer">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$travelresponse[0]['upicture']?>"><?=$travelresponse[0]['username']?>
                                :<?=$travelresponse[0]['travalcontent']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?php  echo Yii::$app->user->identity->upicture;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$travelresponse[0]['travalname']?>
                            <h2>发表于旅行故事</h2>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$travelresponse[0]['createtime'])?>
                        </div>
                    </div>
                </a>
            <?php }?>

            <?php if(!empty($starresponse)){?>
                <a href="<?=Url::to(['star/detail','starid'=>$starresponse[0]['starid']])?>" style="text-decoration: none">
                    <div class="panel panel-primary" style="cursor: pointer">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$starresponse[0]['upicture']?>"><?=$starresponse[0]['username']?>
                                :<?=$starresponse[0]['starcommenttext']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?php  echo Yii::$app->user->identity->upicture;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$starresponse[0]['starname']?>
                            <h2>发表于追星剧场</h2>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$starresponse[0]['createtime'])?>
                        </div>
                    </div>
                </a>
            <?php }?>

            <?php if(!empty($competresponse)){?>
                <a href="<?=Url::to(['compet/detail','competid'=>$competresponse[0]['competid']])?>" style="text-decoration: none">
                    <div class="panel panel-primary" style="cursor: pointer">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$competresponse[0]['upicture']?>"><?=$competresponse[0]['username']?>
                                :<?=$competresponse[0]['competcommenttext']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?php  echo Yii::$app->user->identity->upicture;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$competresponse[0]['competname']?>
                            <h2>发表于健身空间</h2>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$competresponse[0]['createtime'])?>
                        </div>
                    </div>
                </a>
            <?php }?>

            <?php if(!empty($examresponse)){?>
                <a href="<?=Url::to(['exam/detail','examid'=>$examresponse[0]['examid']])?>" style="text-decoration: none">
                    <div class="panel panel-primary" style="cursor: pointer">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$examresponse[0]['upicture']?>"><?=$examresponse[0]['username']?>
                                :<?=$examresponse[0]['examcommenttext']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?php  echo Yii::$app->user->identity->upicture;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$examresponse[0]['examname']?>
                            <h2>发表于考试有方</h2>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$examresponse[0]['createtime'])?>
                        </div>
                    </div>
                </a>
            <?php }?>

            <?php if(!empty($oldbookresponse)){?>
                <a href="<?=Url::to(['oldbook/detail','oldbookid'=>$oldbookresponse[0]['oldbookid']])?>" style="text-decoration: none">
                    <div class="panel panel-primary" style="cursor: pointer">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$oldbookresponse[0]['upicture']?>"><?=$oldbookresponse[0]['username']?>
                                :<?=$oldbookresponse[0]['oldbookcommenttext']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?php  echo Yii::$app->user->identity->upicture;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$oldbookresponse[0]['oldbookname']?>
                            <h2>发表于旧书市场</h2>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$oldbookresponse[0]['createtime'])?>
                        </div>
                    </div>
                </a>
            <?php }?>


            <?php if(!empty($musiumresponse)){?>

                <a href="<?=Url::to(['musium/detail','musiumid'=>$musiumresponse[0]['musiumid']])?>" style="text-decoration: none">
                    <div class="panel panel-primary" style="cursor: pointer">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <img style="width: 50px;height: 50px;border-radius: 50%" src="<?=$musiumresponse[0]['upicture']?>"><?=$musiumresponse[0]['username']?>
                                :<?=$musiumresponse[0]['musiumcommenttext']?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <img style="width: 50px;height: 50px;border-radius: 50%" src="<?php  echo Yii::$app->user->identity->upicture;?>"><?php echo Yii::$app->user->identity->username; ?>
                            :<?=$musiumresponse[0]['musiumname']?>
                            <h2>发表于图书馆约</h2>

                        </div>
                        <div class="panel-footer">
                            评论时间:<?=date('Y-m-d H:i:s',$musiumresponse[0]['createtime'])?>
                        </div>
                    </div>
                </a>
            <?php }?>

        </div>
        <div class="col-md-1 column">
        </div>
    </div>
</div>

