<?php

/**
 * Home_model
 */
class Home_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    public function check_user($email,$password){
        $where = "password='$password' AND email='$email' ";
        $sql = $this->db->where($where)->get('k_user');
        if ($sql->num_rows() > 0) {

            $result = $sql->result();
            // return $result;
            return $result;

        } else {
            return false;
        }
    }

    public function user_table(){
        $sql = $this->db->get('a_user');
        if ($sql->num_rows() > 0) {
            $result = $sql->result();
            return $result;
        } else {
            return false;
        }
    }

    public function create($data){
        $sql = $this->db->insert('k_post',$data);

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }


    public function setStaffID($staffID) {
        $this->_staffID = $staffID;
    }
    public function settitle($title) {
        $this->_title = $title;
    }
    public function setcontent($content) {
        $this->_content = $content;
    }
    var $table = 'k_post';
    var $column_order = array(null, 's.title','s.content');
    var $column_search = array('s.title','s.content');
    var $order = array('id' => 'DESC');

    private function getQuery(){
        if(!empty($this->input->post('title'))){
            $this->db->like('s.title', $this->input->post('title'), 'both');
        }
        if(!empty($this->input->post('content'))){
            $this->db->like('s.content', $this->input->post('content'), 'both');
        }
        $this->db->select(array('s.id', 's.title','s.content'));
        $this->db->from('k_post as s');
        $i = 0;
        foreach ($this->column_search as $item){
            if(!empty($_POST['search']['value'])){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if(!empty($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(!empty($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function getStaffList() {
        $this->getQuery();
        if(!empty($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        } else {
            $_POST['length']= $_POST['length'];
        }
        if(!empty($_POST['start']) && $_POST['start'] > 1) {
        $_POST['start']= $_POST['start'];
        }
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function countFiltered(){
        $this->getQuery();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countAll(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function createStaff() {
        $data = array(
            'title' => $this->_title,
            'content' => $this->_content,
        );
        $this->db->insert('k_post', $data);
        return $this->db->insert_id();
    }
    public function updateStaff() {
        $data = array(
            'title' => $this->_title,
            'content' => $this->_content,
        );
        $this->db->where('id', $this->_staffID);
        $this->db->update('k_post', $data);
    }
    public function getStaff() {
        $this->db->select(array('s.id', 's.title', 's.content'));
        $this->db->from('k_post s');
        $this->db->where('s.id', $this->_staffID);
        $query = $this->db->get();
       return $query->row_array();
    }
    public function deleteStaff() {
        $this->db->where('id', $this->_staffID);
        $this->db->delete('k_post');
    }

}


?>
