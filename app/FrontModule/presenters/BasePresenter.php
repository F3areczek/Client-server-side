<?php

namespace App\FrontModule\Presenters;

use Nette;


class BasePresenter extends Nette\Application\UI\Presenter
{
    function startup() {
        parent::startup();
    }
    public function beforeRender() {
        parent::beforeRender();
        $this->template->thisYear = date("Y");
    }
}
