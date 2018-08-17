<?php

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\helpers\Url;

LoginAsset::register($this);
$this->title = 'SGPOC';
?>

<?php $this->beginPage() ?>

<body class="body">
    <?php $this->beginBody() ?>
    <header>
        <nav class="navbar navbar-static-top">
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <?php Html::button('LOGIN',['value'=>Url::to('/sgpoc/backend/web/grupos-trabajo/alta'), 'id'=>'modalButton',]);?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="carousel slide" id="slider" data-ride="carousel">
        <ol class="carousel-indicators">
            <li class="active" data-slide-to="0" data-target="#slider"></li>
            <li data-slide-to="1" data-target="#slider"></li>
            <li data-slide-to="2" data-target="#slider"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active" id="slide1"> 
                <div class="carousel-caption">
                </div>
            </div> 
            <div class="item" id="slide2"> 
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item" id="slide3"> 
                <div class="carousel-caption">
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#slider"><span class="icon-prev" role="button"></span></a>
        <a class="right carousel-control" href="#slider"><span class="icon-next" role="button"></span></a>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>