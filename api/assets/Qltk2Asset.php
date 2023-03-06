<?php

namespace api\assets;


use yii\web\AssetBundle;

class Qltk2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'api/themes/qltk2/assets/global/jquery-ui/jquery-ui.min.css',
        'api/themes/qltk2/assets/global/jquery-ui/jquery-ui.css',
        'api/themes/qltk2/assets/global/plugins/font-awesome/css/font-awesome.min.css',
        'api/themes/qltk2/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'api/themes/qltk2/assets/global/plugins/bootstrap/css/bootstrap.min.css',
        'api/themes/qltk2/assets/global/plugins/uniform/css/uniform.default.css',
        'api/themes/qltk2/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',

        'api/themes/qltk2/assets/global/plugins/bootstrap-select/bootstrap-select.min.css',
        'api/themes/qltk2/assets/global/plugins/select2/select2.css',
        'api/themes/qltk2/assets/global/plugins/jquery-multi-select/css/multi-select.css',
        'api/themes/qltk2/assets/admin/pages/css/profile-old.css',
        'api/themes/qltk2/assets/global/css/components.css',
        'api/themes/qltk2/assets/global/css/plugins.css',
        'api/themes/qltk2/assets/admin/layout/css/layout.css',
        'api/themes/qltk2/assets/admin/layout/css/themes/darkblue.css',
        'api/themes/qltk2/assets/global/plugins/bootstrap-toastr/toastr.min.css',
        'api/assets/plugins/jquery-confirm-master/dist/jquery-confirm.min.css',
        'api/assets/plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.min.css',
        'api/assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css',
        'api/themes/qltk2/assets/admin/layout/css/custom.css',
        'api/assets/plugins/lightbox/dist/css/lightbox.min.css',
    ];
    public $js = [
        'api/themes/qltk2/assets/global/scripts/jquery-migrate-1.2.1.min.js',

        'api/themes/qltk2/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'api/themes/qltk2/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'api/themes/qltk2/assets/global/plugins/jquery.blockui.min.js',
        'api/themes/qltk2/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'api/themes/qltk2/assets/global/plugins/bootstrap-toastr/toastr.min.js',
        'api/themes/qltk2/assets/global/scripts/metronic.js',
        'api/themes/qltk2/assets/admin/layout/scripts/layout.js',
        'api/themes/qltk2/assets/admin/layout/scripts/quick-sidebar.js',
        'api/themes/qltk2/assets/global/scripts/jquery.PrintArea.js',

        'api/themes/qltk2/assets/global/plugins/bootstrap-select/bootstrap-select.min.js',
        'api/themes/qltk2/assets/global/plugins/select2/select2.min.js',
        'api/themes/qltk2/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js',
        'api/assets/plugins/jQuery-contextMenu-master/dist/jquery.contextMenu.min.js',
        'api/assets/plugins/jquery-confirm-master/dist/jquery-confirm.min.js',
        'api/assets/plugins/lightbox/dist/js/lightbox.min.js',
        'api/assets/js-view/doimatkhau.js',
        'api/themes/qltk2/assets/global/scripts/main.js',
        'api/assets/js-view/pusher.min.js',
        'api/themes/qltk2/assets/global/plugins/jquery-ui/jquery-ui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
