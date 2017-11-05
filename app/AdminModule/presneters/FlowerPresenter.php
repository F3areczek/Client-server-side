<?php

namespace App\AdminModule\Presenters;

use Nette,
    Ublaboo\DataGrid\DataGrid,
    Nette\Application\UI,
    App\Model;


class FlowerPresenter extends BasePresenter
{

    private $flowerModel;

    function __construct(\Flower $flowerModel) {
        $this->flowerModel = $flowerModel;
    }

    public function renderDetail($id){
        $flower = $this->flowerModel->getFlower($this->presenter->getParameter('id'));
        $this->template->flower = $flower;
    }

    public function createComponentFlowerGrid($name)
	{
		$grid = new DataGrid($this, $name);

        $grid->setDataSource($this->flowerModel->getFlowers());
        $grid->addColumnText('file', 'Obrázek')
             ->setTemplate('/srv/kitlab.pef.czu.cz/groups/1718zs/ete32e/09/app/AdminModule/templates/Flower/gridImage.latte');
        $grid->addColumnText('description', 'Popisek')
             ->setTemplate('/srv/kitlab.pef.czu.cz/groups/1718zs/ete32e/09/app/AdminModule/templates/Flower/gridDescription.latte');
        $grid->addColumnText('name', 'Název')->setSortable();
        $grid->addColumnText('author', 'Autor')->setSortable();
        $grid->addColumnText('accepted', 'Schváleno')
                ->setReplacement([
                    0 => 'Ne',
                    1 => 'Ano'
                ]);
        $grid->addFilterSelect('accepted', 'Schváleno:', ['' => 'Vše', 0 => 'Ne', 1 => 'Ano']);

        $grid->addAction('approve', 'Schválit', 'activeFlower!')
            ->setTitle('Schválit')
            ->setClass('btn btn-xs btn-success ajax')
            ->setConfirm('Opravdu chcete schválit tuto pivoňku?');

        $grid->allowRowsAction('approve', function($item) {
            return $item->accepted == 0;
        });

        $grid->addAction('detail', '', 'detail')
            ->setIcon('sun-o')
            ->setTitle('Detail');
    }

    public function handleActiveFlower($id){
        $this->flowerModel->updateFlower($id, array("accepted" => 1));
        $this->flashMessage('Květina byla schválena', 'success');
        $this->redirect('this');
    }

    protected function createComponentEditFlowerForm()
    {
        $flower = $this->flowerModel->getFlower($this->presenter->getParameter('id'));

        $form = new UI\Form;
        $form->addHidden("id", $flower->id);
        $form->addText("name", "Název")
            ->setRequired('Vyplňte název')
            ->setDefaultValue($flower->name)
            ->setAttribute("class","form-control");
        $form->addTextArea("description", "Popisek")
            ->setDefaultValue($flower->description)
            ->setAttribute("class","form-control");
        $form->addSubmit('submit', 'Uložit')
            ->setAttribute('class', 'btn btn-success');
    
        $form->onSuccess[] = [$this,'flowerEditFormSucceeded'];
        return $form;
    }

    public function flowerEditFormSucceeded(UI\Form $form, $values)
    {
        $this->flowerModel->updateFlower($values->id, $values);
        $this->flashMessage('Květina byla upravena', 'success');
        $this->redirect('default');
    }
}
