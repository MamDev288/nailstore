<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $vaitros \backend\controllers\UserController*/
/* @var $vaitrouser \backend\controllers\UserController*/
use yii\helpers\VarDumper;
    if(!isset($vaitros))
    {
        $vaitros=[];
    }
    if(!isset($vaitrouser))
    {
        $vaitrouser=[];
    }
?>

<div class="user-create">


        <?= $this->render('_form', [
            'model' => $model,
            'vaitros' => $vaitros,
        ]) ?>

</div>
