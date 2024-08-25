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
    public function update() {}
    public function delete() {}
}