<?php

namespace App\Controllers;

use App\Models\Carne;

class CarneController
{

    public function get($id = null)
    {
        if ($id) {
            return Carne::select($id);
        } else {
            return Carne::selectAll();
        }
    }
    public function post()
    {
        $data = $_POST;

        return Carne::insert($data);
    }
    public function update($id) 
    {
      $data = $_POST;
     return Carne::update($id, $data);
    }

    public function delete($id) 
    {
       return Carne::delete($id);
    }
}