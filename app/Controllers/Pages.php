<?php

namespace App\Controllers;

use App\Models\UserModel;

class Pages extends BaseController
{
    public function progress() {
        return view('progress');
    }

    public function cards() {
        $model = new UserModel();
        $data = $this->fetch_all($model);

        return view('cards', $data);
    }

    public function fetch_all() {        
        $model = new UserModel();

        $data = $model->query('SELECT uName, uEmail, uText FROM users');
        $result['data'] = $data->getResult();

        return $result;
    }

}