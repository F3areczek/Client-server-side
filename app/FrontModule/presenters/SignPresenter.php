<?php

namespace App\FrontModule\Presenters;

use Nette,
    Nette\Application\UI,
    Nette\Application\UI\Form as Form,
    App\Model;


class SignPresenter extends BasePresenter
{

    private $userModel;

    function __construct(\User $userModel) {
        $this->userModel = $userModel;
    }

    public function beforeRender() {
        parent::beforeRender();
        if ($this->user->isLoggedIn()){
            $this->flashMessage('Do této oblastí nemáte oprávnění!', 'alert-danger');
            $this->redirect('Homepage:default');
        }
    }

    protected function createComponentRegisterForm() {
        $form = new Form;
        $form->addText('name', 'Jméno')
                ->setAttribute('class', 'form-control');
        $form->addText('email', 'E-mail: *')
                ->setAttribute('class', 'form-control')
                ->setEmptyValue('@')
                ->addRule(Form::FILLED, 'Vyplňte Váš email')
                ->addCondition(Form::FILLED)
                ->addRule(Form::EMAIL, 'Neplatná emailová adresa');
        $form->addPassword('password', 'Heslo: *')
                ->setAttribute('class', 'form-control')
                ->addRule(Form::FILLED, 'Vyplňte Vaše heslo')
                ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků.', 6);
        $form->addPassword('password2', 'Heslo znovu: *')
                ->setAttribute('class', 'form-control')
                ->addConditionOn($form['password'], Form::VALID)
                ->addRule(Form::FILLED, 'Heslo znovu')
                ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['password']);
        $form->addSubmit('send', 'Registrovat')
                ->setAttribute("class", "btn btn-default pull-right");
        $form->onSuccess[] = [$this, 'registerFormSubmitted'];
        return $form;
    }

    public function registerFormSubmitted(UI\Form $form) {
        $values = $form->getValues();

        if ($this->userModel->existingUser($values->email)){
            $this->flashMessage('Uživatelský email je již obsazen', 'alert-danger');
            $this->redirect('this');
        }

        $new_user_id = $this->userModel->register($values);
        if($new_user_id){
            $this->flashMessage('Registrace se zdařila, jo!');
            $this->redirect('Homepage:default');
        }
    }
}
