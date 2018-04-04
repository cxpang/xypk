<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use janisto\timepicker\TimePicker;
$this->title = '健身空间';
?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <ul class="breadcrumb">
                <li>
                    <a href="<?=Url::to(['site/index']) ?>">首页</a>
                </li>
                <li class="active">
                    健身空间
                </li>
            </ul>
        </div>
        <div class="col-md-12 column">
            <h3 class="text-center">
                拥有漂亮的人鱼线
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
                        <img alt="" src="images/jianshenkongjian1.jpg" style="width: 1600px;height: 500px;" class="img-responsive center-block" />
                        <div class="carousel-caption">

                        </div>
                    </div>
                    <div class="item">
                        <img alt="" src="images/jianshenkongjian2.jpg" style="width: 1600px;height: 500px;" class="img-responsive center-block" />
                        <div class="carousel-caption">

                        </div>
                    </div>
                    <div class="item active">
                        <img alt="" src="images/jianshenkongjian3.jpg" style="width: 1600px;height: 500px;" class="img-responsive center-block" />
                        <div class="carousel-caption">

                        </div>
                    </div>
                </div> <a class="left carousel-control" href="#carousel-80759" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-80759" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>




        </div>
        <div class="col-md-12" style="border: 1px solid #e4e6eb;margin-top: 20px">
            <?php $form = ActiveForm::begin(['method' => "get",'action'=>Url::to(['compet/index']),'options' => ['style' => 'margin-top: 10px;margin-bottom:10px;'] ]); ?>
            <div class="col-md-3">
                <input type="text" class="form-control"  name="competname" value="<?=Yii::$app->request->get('competname')?>" placeholder="关键词">
            </div>

            <div class="col-md-2">
                <select class="form-control" name="status">
                    <option>全部</option>
                    <option>求健身</option>
                    <option>已结帖</option>
                </select>
            </div>

            <input type="submit" name="search_submit" value="过滤" class="btn">
            <?php $form = ActiveForm::end(); ?>
            <button class="btn btn-primary btn-lg" style="float: right;margin-bottom: 10px;" onclick="showaddcompet();">
                我要发布
            </button>


        </div>
        <div   id="addcompet" style="display: none; width: 500px;margin: 0 auto; ">
            <form action="<?=Url::to(['compet/create'])?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
                    健身空间主题:<input type="text" name="competname" required class="form-control">
                    健身空间时间:<?=TimePicker::widget([
                        'name'=>'compettime',
                        'language'=>'zh-CN',
                        'size'=>'ms',
                        'clientOptions'=>[
                            'dateFormat' => 'yy-mm-dd',
                            'timeFormat' => 'HH:mm:ss',
                            'todaybtn'=>true,
                            'autoclose'=>true,
                        ]
                    ])?>
                    健身空间内容:<textarea name="competcontent" required class="form-control" style="height: 300px" placeholder="最多200字符"></textarea>
                    健身空间照片:<input type="file" name="competimage" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="clearaddcompet();"
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
                <a href="<?=Url::to(['compet/detail','competid'=>$row['competid']])?>">
                    <div class="columnroom">
                        <div class="col-md-4" style="margin-top: 15px;" >
                            <?=Html::img($row['competimage'],['alt' => '缩略图','width' => 300,'height'=>300,'class'=>'imagediv'])?>
                        </div>
                        <div class="col-md-8" style="margin-top: 25px;">
                            <div><h1><span class="glyphicon glyphicon-flag"></span>：<?=$row['competname']?></h1></div>
                            <div><h2><span class="glyphicon glyphicon-hand-right"></span>：<?=$row['status']?></h2></div>
                            <div><h1><span class="glyphicon glyphicon-time"></span>：<?=$row['compettime']?></h1></div>
                        </div>
                    </div>
                </a>
            <?php }  ?>
        </div>


    </div>

</div>
<script>
    function showaddcompet() {
        $("#addcompet").show();
    }
    function clearaddcompet() {
        $("#addcompet").hide();
    }
</script>
<style>
    .columnroom{
        background-color: #ffffff;
        height: 320px;
        border-bottom: 1px solid #e4e6eb ;
    }
    .imagesdiv{
        text-align: center;
    }
    .imagediv{
        border-radius: 10%;
    }
    .span{
        margin-left: 50px;
        color: #00CC66;
    }
</style>
