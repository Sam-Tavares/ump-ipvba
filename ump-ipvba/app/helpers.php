<?php

function datas($date){
    return date('d/m/Y',strtotime($date));
 }

 function data_abrev($date){
   return date('d/m',strtotime($date));
}

function hora_abrev($date){
   return date('H:i',strtotime($date));
}

 function mes($date){
    return date('m',strtotime($date));
 }

 function anoatual(){
   return date('Y');
 }

 function valor($valor){
   return number_format($valor,2,",",".");
}

?>