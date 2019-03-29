<?php

namespace App\Controllers;

use App\Classes\View;
use App\Models\Address;
use App\Models\Email;
use App\Models\Number;
use App\Models\User;

/**
 * Class Base Мейн контроллер
 * @package App\Controllers
 */
class Base
{
    protected $view;
    protected $user;
    protected $address;
    protected $email;
    protected $number;


    public function __construct()
    {
        $this->view = new View();
        $this->user = new User();

    }

    public function action($action)
    {
        $methodName = 'action' . ucfirst($action);
        return $this->$methodName();
    }

    /**
     * Главная страница до/после авторизации
     */
    public function actionHome()
    {
        $this->view->users = \App\Models\User::findAll();
        $this->view->numbers = \App\Models\Number::findAll();
        $this->view->emails = \App\Models\Email::findAll();
        $this->view->addresses = \App\Models\Address::findAll();
        if(isset($_SESSION['user'])) {
            $this->view->display(__DIR__ . '/../templates/index2.php');
        } else {
            $this->view->display(__DIR__ . '/../templates/index.php');
        }
    }

    public function actionLogin()
    {
        unset($_SESSION['user']);
        unset($_SESSION['user_id']);
        if(!empty($_POST['login'])&&!empty($_POST['passwd'])) {
            if(!$this->user->checkUser($_POST['login'],$_POST['passwd'])) {
                $this->view->error = 'Неправильный логин или пароль';
            }
        } else {
            if(!empty($_POST)) {
                $this->view->error = 'Заполните все поля';
            }
        }
        $this->view->display(__DIR__ . '/../templates/login.php');
    }

    /**
     * Обработка главной формы.
     */
    public function actionMyContact()
    {

       if(!empty($_POST)) {
           $this->user->first_name = $_POST['first_name'];
           $this->user->last_name = $_POST['last_name'];
           $this->user->id = $_SESSION['user_id'];
           $this->user->publish_contact = $_POST['publish_contact'] ? 'on' : 'off';
           $this->user->update();

           $this->address = new Address();
           $this->email = new Email();
           $this->number = new Number();

           $this->address->address = $_POST['address'];
           $this->address->zip_city = $_POST['zip_city'];
           $this->address->country_id = $_POST['country_id'];
           $this->address->id = $_SESSION['user_id'];
           $this->address->update();

           $publish_numbers = $_POST['publish_number'];
           $numbers = $_POST['numbers'];
           $this->number->user_id = $_SESSION['user_id'];
           $this->number->delete();    // костыль
           foreach ($numbers as $k => $number) {
               $this->number->number = $number;
               $this->number->user_id = (int)$_SESSION['user_id'];
               $this->number->publish = $publish_numbers[$k];
               $this->number->insert();
           }
           $publish_emails = $_POST['publish_email'];
           $emails = $_POST['emails'];
           $this->email->user_id = $_SESSION['user_id'];
           $this->email->delete();              // костыль
           foreach ($emails as $k => $email) {
               $this->email->email = $email;
               $this->email->user_id = (int)$_SESSION['user_id'];
               $this->email->publish = $publish_emails[$k];
               $this->email->insert();
           }
       }

        $this->view->user = User::findByLogin($_SESSION['user']);
        $this->view->numbers = \App\Models\Number::findAll();
        $this->view->emails = \App\Models\Email::findAll();
        $this->view->countries = \App\Models\Country::findAll();
        $this->view->address = \App\Models\Address::findById($this->view->user->id);
        $this->view->display(__DIR__ . '/../templates/myContact.php');
    }

}