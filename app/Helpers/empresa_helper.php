<?php
//-------------Primeira função------/
   if(!function_exists('expedientes')){

     function expedientes(){

       $expedienteModel = new \App\Models\ExpedienteModel();

          return $expedienteModel->findAll();

   }

 }

//-------------Segunda função------/
    if(!function_exists('expedienteHoje')){

      function expedienteHoje(){

        $expedienteModel = new \App\Models\ExpedienteModel();

           return $expedienteModel->where('dia', date('w'))->first();

    }

  }
