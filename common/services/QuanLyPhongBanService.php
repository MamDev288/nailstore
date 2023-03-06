<?php

namespace common\services;

use backend\helpers\ConstHelper;
use backend\models\PhongBan;
use backend\models\QuanLyPhongBan;
use backend\models\search\PhongBanSearch;
use backend\models\search\QuanLyPhongBanSearch;
use yii\helpers\ArrayHelper;

class QuanLyPhongBanService extends Service implements QuanLyPhongBanServiceInterface
{
    public function getSearchModel(array $options = [])
    {
        return new QuanLyPhongBanSearch();
    }

    public function getModel($id, array $options = [])
    {
        return QuanLyPhongBan::find()->where(['id' => $id, 'active' => ConstHelper::STATUS_ACTIVE]);
    }

    public function newModel(array $options = [])
    {
        $phongBan = new QuanLyPhongBan();
        $phongBan->active = ConstHelper::STATUS_ACTIVE;
        $phongBan->loadDefaultValues();
        return $phongBan;
    }

    public function getList(array $query = [], array $options = [])
    {
        $searchModel = $this->getSearchModel();
        $options['dataSource'] = $this->getLevelPhongBansWithPrefixLevelBlocks();
        $dataProvider = $searchModel->search($query, $options);
        return [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ];
    }

    public function getLevelPhongBansWithPrefixLevelCharacters()
    {
        $model = $this->newModel();
        $phongBans = $model->getDescendants(null);
        foreach ($phongBans as $k => $phongBan) {
//            if (isset($phongBans[$k + 1]['level']) && $phongBans[$k + 1]['level'] == $phongBan['level']) {
//                $name = ' ├ ' . $phongBan['name'];
//            } else {
//                $name = ' └ ' . $phongBan['name'];
//            }
            $name = ' ├ ' . $phongBan['name'];
            if (end($phongBans)->id == $phongBan->id) {
                $sign = ' └ ';
            } else {
                $sign = ' │ ';
            }
            $phongBan->prefix_level_name = html_entity_decode(str_repeat($sign, $phongBan['level'] - 1) . $name);
        }
        return ArrayHelper::index($phongBans, 'id');
    }

    public function getLevelPhongBansWithPrefixLevelBlocks()
    {
        $model = $this->newModel();
        $phongBans = $model->getDescendants(null);
        foreach ($phongBans as $k => $phongBan) {
            if ((isset($phongBans[$k + 1]) && $phongBans[$k + 1]['parent_id'] == $phongBan['id']) || is_null($phongBan['parent_id'])) {
                $name = "<span class='tree-table-space-block btn-toggle'>-</span>" . $phongBan['name'];
            } else {
                $name = "<span class='tree-table-space-block'><i></i></span>" . $phongBan['name'];
            }

            $sign = "<span class='tree-table-space-block'><i></i></span>";
            $phongBan->prefix_level_name = str_repeat($sign, $phongBan['level'] - 1) . $name;
        }
        return ArrayHelper::index($phongBans, 'id');
    }
}