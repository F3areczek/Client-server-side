<?php

namespace App\AdminModule\Presenters;

use Nette;


class HomepagePresenter extends BasePresenter
{

    private $userModel;

    function __construct(\User $userModel) {
        $this->userModel = $userModel;
    }

    public function renderCreatedSiteMap() {
        $this->userModel->createSitemap();
        $this->template->sitemap = file_get_contents('sitemap.xml');
    }
}
