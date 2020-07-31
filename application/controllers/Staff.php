<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Staff extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Staff_model', 'staff');
    }

    public function index() {
        $this->load->view('staff/index');
    }

    public function getStaffListing(){
        $json = array();
        $list = $this->staff->getStaffList();
        $data = array();
        foreach ($list as $element) {
            $row = array();
            $row[] = $element['id'];
            $row[] = $element['title'];
            $row[] = $element['content'];
            $data[] = $row;
        }
        $json['data'] = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->staff->countAll(),
            "recordsFiltered" => $this->staff->countFiltered(),
            "data" => $data,
        );
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json['data']);
    }
    public function save() {
        $json = array();
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        if(empty(trim($title))){
            $json['error']['title'] = 'Please enter title';
        }

        if(empty(trim($content))){
            $json['error']['content'] = 'Please enter content address';
        }

        if(empty($json['error'])){
            $this->staff->settitle($title);
            $this->staff->setcontent($content);
            try {
                $last_id = $this->staff->createStaff();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }

            if (!empty($last_id) && $last_id > 0) {
                $staffID = $last_id;
                $this->staff->setStaffID($staffID);
                $staffInfo = $this->staff->getStaff();
                $json['staff_id'] = $staffInfo['id'];
                $json['title'] = $staffInfo['title'];
                $json['content'] = $staffInfo['content'];
                $json['status'] = 'success';
            }
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
    public function edit() {
        $json = array();
        $staffID = $this->input->post('staff_id');
        $this->staff->setStaffID($staffID);
        $json['staffInfo'] = $this->staff->getStaff();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('staff/popup/renderEdit', $json);
    }
    public function update() {
        $json = array();
        $staff_id = $this->input->post('staff_id');
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        if(empty(trim($title))){
            $json['error']['title'] = 'Please enter title';
        }

        if(empty(trim($content))){
            $json['error']['content'] = 'Please enter content address';
        }

        if(empty($json['error'])){
            $this->staff->setStaffID($staff_id);
            $this->staff->settitle($title);
            $this->staff->setcontent($content);
            try {
                $last_id = $this->staff->updateStaff();;
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }

            if (!empty($staff_id) && $staff_id > 0) {
                $this->staff->setStaffID($staff_id);
                $staffInfo = $this->staff->getStaff();
                $json['staff_id'] = $staffInfo['id'];
                $json['title'] = $staffInfo['title'];
                $json['content'] = $staffInfo['content'];
                $json['status'] = 'success';
            }
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
    public function display() {
        $json = array();
        $staffID = $this->input->post('staff_id');
        $this->staff->setStaffID($staffID);
        $json['staffInfo'] = $this->staff->getStaff();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('staff/popup/renderDisplay', $json);
    }
    public function delete() {
        $json = array();
        $staffID = $this->input->post('staff_id');
        $this->staff->setStaffID($staffID);
        $this->staff->deleteStaff();
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
}
