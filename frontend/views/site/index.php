<?php
$this->title = '校园拼客';
use yii\helpers\Url;
?>
<title>校园拼客</title>
<div class="row" style="text-align: center">
    <div class="col-md-12">
        <div class="col-md-4"><a href="<?=Url::to(['room/index']) ?>"><img class="image img-thumbnail" title="拼房" src="images/hezu.jpg" /></a></div>
        <div class="col-md-4"><a href="<?=Url::to(['travel/index']) ?>"><img class="image img-thumbnail" src="images/lvxing.jpg" /></a></div>
        <div class="col-md-4"><a href="<?=Url::to(['emotion/index'])?>"> <img class="image img-thumbnail" src="images/qinggan.jpg" /></a></div>
        <div class="col-md-4"><a href="<?=Url::to(['star/index']) ?>"><img class="image img-thumbnail" src="images/zhuixing.jpg" /></a></div>
        <div class="col-md-4"> <a href="<?=Url::to(['compet/index']) ?>"> <img class="image img-thumbnail" src="images/jianshen.jpg" /></a></div>
        <div class="col-md-4"> <a href=""><img class="image img-thumbnail" src="images/zhuimeng.jpg" /></a></div>
        <div class="col-md-4"><a href="<?=Url::to(['oldbook/index']) ?>"><img class="image img-thumbnail" src="images/jiushu.jpg" /></a></div>
        <div class="col-md-4"> <a href="<?=Url::to(['exam/index']) ?>"> <img class="image img-thumbnail" src="images/kaoshi.jpg" /></a></div>
        <div class="col-md-4"> <a href="<?=Url::to(['musium/index']) ?>"> <img class="image img-thumbnail" src="images/tushuguan.jpg" /></a></div>
    </div>
</div>
<style>
    body{
        background-color:#f5f5f5 ;
    }
    .image{
        height: 250px;
        width: 250px;
        border-radius: 30%;
        margin: 10px;
    }

</style>
