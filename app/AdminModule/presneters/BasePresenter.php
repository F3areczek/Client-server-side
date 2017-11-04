<?php

namespace App\AdminModule\Presenters;

use Nette,
    Nette\Application\UI,
    Nette\Application\UI\Form as Form,
    App\Model, 
    Nette\Security\User;


class BasePresenter extends Nette\Application\UI\Presenter 
{
    public $user;

    function startup() {
        parent::startup();
        $this->user = $this->getUser();
        if($this->user->getRoles()[0] != "admin"){
            $this->flashMessage('Nemáte administrátorská práva', 'alert-danger');
            $this->redirect(":Front:Homepage:default");
        }           
    }
    public function beforeRender() {
        parent::beforeRender();
    }
}
