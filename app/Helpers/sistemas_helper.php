<?php
//-------------Primeira função------/
   if(!function_exists('sistemas')){

     function sistemas(){

       $sistemaModel = new \App\Models\SistemaModel();

          return $sistemaModel->findAll();

   }

 }

 // -----------Segunda função------/
     if(!function_exists('listagem')){

       function listagem(){

         $sistemaModel = new \App\Models\SistemaModel();

            return $sistemaModel->findAll();

     }

   }
