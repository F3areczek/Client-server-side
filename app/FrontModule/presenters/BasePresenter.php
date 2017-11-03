<?php

namespace App\FrontModule\Presenters;

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
    }
    public function beforeRender() {
        parent::beforeRender();
        $this->template->thisYear = date("Y");
    }

    protected function createComponentSignForm() {
        $form = new Form;
        $form->addText('email', 'E-mail: *')
                ->setAttribute('class', 'form-control')
                ->setAttribute('placeholder', 'Zadejte email')
                ->addRule(Form::FILLED, 'Vyplňte Váš email')
                ->addCondition(Form::FILLED)
                ->addRule(Form::EMAIL, 'Neplatná emailová adresa');
        $form->addPassword('password', 'Heslo: *')
                ->setAttribute('class', 'form-control')
                ->setAttribute('placeholder', 'Zadejte heslo')
                ->addRule(Form::FILLED, 'Vyplňte Vaše heslo');
        $form->addSubmit('submit', 'Přihlásit')
                ->setAttribute("class", "btn btn-primary btn-block");
        $form->onSuccess[] = [$this, 'loginFormSubmitted'];
        return $form;
    }

    public function loginFormSubmitted(UI\Form $form) {
        $user = $this->getUser();
        $values = $form->getValues();
        try {
            $user->login($values->email, $values->password);
            $this->flashMessage('Přihlášení proběhlo úspěšně', 'alert-success');
            $this->redirect('Homepage:default');
        
        } catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage('Uživatelské jméno nebo heslo je nesprávné', 'alert-warning');
        }
    }

    public function handleLogOut(){
        $this->user->logout();
        $this->flashMessage('Uživatel byl odhlášen', 'alert-warning');
        $this->redirect('Homepage:default');
    }
}
