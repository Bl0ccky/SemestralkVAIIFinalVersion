<?php

namespace App\Controllers;

use App\Auth;
use App\Config\Configuration;
use App\Models\JoinedTour;
use App\Models\Tour;
use App\Models\User;
use mysql_xdevapi\ExecutionStatus;

class AuthController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->html(
            [
                'active' => 'home'
            ]);
    }

    public function loginForm()
    {
        return $this->html(
            [
                'active' => 'login',
                'error' => $this->request()->getValue('error'),
                'correctMessage' => $this->request()->getValue('correctMessage'),
                'correctMessage2' => $this->request()->getValue('correctMessage2')
            ]);
    }

    public function registrationForm()
    {
        return $this->html(
            [
                'active' => 'registration',
                'badName' => $this->request()->getValue('badName'),
                'badLastName' => $this->request()->getValue('badLastName'),
                'badDate' => $this->request()->getValue('badDate'),
                'badEmail' => $this->request()->getValue('badEmail'),
                'badLogin' => $this->request()->getValue('badLogin'),
                'badPassword' => $this->request()->getValue('badPassword')

            ]
        );
    }

    public function profile()
    {
        $tours = Tour::getAll();
        $joined_tours = JoinedTour::getAll();
        return $this->html(
            [
                'active' => 'profile',
                'tours' => $tours,
                'joined_tours' => $joined_tours,
                'message' => $this->request()->getValue('message')
            ]
        );
    }

    public function editProfileForm()
    {
        return $this->html(
            [
                'active' => 'profile',
                'correctMessage' =>$this->request()->getValue('correctMessage'),
                'badName' => $this->request()->getValue('badName'),
                'badLastName' => $this->request()->getValue('badLastName'),
                'badDate' => $this->request()->getValue('badDate'),
                'badEmail' => $this->request()->getValue('badEmail'),
                'badLogin' => $this->request()->getValue('badLogin')
            ]
        );
    }

    public function editPasswordForm()
    {
        return $this->html(
            [
                'active' => 'profile',
                'badOldPass' => $this->request()->getValue('badOldPass'),
                'badNewPass' => $this->request()->getValue('badNewPass'),
                'badNewPassAgain' => $this->request()->getValue('badNewPassAgain')
            ]
        );

    }

    public function registration()
    {
        $email = $this->request()->getValue('email');
        if (Auth::findIdByEmail($email) == 0)
        {

            $name = $this->request()->getValue('name');
            $lastName = $this->request()->getValue('last_name');
            $date = $this->request()->getValue('date');
            $login = $this->request()->getValue('login');
            $email = $this->request()->getValue('email');
            $password = $this->request()->getValue('password');

            $badName = '';
            $badLastName = '';
            $badDate = '';
            $badEmail = '';
            $badLogin = '';
            $badPassword = '';

            $correctRegistration = true;
            if(!Auth::validUserName($name))
            {
                $correctRegistration = false;
                $badName = 'Meno musí byť vyplnené!';

            }
            if(!Auth::validUserName($lastName))
            {
                $correctRegistration = false;
                $badLastName = 'Priezvisko musí byť vyplnené!';
            }
            if(!Auth::validDateOfBirth($date))
            {
                $correctRegistration = false;
                $badDate = 'Musíš mať minimálne 18 rokov!';
            }
            if (!Auth::validEmail($email))
            {
                $correctRegistration = false;
                $badEmail = 'Zlý formát emailu!';
            }
            if (!Auth::validLogin($login))
            {
                $correctRegistration = false;
                $badLogin = 'Login musí začínať veľkým písmenom a obsahovať len písmená!';
            }
            if(!Auth::validPassword($password))
            {
                $correctRegistration = false;
                $badPassword = 'Heslo musí obsahovať aspoň 8 znakov, z toho 1 veľké písmeno, 1 číslo a 1 špeciálny znak';
            }
            if($correctRegistration)
            {
                $user = new User();
                $user->setName($name);
                $user->setLastName($lastName);
                $user->setDate($date);
                $user->setEmail($email);
                $user->setLogin($login);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $user->setPassword($hashed_password);
                $user->save();
                $this->redirect('auth', 'loginForm', ['correctMessage' => 'Úspešná registrácia!', 'correctMessage2' => 'Môžete sa prihlásiť']);
            }
            else
            {
                $this->redirect('auth', 'registrationForm',
                    ['badName' => $badName,
                    'badLastName' => $badLastName,
                    'badDate' => $badDate,
                    'badEmail' => $badEmail,
                    'badLogin' => $badLogin,
                    'badPassword' => $badPassword]);
            }

        }
        else
        {
            $this->redirect('auth', 'registrationForm', ['badEmail' => 'Užívateľ s takýmto emailom už existuje!']);
        }

    }

    public function login()
    {
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');

        $logged = Auth::login($login, $password); //skontroluje ci som prihlaseny ak ano vrati true

        if ($logged) {
            $this->redirect('home');
        } else {
            $this->redirect('auth', 'loginForm', ['error' => 'Zlý email alebo heslo!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }


    public function editProfile()
    {
        $id = Auth::getId();
        if ($id != 0)
        {
            $newEmail = $this->request()->getValue('email');
            if (Auth::findIdByEmail($newEmail) == 0 || Auth::findIdByEmail($newEmail) == $id)
            {

                $name = $this->request()->getValue('name');
                $lastName = $this->request()->getValue('last_name');
                $login = $this->request()->getValue('login');
                $email = $this->request()->getValue('email');
                $date = $this->request()->getValue('date');

                $badName = '';
                $badLastName = '';
                $badDate = '';
                $badEmail = '';
                $badLogin = '';

                $correctEdit = true;
                if(!Auth::validUserName($name))
                {
                    $correctEdit = false;
                    $badName = 'Meno musí byť vyplnené!';

                }
                if(!Auth::validUserName($lastName))
                {
                    $correctEdit = false;
                    $badLastName = 'Priezvisko musí byť vyplnené!';
                }
                if(!Auth::validDateOfBirth($date))
                {
                    $correctEdit = false;
                    $badDate = 'Musíš mať minimálne 18 rokov!';
                }
                if (!Auth::validEmail($email))
                {
                    $correctEdit = false;
                    $badEmail = 'Zlý formát emailu!';
                }
                if (!Auth::validLogin($login))
                {
                    $correctEdit = false;
                    $badLogin = 'Login musí začínať veľkým písmenom a obsahovať len písmená!';
                }

                if($correctEdit)
                {
                    $user = User::getOne($id);
                    $user->setName($name);
                    $user->setLastName($lastName);
                    $user->setLogin($login);
                    $user->setEmail($email);
                    $user->setDate($date);

                    if (isset($_FILES['profile_image'])) {       //Ak mi prisiel nejaky subor
                        if ($_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
                            if($user->getImage())
                            {
                                unlink(Configuration::PROFILE_IMAGE_DIR . $user->getImage());
                            }
                            $name = time() . $_FILES['profile_image']['name'];     //Vytvorim si meno suboru
                            move_uploaded_file($_FILES['profile_image']['tmp_name'], Configuration::PROFILE_IMAGE_DIR . "$name"); //movnem to z tmp priecinka do mojho priecinka v premennej UPLOAD_DIR
                            $user->setImage($name);
                        }
                    }
                    $_SESSION['email'] = $newEmail;   //zrusim session, nebudem prihlaseny
                    $user->save();
                    $this->redirect('auth', 'profile', ['message' => 'Zmeny sa vykonali!']);
                }
                else
                {
                    $this->redirect('auth', 'editProfileForm',
                        ['badName' => $badName,
                            'badLastName' => $badLastName,
                            'badDate' => $badDate,
                            'badEmail' => $badEmail,
                            'badLogin' => $badLogin]);
                }

            }
            else
            {
                $this->redirect('auth', 'editProfileForm', ['badEmail' => 'Užívateľ s takýmto emailom už existuje!']);
            }
        }
    }



    public function editPassword()
    {
        $id = Auth::getId();
        if ($id != 0) {
            $user = User::getOne($id);
            $oldPassword = $this->request()->getValue('old_password');
            $newPassword = $this->request()->getValue('new_password');
            $newPasswordAgain = $this->request()->getValue('new_password_again');

            $badOldPass = '';
            $badNewPass = '';
            $badNewPassAgain = '';

            $correctPasswordEdit = true;

            if (!password_verify($oldPassword, $user->getPassword()))
            {
                $correctPasswordEdit = false;
                $badOldPass = 'Staré heslo sa nezhoduje!';
            }
            if ($newPassword != $newPasswordAgain)
            {
                $correctPasswordEdit = false;
                $badNewPassAgain = 'Zadané nové heslo sa nezhoduje s overením nového hesla!';
            }
            if (!Auth::validPassword($newPassword))
            {
                $correctPasswordEdit = false;
                $badNewPass = 'Heslo musí obsahovať aspoň 8 znakov, z toho 1 veľké písmeno, 1 číslo a 1 špeciálny znak';
            }
            if($correctPasswordEdit)
            {
                $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
                $user->setPassword($hashed_password);
                $user->save();
                $this->redirect('auth', 'editProfileForm', ['correctMessage' => 'Heslo bolo úspešne zmenené!']);
            }
            else
            {
                $this->redirect('auth', 'editPasswordForm',
                    ['badOldPass' => $badOldPass,
                        'badNewPass' => $badNewPass,
                        'badNewPassAgain' => $badNewPassAgain,
                        ]);
            }

        }
    }

    public function deleteAcc()
    {
        $id_user = Auth::getId();
        if($id_user != 0)
        {
            $user = User::getOne($id_user);
            Auth::deleteAllUserInfoFromDatabase($id_user);
            Auth::logout();
            unlink(Configuration::PROFILE_IMAGE_DIR . $user->getImage());
            $user->delete();
            $this->redirect('home', 'index', ['message' => 'Účet bol úspešne zrušený']);
        }

    }



}