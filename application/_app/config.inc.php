<?php
//CONFIGURAÇÕES DO SITE ####################

define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBSA','gamechoose_original');

//AUTOLOAD DE CLASSES ######################
   function __autoload($Class) //recebe o nome da classe no parametro
   {
       $cDir = ['Conn'];
       $iDir = null;

       foreach ($cDir as $dirName):
           if(!$iDir && file_exists(__DIR__ . "\\{$dirName}//{$Class}.class.php") && !is_dir(__DIR__ . "\\{$dirName}\\{$Class}.class.php")):
               include_once (__DIR__ . "\\{$dirName}\\{$Class}.class.php");
               $iDir = true;
               endif;
       endforeach;
       
       if(!$iDir):
            trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
       die;
       endif;
   }
//TRATAMENTO DE ERROS #####################
// CSS constantes :: Mensagens de Erro

define('CR_ACCEPT','accept');
define('CR_INFOR','infor');
define('CR_ALERT','alert');
define('CR_ERROR','error');

//CRErro :: Exibe erros lançados :: Front
function CRErro($ErrMsg, $ErrNo, $ErrDie = null ) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? CR_INFOR : ($ErrNo == E_USER_WARNING ? CR_ALERT : ($ErrNo == E_USER_ERROR ? CR_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";
    
    if($ErrDie):
        die;
    endif;
}
//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? CR_INFOR : ($ErrNo == E_USER_WARNING ? CR_ALERT : ($ErrNo == E_USER_ERROR ? CR_ERROR : $ErrNo)));
    
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na linha: {$ErrLine} ::</b> {$ErrMsg} <br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";
    
    if($ErrNo == E_USER_ERROR):
        die;
    endif;
    
}
set_error_handler('PHPErro');