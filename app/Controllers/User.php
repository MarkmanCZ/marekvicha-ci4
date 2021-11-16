<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Validation\UserRules;

class User extends BaseController {

    public function home() {
        //zaroven forma pro login
        $data = [];
        helper('form');

        if ($this->request->getMethod() == 'post') {
            //validace vsutpu
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|validateUser[email, password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Uživatel není registrován!'
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                //prihlas uzivatele

                $model = new UserModel();

                $user = $model->where('uEmail', $this->request->getVar('email'))
                              ->first();
                $this->setUserMethod($user);
                return redirect()->to('/');
            }
        } else {
            return view("home", $data);
        }

        return view('home', $data);
    }

    public function register()
    {
        $data = [];
        helper('form');

        if ($this->request->getMethod() == 'post') {
            //validace vsutpu
            $rules = [
                'name' => 'required|min_length[3]|max_length[60]',
                'email' => 'required|min_length[6]|max_length[128]|valid_email|is_unique[users.uEmail]',
                'nickname' => 'required|min_length[3]|max_length[40]|is_unique[users.uNick]',
                'password' => 'required|min_length[8]|max_length[255]',
                'passwordControl' => 'required|matches[password]',
                'checkBox' => 'required'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                //uloz do databaze

                $model = new UserModel();

                $userData = [
                    'uName' => $this->request->getVar('name'),
                    'uEmail' => $this->request->getVar('email'),
                    'uNick' => $this->request->getVar('nickname'),
                    'uPassword' => $this->request->getVar('password'),
                    'uText' => "Váš text",
                    'uGroup' => 1
                ];
                $model->save($userData);
                $session = session();
                $session->setFlashdata('succes', 'Úspěšná registrace!');
                return redirect()->to('/');
            }
        } else {
            return view("register", $data);
        }
        return view("register", $data);
    }

    public function logout()
    {
        if(!session()->get('user')['isLoggedIn'])
        {
            return redirect()->to('/');
        }
        session()->destroy();
        return redirect()->to('/');
    }

    private function setUserMethod($user) {
        $data = [
            'id' => $user['id'],
            'name' => $user['uName'],
            'email' => $user['uEmail'],
            'nick' => $user['uNick'],
            'password' => $user['uPassword'],
            'text' => $user['uText'],
            'group' => $user['uGroup'],
            'registered' => $user['registred_at'],
            'isLoggedIn' => true,
        ];

        session()->set('user', $data);
        return true;
    }

    public function dashboard() {
        $returnData = [];

        $returnData['user_data'] = $this->fetch_all();

        return view('dashboard', $returnData);
    }

    public function delete($data = []) {
        $model = new UserModel();
        if(!empty($data[0])) {
            $id = $data[0];
            $this->deleteUser($model, $id);
        }
        return $this->dashboard();
    }

    public function edit($data = []) {
        $model = new UserModel();
        if(!empty($data[0])) {
            $id = $data[0];
            $returnData['user'] = $this->fetch_single_data($id);
            return view('edit', $returnData);
        }

    }

    public function deleteUser($model, $id) {
        $model->where('id', $id);
        $model->delete();
    }

    public function fetch_all() {        
        $model = new UserModel();

        $data = $model->query('SELECT id, uName, uEmail, uNick, uText, registred_at, uGroup FROM users');
        $result = $data->getResult();

        return $result;
    }

    public function fetch_single_data($id = null) {      
        $model = new UserModel();

        $result = $model->where('id', $id)
                       ->first();
        return $result;
    }  

    public function profile() {
        $data = [];
        helper('form');
        //update profilu
        if($this->request->getMethod() === "post") {
            //validace a update to do
            $rules = [
                'name' => 'required|min_length[3]|max_length[60]',
                'text' => 'required|min_length[5]|max_length[160]',
                'password' => 'required|min_length[8]|max_length[255]',
                'passwordControl' => 'required|matches[password]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            }
            else {
                //update v databazi
                $model = new UserModel();

                $userData = [
                    'uName' => $this->request->getVar('name'),
                    'uPassword' => $this->request->getVar('password'),
                    'uText' => $this->request->getVar('text')
                ];
                $model->update(session()->get('user')['id'], $userData);

                $session = session();
                $session->setFlashdata('update', 'Úspěšná změna údajů!');
                return redirect()->to('/profile');
            }

        }
        return view('profile', $data);

    }
}