<?php
use backend\assets\IndexAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

IndexAsset::register($this);

$this->title = 'SGPOC | Home';

?>

<head>
    <title><?php $this->title?></title>
</head>
<body class='content-wrapper' >
    <div class='header'>
        <h2>Bienvenidos a</h2>    
        <h1>SGPOC</h1><!--
        <img class='app-logo' src='https://previews.123rf.com/images/faysalfarhan/faysalfarhan1501/faysalfarhan150100632/35298055-money-box-euro-sign-icon-green-round-button.jpg' alt='Logo App'>
    -->
    </div>
    <div>
        <button id='boton' class='boton'><i class='fa fa-info'></i></button>
    </div>
    <div id='expand' class="contacto" style="display:none;">
        <ul>
            <li>Popy Wilde | <i class="far fa-envelope"></i> popywilde@gmail.com</li>
            <li>Otro Docente | <i class="far fa-envelope"></i> otrodocente@gmail.com</li>
        </ul>
    </div> 
    <a href='http://www.fau.unt.edu.ar' target='_blank'>
        <img class='fau-logo' src='http://localhost/sgpoc/backend/web/img/logoFAU.png' alt='Logo Fau'>
    </a>
</body>
</html>



