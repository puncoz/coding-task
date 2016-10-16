<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 *   Myhelper Model.
 */
class Myhelper extends CI_Model
{
    public function __construct()
    {
        $time_zone = $this->config->item('default_timezone');
        date_default_timezone_set($time_zone);
    }

    public function output($page, $viewData = [], $layout = 'layout.index')
    {
        if (!is_null($page)) {
            $viewData['main_body_content'] = $this->load->view('pages/'.$page, $viewData, true);
        }
        $this->load->view(TMPL.'/'.$layout.'.php', $viewData);
    }

    public function outputJSON($array, $header_status = 200)
    {
        $this->output
             ->set_status_header($header_status)
             ->set_content_type('application/json', 'utf-8')
             ->set_output(json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
             ->_display();
        exit();
    }

    public function getFormError()
    {
        $form_errors = [];
        foreach ($_POST as $key => $value) {
            $errMsg = form_error($key);
            if (!empty($errMsg)) {
                $form_errors[] = [
                                    'id'        => $key,
                                    'message'   => $errMsg,
                                ];
            }
        }
        $form_errors[] = [
                            'id'        => $this->security->get_csrf_token_name(),
                            'message'   => $this->security->get_csrf_hash(),
                        ];

        return [
            'status'    => 'error',
            'data'      => $form_errors,
            'message'   => 'form_error',
        ];
    }
}
