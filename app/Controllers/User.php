<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Validation\UserRules;

class User extends BaseController {

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * funkce pro domovskou stranku
     *
     */
    public function home() {
        //prazdny array $data
        $data = [];
        //heleper funkce formy
        helper('form');

        //overi jestli metoda post nebo get
        if ($this->request->getMethod() == 'post') {
            //validace vsutpu
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|validateUser[email, password]',
            ];
            //customizovana validace
            $errors = [
                'password' => [
                    'validateUser' => 'Uživatel není registrován!'
                ],
            ];
            //pokud neni validace do prazdneho arraye pridej validacni errory
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                //novy usermodel
                $model = new UserModel();
                //ziskani dat
                $user = $model->where('uEmail', $this->request->getVar('email'))
                              ->first();
                //prihlaseni uzivatele
                $this->setUserMethod($user);
                //return na dosmovskou stranku
                return redirect()->to('/');
            }
        } else {
            //pokud neni validovano ani overeno ani neni uzivatel vraci na domovskou stranku
            return view("home", $data);
        }
        //zakladni routa na domovskou stranku, i bez prihlaseni
        return view('home', $data);
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     * @throws \ReflectionException
     * funkce pro registraci
     */
    public function register() {
        //prazdny array $data
        $data = [];
        //heleper funkce formy
        helper('form');

        //overi jestli metoda post nebo get
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
            //pokud neni validace do prazdneho arraye pridej validacni errory
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                //novy usermodel
                $model = new UserModel();
                //pripoj array s daty uzivatele ze vstupu
                $userData = [
                    'uName' => $this->request->getVar('name'),
                    'uEmail' => $this->request->getVar('email'),
                    'uNick' => $this->request->getVar('nickname'),
                    'uPassword' => $this->request->getVar('password'),
                    'uText' => "Váš text",
                    'uGroup' => 1
                ];
                //uloz do databaze
                $model->save($userData);
                //vytvor sesseion s informaci o registraci
                $session = session();
                $session->setFlashdata('succes', 'Úspěšná registrace!');
                //return na domovskou stranku
                return redirect()->to('/');
            }
        } else {
            //neni validace vrat na regiter nebo jiny error
            return view("register", $data);
        }
        //zakladni routa na registracni stranku
        return view("register", $data);
    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse
     * funkce pro logout
     */
    public function logout() {
        //pokud neexistuje session user s param. isLoggedIn vrat na domovskou stranku
        if(!session()->get('user')['isLoggedIn']) {
            return redirect()->to('/');
        }
        //jinak zrus session a vrat na domovskou stranku
        session()->destroy();
        return redirect()->to('/');
    }

    /**
     * @param $user
     * @return bool
     * funkce pro samostatne prihlaseni uzivatele
     */
    private function setUserMethod($user) {
        //array s daty
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
        //vytvorim session s arrayem $data
        session()->set('user', $data);
        //vrat true pro moznou kontrolu zda prihlaseni bylo uspesne
        return true;
    }

    //funkce pro dashboard
    public function dashboard($error = []) {
        //prazdny array a pak pridani selectnutych dat z databaze
        $returnData = [];
        $returnData['user_data'] = $this->fetch_all();
        //return na dashboard
        return view('dashboard', $returnData);
    }

    /**
     * @param array $data
     * @return string
     * funkce pro delete uzivatele
     */
    public function delete($data = []) {
        //novy usermodel
        $model = new UserModel();
        //pokud data nejsou prazdne tak smazu uzivatele
        if(!empty($data[0])) {
            $id = $data[0];
            if($id !== session()->get('user')['id']) {                
                $this->deleteUser($model, $id);
            }else {
                session()->setFlashdata('delete_error', 'Nemůžeš vymazat sám sebe!');
            }
        }
        //return na dashboard
        return $this->dashboard();
    }


    //funkce pro formou edit, podobna delete
    public function edit($data = []) {
        //pokud jsou data prazdne redirect na dashboard formu krok zpet
        if(!empty($data[0])) {
            $id = $data[0];
            $userArray = $this->fetch_single_data($id);
            session()->setFlashdata('user_data', $userArray);
            return view('edit');
        }
        return redirect()->to('/dashboard');
    }

    /**
     * @return string
     * @throws \ReflectionException
     * funkce s formou save
     */
    public function save() {
        //novy usermodel s helperem
        $model = new UserModel();
        helper('form');
        //overeni jestli je metoda post
        if($this->request->getMethod() === "post") {
            //2 mosnozti poku neni prazdny text, cekame zmenu textu, jinak ostatni data
            if(!empty($this->request->getVar('text'))) {
                $rules = [
                    'uid' => 'required',
                    'name' => 'required|min_length[3]|max_length[60]',
                    'email' => 'required|min_length[6]|max_length[128]',
                    'nickname' => 'required|min_length[3]|max_length[40]',
                    'text' => 'required|min_length[5]|max_length[160]',
                    'group' => 'required'
                ];
            }
            else {
                $rules = [
                    'uid' => 'required',
                    'name' => 'required|min_length[3]|max_length[60]',
                    'email' => 'required|min_length[6]|max_length[128]',
                    'nickname' => 'required|min_length[3]|max_length[40]',
                    'group' => 'required'
                ];
            }             
            if(!$this->validate($rules)) {
                $error['validation'] = $this->validator;
                return view('edit', $error);
            }else {
                if(!empty($this->request->getVar('text'))) {
                    $userData = [
                        'uName' => $this->request->getVar('name'),
                        'uEmail' => $this->request->getVar('email'),
                        'uNick' => $this->request->getVar('nickname'),
                        'uText' => $this->request->getVar('text'),
                        'uGroup' => $this->request->getVar('group')
                    ];
                }else {
                    $userData = [
                        'uName' => $this->request->getVar('name'),
                        'uEmail' => $this->request->getVar('email'),
                        'uNick' => $this->request->getVar('nickname'),
                        'uGroup' => $this->request->getVar('group')
                    ];
                }              
                $model->update(session()->get('user_data')['id'], $userData);
                return $this->dashboard();
            }
        }
        return $this->dashboard();
    }

    public function deleteUser($model, $id) {
        $model->where('id', $id);
        $model->delete();
    }

    public function fetch_all() {        
        $model = new UserModel();

        $data = $model->query('SELECT id, uName, uEmail, uNick, uPassword, uText, registred_at, uGroup FROM users');
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
            if(!empty($this->request->getVar('text'))) {
                $rules = [
                    'name' => 'required|min_length[3]|max_length[60]',
                    'text' => 'required|min_length[5]|max_length[160]'
                ];
            }else {
                $rules = [
                    'name' => 'required|min_length[3]|max_length[60]',
                    'password' => 'required|min_length[8]|max_length[255]',
                    'passwordControl' => 'required|matches[password]'
                ]; 
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            }
            else {
                //update v databazi
                $model = new UserModel();
                if(!empty($this->request->getVar('text'))) {
                    $userData = [
                        'uName' => $this->request->getVar('name'),
                        'uText' => $this->request->getVar('text')
                    ];
                }else {
                    $userData = [
                        'uName' => $this->request->getVar('name'),
                        'uPassword' => $this->request->getVar('password'),
                        'uText' => $this->request->getVar('text')
                    ];
                }
                $model->update(session()->get('user')['id'], $userData);

                $session = session();
                $session->setFlashdata('update', 'Úspěšná změna údajů!');
                return redirect()->to('/profile');
            }
        }
        session()->setFlashdata('user_profile', $this->fetch_single_data(session()->get('user')['id']));
        return view('profile', $data);
    }
}