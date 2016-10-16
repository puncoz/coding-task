<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    private static $viewData = [];

    public function __construct()
    {
        parent::__construct();

        self::$viewData['pageInfo'] = (object) [
            'title' => $this->lang->line('home_page'),
        ];
    }

    public function index()
    {
        $this->myhelper->output('home', self::$viewData);
    }
}
