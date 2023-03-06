<?php

namespace common\services;

interface PhanQuyenServiceInterface extends ServiceInterface
{
    const ServiceName = 'phanQuyenService';

    public function getNewChucNangModel();

    public function getChucNangList(array $query = []);

    public function createChucNang(array $postData = []);

    public function getChucNangDetail($id);

    public function updateChucNang($id, array $postData = []);

    public function deleteChucNang($id);

    public function getNewVaiTroModel();

    public function getVaiTroList(array $query = []);

    public function createVaiTro(array $postData = []);

    public function getVaiTroDetail($id);

    public function updateVaiTro($id, array $postData = []);

    public function deleteVaiTro($id);

    public function getChucNangsNhoms();

    public function getChucNangNhoms();

    public function getVaiTros();

    public function newVaiTroUserModel();

    public function getVaiTroUserDetail($userId);

    public function phanQuyen($postData, $userId);
}