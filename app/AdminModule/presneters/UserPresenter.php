<?php

namespace App\AdminModule\Presenters;

use Nette,
    Ublaboo\DataGrid\DataGrid,
    App\Model;


class UserPresenter extends BasePresenter
{

    private $userModel;

    function __construct(\User $userModel) {
        $this->userModel = $userModel;
    }

    public function createComponentUserGrid($name)
	{
		$grid = new DataGrid($this, $name);

        $grid->setDataSource($this->userModel->getUsers());
        $grid->addColumnText('name', 'Jméno')->setSortable();
        $grid->addColumnText('email', 'Email')->setSortable();
        $grid->addColumnStatus('role', 'Role')
                ->addOption('guest', 'guest')
                    ->setClass('btn-success ajax')
                    ->endOption()
                ->addOption('admin', 'admin')
                    ->setClass('btn-primary ajax')
                    ->endOption()
                ->onChange[] = [$this, 'changeExampleStatus'];


        $grid->addInlineEdit()
            ->onControlAdd[] = function($container) {
                $container->addText('name', '');
                $container->addText('email', '');
            };
    
        $grid->getInlineEdit()->onSetDefaults[] = function($container, $item) {
            $container->setDefaults([
                'name' => $item->name,
                'email' => $item->email,
            ]);
        };
    
        $grid->getInlineEdit()->onSubmit[] = function($id, $values) {
            $this->userModel->updateUser($id, $values);
            $this->flashMessage('Uživatel byl upraven', 'success');
            $this->redirect('this');
        };
    }
    
    public function changeExampleStatus($id, $new_status){
        $this->userModel->updateRole($id,$new_status);
        $this->redirect('this');
    }
}
