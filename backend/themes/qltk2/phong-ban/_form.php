<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\models\PhongBan;
use common\widgets\select2\Select2;
use backend\models\PhongBanNhanVien;

/* @var $this yii\web\View */
/* @var $model backend\models\PhongBan */
/* @var $modelpbnv PhongBanNhanVien */
/* @var $nhanVienNotInPhongBan */
/* @var $nhanVienInPhongBan */
/* @var $form yii\widgets\ActiveForm */

?>
<?php
$nhanVienNotInPhongBanItems = array_map(function ($nhanVien) {
    return [
        "id" => $nhanVien->id,
        "hoten" => $nhanVien->hoten,
        "dien_thoai" => $nhanVien->dien_thoai,
        "email" => $nhanVien->email,
        "checked" => true,
    ];
}, $nhanVienNotInPhongBan);
$nhanVienInPhongBanItems = array_map(function ($nhanVien) {
    return [
        "id" => $nhanVien->nhan_vien_id,
        "hoten" => $nhanVien->hoten,
        "dien_thoai" => \backend\services\NhanVienService::getAttributeOfNhanVien($nhanVien->nhan_vien_id, 'dien_thoai'),
        "email" => \backend\services\NhanVienService::getAttributeOfNhanVien($nhanVien->nhan_vien_id, 'email'),
        "checked" => false,
    ];
}, $nhanVienInPhongBan);
$nhanVienNotInPhongBanItems = array_merge($nhanVienNotInPhongBanItems, $nhanVienInPhongBanItems);
$idNhanViens = array_column($nhanVienNotInPhongBanItems, 'id');
array_multisort($idNhanViens, SORT_ASC, $nhanVienNotInPhongBanItems);
$isFormAddNhanVien = isset($type) && $type == 'add-nhan-vien';
if ($isFormAddNhanVien) {
    $backUrl = \yii\helpers\Url::to(['phong-ban/them-nhan-vien', 'id' => \Yii::$app->request->get('id')]);
} else {
    $backUrl = \yii\helpers\Url::to(['phong-ban/' . ($model->isNewRecord ? 'create' : 'update'), 'id' => \Yii::$app->request->get('id') ?? null]);
}
?>
<div class="phong-ban-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "Tên bộ phận / phòng ban", 'disabled' => $isFormAddNhanVien]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'parent_id')->widget(\backend\components\Select2::className(), [
                'options' => ['placeholder' => 'Chọn khối', 'disabled' => $isFormAddNhanVien],
                'data' => ArrayHelper::map(\backend\services\PhongBanService::getLevelPhongBansWithPrefixLevelCharacters(), 'id', 'prefix_level_name')
            ])
            ?>
        </div>
        <div class="col-md-4">
            <?php if (isset($model->truongPhong)): ?>
                <?= $form->field($model, 'truong_phong_id')->widget(\backend\components\Select2::className(), ['data' => ArrayHelper::map([['id' => $model->truong_phong_id, 'hoten' => $model->truongPhong->hoten]], 'id', 'hoten'),
                    'options' => ['placeholder' => '-- Chọn Trưởng Phòng --', 'disabled' => !$model->isNewRecord]]) ?>
            <?php else: ?>
                <?= $form->field($model, 'truong_phong_id')->widget(\backend\components\Select2::className(), ['data' => ArrayHelper::map(
                    $nhanVienNotInPhongBan, 'id', 'hoten'),
                    'options' => ['placeholder' => '-- Chọn Trưởng Phòng --', 'disabled' => !$model->isNewRecord]]) ?>
            <?php endif; ?>

        </div>
        <div class="col-md-12"></div>
        <div class="col-md-8">
            <h4><strong>CHỌN NHÂN VIÊN</strong></h4>
            <table id="table-nhan-vien" class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Họ tên</th>
                    <th class="text-center">Điện thoại</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Chọn</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($nhanVienNotInPhongBanItems as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <a href="<?= \yii\helpers\Url::to(['nhan-vien/view', 'id' => $item['id'], 'back_url' => $backUrl]) ?>"
                               role="modal-remote"> <?= $item["hoten"] ?></a></td>
                        <td><?= $item["dien_thoai"] ?></td>
                        <td><?= $item["email"] ?></td>
                        <td class="text-center row-nhan-vien"
                            id="chon_nhan_vien_<?= $item["id"] ?>"><?= Html::a($item["checked"] ? '<i class="fa fa-check-circle"></i>' : '', '#', ['class' => 'text-success btn-chon-nhan-vien', 'id' => 'nhan_vien_' . $item["id"], 'data-value' => $item["id"], 'hoten' => $item["hoten"]]) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <h4><strong>NHÂN VIÊN ĐÃ CHỌN</strong></h4>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">Họ tên</th>
                    <th class="text-center">Xóa</th>
                </tr>
                </thead>
                <tbody class="nhan-vien-da-chon">
                </tbody>
            </table>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    if (typeof (isLoaded) === "undefined") {
        var isLoaded = false;
    }

    var dataTable = $('#table-nhan-vien').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/vi.json"
        }
    })
    var nhanVienInPhongBanItems = <?=json_encode($nhanVienInPhongBanItems)?>;
    var nhanVienInPhongBanItemsSaved = <?=json_encode($nhanVienInPhongBanItems)?>;

    function loadTableNhanVienDaChon() {
        var html = "";
        $('.phong-ban-form form .nhanVienPhongBanInput').remove();
        for (const nhanVien of nhanVienInPhongBanItems) {
            var indexSelected = nhanVienInPhongBanItemsSaved.findIndex(item => parseInt(item.id) === parseInt(nhanVien.id));
            if (indexSelected < 0) {
                html += `<tr><td>${nhanVien.hoten}</td><td class="text-center"><a class="text-danger btn-xoa-nhan-vien" data-id="${nhanVien.id}"><i class="fa fa-trash"></i></a></td></tr>`;
            } else {
                html += `<tr><td>${nhanVien.hoten}</td><td class="text-center"><a class="text-danger btn-xoa-nhan-vien" href="/index.php?r=phong-ban/delete-nhan-vien&id=${nhanVien.id}&phong_ban_id=<?=!$model->isNewRecord ? $model->id : '' ?><?=$isFormAddNhanVien ? '&type=them-nhan-su' : ''?>" role="modal-remote" data-id="${nhanVien.id}"><i class="fa fa-trash"></i></a></td></tr>`;
            }
            $('.phong-ban-form form').append(`<input type="hidden" name="PhongBan[nhanVienPhongBan][]" class="nhanVienPhongBanInput" value="${nhanVien.id}">`);
        }
        $('.nhan-vien-da-chon').html(html);


    }

    if (!isLoaded) {
        isLoaded = true;
        addFunction();
    }

    loadTableNhanVienDaChon();

    function addFunction() {

        addFunctionToDataTable();

        function addFunctionToDataTable() {
            $('body').on('click', '.btn-chon-nhan-vien', function (e) {
                e.preventDefault()

                var id = $(this).attr('data-value')
                var hoten = $(this).attr('hoten')
                nhanVienInPhongBanItems.push({id, hoten});
                $('#nhan_vien_' + id).text('')
                loadTableNhanVienDaChon();
            })
        }

        $('body').on('click', '.btn-xoa-nhan-vien', function () {

            var id = $(this).attr('data-id');
            var index = nhanVienInPhongBanItems.findIndex(v => parseInt(v.id) === parseInt(id));
            nhanVienInPhongBanItems.splice(index, 1)
            loadTableNhanVienDaChon();

            $('#chon_nhan_vien_' + id).find('a').html('<i class="fa fa-check-circle"></i>')

        })

        // $('body').on('click', '.paginate_button', function (e){
        //     console.log('zczddcsadc')
        //     $('.row-nhan-vien').each(function(){
        //         console.log($(this).attr('data-value'))
        //     })
        // })

        $('#table-nhan-vien').on('page.dt', function (e) {
            setTimeout(function () {
                var info = dataTable.page.info()
                $('.row-nhan-vien').each(function (index) {
                    var id = $(this).find('a').attr('data-value')
                    var idSelected = nhanVienInPhongBanItems.findIndex(function (item) {
                        return parseInt(item.id) === parseInt(id);
                    });
                    if (idSelected < 0) {
                        $(this).find('a').html('<i class="fa fa-check-circle"></i>');
                    }
                })
            }, 50)

        })
    }

</script>

<style>
    @media (min-width: 992px)
        .modal-lg {
            width: 1000px;
        }
</style>

