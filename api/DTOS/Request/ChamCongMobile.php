<?php 
namespace api\DTOS\Request;
class ChamCongMobile{
    public const CHECK_IN_LOAI_1 = 1;
    public const CHECK_IN_LOAI_2 = 2;
    public $iP = "";
    public $seriPhone = "";
    public $idUser = "";
    public $auth = "";
    function __construct($iP,$seriPhone,$idUser,$auth) {
        $this->iP = $iP;
        $this->seriPhone = $seriPhone;
        $this->idUser = $idUser;
        $this->auth = $auth;
    }
    
}