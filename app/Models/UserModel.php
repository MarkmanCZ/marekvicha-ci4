<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table = 'users';
    protected $allowedFields = ['id', 'uName','uEmail', 'uNick', 'uPassword', 'uText','registred_at', 'uGroup'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data) {
        //zpracovani dat pred insertem
        $data = $this->hashPassword($data);

        return $data;
    }

    protected function beforeUpdate(array $data) {
        $data = $this->hashPassword($data);

        return $data;
    }

    protected function hashPassword($data) {
        if(isset($data['data']['uPassword']))
            $data['data']['uPassword'] = password_hash($data['data']['uPassword'], PASSWORD_DEFAULT);
        return $data;
    }

}