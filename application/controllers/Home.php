<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    private static $viewData = [];

    function __construct()
    {
        parent::__construct();

        self::$viewData['pageInfo'] = (object)[
            'title' => $this->lang->line('home_page'),
        ];
    }

    public function index()
    {
        $this->myhelper->output('home', self::$viewData);
    }
}
