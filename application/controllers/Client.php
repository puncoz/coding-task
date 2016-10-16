<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    private static $viewData = [];

    public function __construct()
    {
        parent::__construct();

        self::$viewData['pageInfo'] = (object) [
            'title' => $this->lang->line('client_page'),
        ];

        $this->load->model('clientmodel');
    }

    public function index()
    {
        redirect('client/lists', 'refresh');
    }

    public function lists()
    {
        $clients = $this->clientmodel->getClients();
        $per_page = 5;

        if ($clients !== false) {
            $this->load->library('pagination');

            $config = [
                'base_url'              => base_url('client/lists'),
                'total_rows'            => count($clients),
                'per_page'              => $per_page,
                'use_global_url_suffix' => true,
                'full_tag_open'         => '<ul class="pagination">',
                'full_tag_close'        => '<li class="deadlink"><a><strong>1-10</strong> out of <strong>1002</strong> clients. </a></li></ul>',
                'first_link'            => false,
                'last_link'             => false,
                'first_tag_open'        => '<li>',
                'first_tag_close'       => '</li>',
                'prev_link'             => '<span aria-hidden="true">&laquo;</span>',
                'prev_tag_open'         => '<li class="prev">',
                'prev_tag_close'        => '</li>',
                'next_link'             => '<span aria-hidden="true">&raquo;</span>',
                'next_tag_open'         => '<li>',
                'next_tag_close'        => '</li>',
                'last_tag_open'         => '<li>',
                'last_tag_close'        => '</li>',
                'cur_tag_open'          => '<li class="active"><a href="javascript:;">',
                'cur_tag_close'         => '</a></li>',
                'num_tag_open'          => '<li>',
                'num_tag_close'         => '</li>',
            ];

            self::$viewData['start'] = $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $from = $start + 1;
            $to = $start + $config['per_page'];
            $to = ($to > $config['total_rows']) ? $config['total_rows'] : $to;
            $config['full_tag_close'] = '<li class="deadlink"><a><strong>'.$from.'-'.$to.'</strong> out of <strong>'.$config['total_rows'].'</strong> clients. </a></li></ul>';
            $this->pagination->initialize($config);

            self::$viewData['pagination'] = $this->pagination->create_links();
            self::$viewData['clients'] = array_slice($clients, $start, $config['per_page']);
        } else {
            self::$viewData['clients'] = [];
            self::$viewData['start'] = 0;
        }

        $this->myhelper->output('client/list', self::$viewData);
    }

    public function add()
    {
        $response = [];
        if ($this->input->is_ajax_request()) {
            if (strtolower($this->input->server('REQUEST_METHOD')) == 'post') {
                $this->form_validation->set_rules('NAME', 'Name', 'required');
                $this->form_validation->set_rules('GENDER', 'Gender', 'required');
                $this->form_validation->set_rules('PHONE', 'Phone', 'required');
                $this->form_validation->set_rules('EMAIL', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('DEF_CONTACT', 'Default Contact', 'required');
                $this->form_validation->set_rules('ADDRESS', 'Address', 'required');
                $this->form_validation->set_rules('NATIONALITY', 'Nationality', 'required');
                $this->form_validation->set_rules('DOB', 'Date of birth', 'required');
                $this->form_validation->set_rules('EDUCATION', 'Education', 'required');

                if ($this->form_validation->run() === false) {
                    // validation failed
                    $response = $this->myhelper->getFormError();
                } else {
                    // validation success

                    // Save Information in csv
                    $insertData = [
                            'NAME'          => $this->input->post('NAME'),
                            'GENDER'        => $this->input->post('GENDER'),
                            'PHONE'         => $this->input->post('PHONE'),
                            'EMAIL'         => $this->input->post('EMAIL'),
                            'DEF_CONTACT'   => $this->input->post('DEF_CONTACT'),
                            'ADDRESS'       => $this->input->post('ADDRESS'),
                            'NATIONALITY'   => $this->input->post('NATIONALITY'),
                            'DOB'           => $this->input->post('DOB'),
                            'EDUCATION'     => $this->input->post('EDUCATION'),
                        ];

                    $result = $this->clientmodel->addClient($insertData);
                    if (!$result) {
                        $this->session->set_flashdata('error_msg', $this->lang->line('add_error'));
                        $response = [
                            'status'    => 'error',
                            'data'      => null,
                            'message'   => $this->lang->line('add_error'),
                        ];
                    } else {
                        $this->session->set_flashdata('success_msg', $this->lang->line('add_success'));
                        $response = [
                            'status'    => 'ok',
                            'data'      => null,
                            'message'   => 'success',
                        ];
                    }
                }
            } else {
                // load form
                $form = $this->load->view('pages/client/form', self::$viewData, true);
                $response = [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => $form,
                ];
            }

            $this->myhelper->outputJSON($response);
        } else {
            show_error($this->lang->line('direct_scripts_access'));
        }
    }

    public function edit()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->uri->segment(3);
            if (empty($id)) {
                $response = [
                                'status'    => 'error',
                                'data'      => null,
                                'message'   => $this->lang->line('invalid_request'),
                            ];
                $this->myhelper->outputJSON($response);
            }
            $id = url_decrypt($id);

            if (strtolower($this->input->server('REQUEST_METHOD')) == 'post') {
                $this->form_validation->set_rules('NAME', 'Name', 'required');
                $this->form_validation->set_rules('GENDER', 'Gender', 'required');
                $this->form_validation->set_rules('PHONE', 'Phone', 'required');
                $this->form_validation->set_rules('EMAIL', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('DEF_CONTACT', 'Default Contact', 'required');
                $this->form_validation->set_rules('ADDRESS', 'Address', 'required');
                $this->form_validation->set_rules('NATIONALITY', 'Nationality', 'required');
                $this->form_validation->set_rules('DOB', 'Date of birth', 'required');
                $this->form_validation->set_rules('EDUCATION', 'Education', 'required');

                $response = [];
                if ($this->form_validation->run() === false) {
                    // validation failed
                    $response = $this->utility_model->getFormError();
                } else {
                    // validation success
                    $this->session->set_flashdata('error_msg', $this->lang->line('service_unavail'));
                    $response = [
                        'status'    => 'error',
                        'data'      => null,
                        'message'   => $this->lang->line('service_unavail'),
                    ];
                }
            } else {
                // load form
                self::$viewData['id'] = $id;
                self::$viewData['edit'] = $this->clientmodel->getClientById($id);
                $form = $this->load->view('pages/client/form', self::$viewData, true);
                $response = [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => $form,
                ];
            }
            $this->myhelper->outputJSON($response);
        } else {
            show_error($this->lang->line('direct_scripts_access'));
        }
    }

    public function delete()
    {
        $this->session->set_flashdata('error_msg', $this->lang->line('service_unavail'));
        redirect('client/lists', 'refresh');
    }
}
