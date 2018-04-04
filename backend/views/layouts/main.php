<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '校园拼客',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'style'=>'font-size:25px;'
        ],

    ]);
    $leftmenuItems = [
        ['label'=>'生活管理','items'=>[
            ['label' => '旅行故事管理', 'url' => ['/traval/index']],
            ['label' => '旅行故事评论管理', 'url' => ['/travalcomment/index']],
            ['label' => '合租空间管理', 'url' => ['/room/index']],
            ['label' => '合租空间评论管理', 'url' => ['/roomcontent/index']],
            ['label' => '情感天地管理', 'url' => ['/emotion/index']],
            ['label' => '情感天地评论管理', 'url' => ['/emotioncomment/index']],
        ]],
        ['label'=>'娱乐管理','items'=>[
            ['label' => '追星剧场管理', 'url' => ['/star/index']],
            ['label' => '追星剧场评论管理', 'url' => ['/starcomment/index']],
            ['label' => '竞技空间管理', 'url' => ['/compet/index']],
            ['label' => '竞技空间评论管理', 'url' => ['/competcomment/index']],
        ]],
        ['label'=>'学习管理','items'=>[
            ['label' => '旧书市场管理', 'url' => ['/oldbook/index']],
            ['label' => '旧书市场评论管理', 'url' => ['/oldbookcomment/index']],
            ['label' => '考试有方管理', 'url' => ['/exam/index']],
            ['label' => '考试有方评论管理', 'url' => ['/examcomment/index']],
            ['label' => '图书馆约管理', 'url' => ['/musium/index']],
            ['label' => '图书馆约评论管理', 'url' => ['/musiumcomment/index']],
        ]],
        ['label'=>'会员管理','items'=>[
            ['label' => '普通会员', 'url' => ['/xuser/index']],
            ['label' => '管理员', 'url' => ['/adminuser/index']],
        ]],

    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出(' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftmenuItems,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
