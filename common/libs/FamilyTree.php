<?php

namespace common\libs;

use yii\helpers\ArrayHelper;

trait FamilyTree {
    abstract public function getItems();

    public function getIdAssign(){
        return 'id';
    }

    public function getParentAssign(){
        return 'parent_id';
    }

    public function getLevelAssign(){
        return 'level';
    }

    /**
     * Lấy tất cả item con theo id
     * @param $id
     * @return array
     */
    public function getSons($id){
        $items = $this->getItems();
        $sons = [];
        foreach ($items as $item){
            if($item[$this->getParentAssign()] == $id){
                $sons[] = $item;
            }
        }
        return $sons;
    }

    /**
     * Lấy danh sách hậu duệ
     * @param $id
     * @param $level
     * @return array
     */
    public function getDescendants($id, $level = 1){
        $nodes = [];
        $items = $this->getItems();
        foreach ($items as $item) {
            if($item[$this->getParentAssign()] == $id){
                $item[$this->getLevelAssign()] = $level;
                $nodes[] = $item;
                $nodes = array_merge($nodes, $this->getDescendants($item[$this->getIdAssign()], $level + 1));
            }
        }
        return $nodes;
    }

    /**
     * Lấy tất cả item cha theo id
     * @param $id
     * @return array
     */
    public function getParents($id){
        $nodes = [];
        $items = $this->getItems();
        $items = ArrayHelper::index($items, $this->getIdAssign());
        foreach ($items as $item){
            if($items[$id][$this->getParentAssign()] == $item[$this->getIdAssign()]){
                $nodes[] = $item;
            }
        }
        return $nodes;
    }

    /**
     * Lấy danh sách tổ tiên
     * @param $id
     * @return array
     */
    public function getAncestors($id){
        $nodes = [];
        $items = $this->getItems();
        foreach ($items as $item){
            if($item[$this->getIdAssign()] == $id){
                $nodes[] = $item;
                if($item[$this->getParentAssign()] != 0){
                    $nodes = array_merge($nodes, $this->getAncestors($item[$this->getParentAssign()]));
                }
            }
        }
        return $nodes;
    }
}