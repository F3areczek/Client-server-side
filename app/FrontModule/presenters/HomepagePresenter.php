<?php

namespace App\FrontModule\Presenters;

use Nette,
    Nette\Application\UI,
    Nette\Utils\FileSystem,
    Nette\Utils\Image;


class HomepagePresenter extends BasePresenter
{

    private $flowerModel;
    
    function __construct(\Flower $flowerModel) {
        $this->flowerModel = $flowerModel;
    }

    public function renderNewFlower(){
        if (!$this->user->isLoggedIn()){
            $this->flashMessage('Přidávat pivoňky můžou jen přihlášení uživatelé.', 'alert-danger');
            $this->redirect('Homepage:default');
        }
    }

    protected function createComponentAddFlowerForm()
    {
        $form = new UI\Form;
        $form->addText("name", "Název")
            ->setRequired('Vyplňte název')
            ->setAttribute("class","form-control");
        $form->addTextArea("description", "Popisek")
            ->setAttribute("class","form-control");
        $form->addHidden("users_id", $this->user->id);
        $form->addUpload('file', 'Nahrát obrázek:')
            ->setAttribute("class","form-control")
            ->setRequired('Vyberte obrázek')
            ->addRule(UI\Form::FILLED, 'Vyberte obrázek')
            ->addRule(UI\Form::IMAGE, 'Obrázek musí být ve formátu JPEG nebo PNG.');
        $form->addSubmit('submit', 'Uložit');
    
        $form->onSuccess[] = [$this,'flowerAddFormSucceeded'];
        return $form;
    }

    public function flowerAddFormSucceeded(UI\Form $form, $values)
    {
        if ($values->description == null){
            $this->flashMessage('Vyplněte prosím popisek k pivoňce.', 'alert-warning');
            $this->redirect('this');
        }

        if($values->file) {
            $doc = $values->file;
            $fullPath = "img/flowers/".rand(10,50000) ."-". $values->file->name;
            $doc->move($fullPath);
            $image = Image::fromFile($fullPath);

            if ($image->height < $image->width){
                unlink($fullPath);
                $this->flashMessage('Obrázek musí být orientován na výšku', 'alert-warning');
                $this->redirect('this');
            }

            if ($image->height < 600 || $image->width < 400){
                unlink($fullPath);
                $this->flashMessage('Rozměry obrázku musí být minimálně 400x600', 'alert-warning');
                $this->redirect('this');
            }

            $image->resize(400, 600);
            unlink($fullPath);
            $image->save($fullPath);
            $this->flowerModel->saveFlower($values);
            $this->flashMessage('Pivoňka byla poslána k spracování', 'alert-success');
            $this->redirect('this');
        }

        $this->flashMessage('Chyba', 'alert-danger');
        $this->redirect('this');
    }
}
