<?php
/** @var $luotChamCong */
$this->title = "Lịch chấm công";
?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/me/JS/cham-cong.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/me/JS/clock.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile('https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>
<?php $this->registerJsFile('https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>
<?php $this->registerCssFile('https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>
<?php $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/vi.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 550,
            events: 'index.php?r=me/get-luot-cham-cong',
            locale: 'vi'
        });
        calendar.render();
    });
</script>
<div id="lich_cham_cong">
    <div class="row">
        <input type="hidden" value="<?= Yii::$app->user->id ?>" id="user_logged_id">
        <div class="col-md-3">
            <div>
                <?= $this->render('partial_view/clock.php') ?>
            </div>
            <div class="text-center" style="padding: 10px;">
                <button type="button" class="btn-cham-cong" role="button">Chấm công</button>
                <span><i><strong>Lưu ý <span class="text-danger"> *</span>: </strong>Nghiêm cấm chấm công hộ dưới mọi hình thức</i></span>
            </div>
        </div>
        <div class="col-md-9">
            <div id='calendar'></div>
        </div>

    </div>
</div>
<div id="ajaxCrudModal" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<?php \backend\components\JsBlock::begin() ?>
<script>
    $(document).ready(function () {
        (function ($) {
            $.fn.hasAttr = function (name) {
                return this.attr(name) !== undefined;
            };
        }(jQuery));
        if ($('#ajaxCrubModal').length > 0 && $('#ajaxCrudModal').length == 0) {
            modal = new ModalRemote('#ajaxCrubModal');
        } else {
            modal = new ModalRemote('#ajaxCrudModal');
        }

        // Catch click event on all buttons that want to open a modal
        $(document).on('click', '[role=\"modal-remote\"]', function (event) {
            event.preventDefault();
            // Open modal
            modal.open(this, null);
        });
    })
</script>
<?php \backend\components\JsBlock::end() ?>
<style>

    /* CSS */
    .btn-cham-cong {
        appearance: button;
        background-color: #1899D6;
        border: solid transparent;
        border-radius: 16px !important;
        border-width: 0 0 4px;
        box-sizing: border-box;
        color: #FFFFFF;
        cursor: pointer;
        display: inline-block;
        font-family: din-round, sans-serif;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: .8px;
        line-height: 20px;
        margin: 0;
        outline: none;
        overflow: visible;
        padding: 13px 16px;
        text-align: center;
        text-transform: uppercase;
        touch-action: manipulation;
        transform: translateZ(0);
        transition: filter .2s;
        user-select: none;
        -webkit-user-select: none;
        vertical-align: middle;
        white-space: nowrap;
        width: 100%;
    }

    .btn-cham-cong:after {
        background-clip: padding-box;
        background-color: #1CB0F6;
        border: solid transparent;
        border-radius: 16px;
        border-width: 0 0 4px;
        bottom: -4px;
        content: "";
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        z-index: -1;
    }

    .btn-cham-cong:main,
    .btn-cham-cong:focus {
        user-select: auto;
    }

    .btn-cham-cong:hover:not(:disabled) {
        filter: brightness(1.1);
        -webkit-filter: brightness(1.1);
    }

    .btn-cham-cong:disabled {
        cursor: auto;
    }
</style>

