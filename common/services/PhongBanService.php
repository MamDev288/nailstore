<?php

namespace common\services;

use backend\helpers\ConstHelper;
use backend\models\PhongBan;
use backend\models\search\PhongBanSearch;
use yii\helpers\ArrayHelper;

class PhongBanService extends Service implements PhongBanServiceInterface
{
    public function getSearchModel(array $options = [])
    {
        return new PhongBanSearch();
    }

    public function getModel($id, array $options = [])
    {
        return PhongBan::find()->where(['id' => $id, 'active' => ConstHelper::STATUS_ACTIVE])->one();
    }

    public function newModel(array $options = [])
    {
        $phongBan = new PhongBan();
        $phongBan->active = ConstHelper::STATUS_ACTIVE;
        $phongBan->loadDefaultValues();
        return $phongBan;
    }

    public function getList(array $query = [], array $options = [])
    {
        $searchModel = $this->getSearchModel();
        $options['dataSource'] = $this->getLevelPhongBansWithPrefixLevelCharacters();
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
            if (isset($phongBans[$k + 1]['level']) && $phongBans[$k + 1]['level'] == $phongBan['level']) {
                $name = ' ├' . $phongBan['name'];
            } else {
                $name = ' └' . $phongBan['name'];
            }
            if (end($phongBans)->id == $phongBan->id) {
                $sign = ' └';
            } else {
                $sign = ' │';
            }
            $phongBan->prefix_level_name = str_repeat($sign, $phongBan['level'] - 1) . $name;
        }
        return ArrayHelper::index($phongBans, 'id');
    }
}