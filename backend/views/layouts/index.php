<?php

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Modal;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="https://foxico.io/static/uploads/logofile-83defe355ce588c170b2d3eb2d74bca7.png" type="image/ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
        <div class="container"> 
            <?= $content ?>
        </div>  
    <?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>