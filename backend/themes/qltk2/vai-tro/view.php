<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\form\VaiTroForm */

?>
<div class="vai-tro-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'chucNangs',
                'format' => 'raw',
                'value' => function ($model) {
                    $chucNangs = \backend\services\VaiTroService::getChucNangsByVaiTroId($model->id);
                    $str = '';
                    foreach ($chucNangs as $chucNang){
                        $str .= '<span class="badge bagde-info" style="margin-right: 5px">'.$chucNang->name.' '.$chucNang->nhom.'</span>';
                    }
                    return $str;
                }
            ],
        ],
    ]) ?>

</div>
