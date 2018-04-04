<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use janisto\timepicker\TimePicker;
use common\models\Emotion;
$this->title = '情感天地';
?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index']) ?>">首页</a>
                </li>
                <li class="active">
                    情感天地
                </li>
            </ul>
        </div>
        <div class="col-md-12 column">
            <h3 class="text-center">
                分享你的故事
            </h3>
            <div class="carousel slide" id="carousel-80759">
                <ol class="carousel-indicators">
                    <li data-slide-to="0" data-target="#carousel-80759">
                    </li>
                    <li data-slide-to="1" data-target="#carousel-80759">
                    </li>
                    <li data-slide-to="2" data-target="#carousel-80759" class="active">
                    </li>
                </ol>
                <div class="carousel-inner">
                    <div class="item">
                        <img alt="" src="images/qinggantiandi1.jpg" style="width: 1600px;height: 500px;" class="img-responsive center-block" />
                        <div class="carousel-caption">

                        </div>
                    </div>
                    <div class="item">
                        <img alt="" src="images/qinggantiandi2.jpg" style="width: 1600px;height: 500px;" class="img-responsive center-block" />
                        <div class="carousel-caption">

                        </div>
                    </div>
                    <div class="item active">
                        <img alt="" src="images/qinggantiandi3.jpg" style="width: 1600px;height: 500px;" class="img-responsive center-block" />
                        <div class="carousel-caption">

                        </div>
                    </div>
                </div> <a class="left carousel-control" href="#carousel-80759" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-80759" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>




        </div>
        <div class="col-md-12" style="border: 1px solid #e4e6eb;margin-top: 20px">
            <?php $form = ActiveForm::begin(['method' => "get",'action'=>Url::to(['emotion/index']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>
            <div class="col-md-3">
                <input type="text" class="form-control"  name="emotionname" value="<?=Yii::$app->request->get('emotionname')?>" placeholder="情感关键词">
            </div>

            <input type="submit" name="search_submit" value="过滤" class="btn">
            <?php $form = ActiveForm::end(); ?>
            <button class="btn btn-primary btn-lg" style="float: right;margin-bottom: 10px;" onclick="showaddemotion();">
                我要发布
            </button>


        </div>
        <div   id="addemotion" style="display: none; width: 600px;margin: 0 auto; ">
            <form action="<?=Url::to(['emotion/create'])?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
                    情感故事主题:<input type="text" name="emotionname" required class="form-control">
                    情感故事内容:<textarea name="emotioncontent" required class="form-control" style="height: 600px"></textarea>
                    情感故事照片:<input type="file" name="emotionimage" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="clearaddemotion();"
                    >关闭
                    </button>
                    <button type="submit" class="btn btn-primary">
                        提交
                    </button>
                </div>
            </form>
        </div>

        <div class="col-md-12" style="border: 1px solid #e4e6eb;margin-top: 20px;margin-bottom: 200px">
            <?php
            foreach ($data as $row){
                ?>
                <div class="columnroom" style="text-align: center">
                    <h1 ><a style="text-decoration: none" href="<?=Url::to(['emotion/detail','emotionid'=>$row['emotionid']])?>" ><?php echo $row['emotionname'] ?></a>
                        <button type="button" class="btn btn-default btn-lg" style="margin-right: 100px;float: right">
                            <span class="glyphicon glyphicon-user"></span><?php echo  $row['username'];  ?>
                        </button>
                    </h1>
                    <p style="font-size: 20px;font-family:Microsoft YaHei">
                        <?=Emotion::getstr($row['emotioncontent'])?>
                    </p>

                </div>
                <!--                    <div class="col-md-7" style="margin-top: 50px;">-->
                <!--                        <h1><a  href="--><?//=Url::to(['room/detail'])?><!--">--><?php // echo $row['roomname'] ?><!--</a></h1>-->
                <!--                        <div class="col-md-6">-->
                <!--                            --><?php // echo $row['roomaddress'] ?>
                <!--                        </div>-->
                <!--                    </div>-->


            <?php }  ?>
        </div>


    </div>

</div>
<style>
    .columnroom{
        background-color: #ffffff;
        margin-top: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #e4e6eb ;
    }
    .imagesdiv{
        text-align: center;
    }
    .span{
        margin-left: 50px;
        color: #00CC66;
    }
</style>
<script>
    function showaddemotion() {
        $("#addemotion").show();
    }
    function clearaddemotion() {
        $("#addemotion").hide();
    }
</script>
