<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod');
    }

    public function index()
    {
        $data['title'] = 'Todo App';

        $data['getList'] = $this->Mod->select('list')->result();
        $this->load->view('public/index', $data);

    }

    public function add_todo(){
        $title  = $this->input->post('title');
        $desc   = $this->input->post('desc');

        if ($title == null) {
            $this->session->set_flashdata("flash","Title Can't Be Null, Try Again!");
            $this->session->set_flashdata("flash_show", "visible");
            $this->session->set_flashdata("flash_style", "text-red-500 fa-solid fa-x");
            $this->session->set_flashdata("flash_border", "border-red-500");
            redirect(base_url('/'));
        }
        
        if ($desc == null) {
            $this->session->set_flashdata("flash", "Description Can't Be Null, Try Again!");
            $this->session->set_flashdata("flash_show", "visible");
            $this->session->set_flashdata("flash_style", "text-red-500 fa-solid fa-x");
            $this->session->set_flashdata("flash_border", "border-red-500");
            redirect(base_url('/'));
        }

        $data = array(
            'list_title' => $title,
            'list_desc' => $desc,
            'list_status' => "0"
        );

        $this->Mod->add($data, 'list');
        $this->session->set_flashdata("flash", "Todo is Added To List, Success!");
        $this->session->set_flashdata("flash_show", "visible");
        $this->session->set_flashdata("flash_style", "text-green-500 fa-solid fa-check");
        $this->session->set_flashdata("flash_border", "border-green-500");
        redirect(base_url('/'));
    }

    function remove($list_id = null){
        if ($list_id == null) {
            redirect(base_url('/'));
        }
        else{
            // Check ID
            $where = "list_id='$list_id'";
            $list_check = $this->Mod->get('list', $where)->num_rows();
            // Delete Process
            if ($list_check == 1) {
                $this->Mod->del(array('list_id' => $list_id), 'list');
                $this->session->set_flashdata("flash", "Data is Deleted, Success!");
                $this->session->set_flashdata("flash_show", "visible");
                $this->session->set_flashdata("flash_style", "text-green-500 fa-solid fa-check");
                $this->session->set_flashdata("flash_border", "border-green-500");

                redirect(base_url('/'));
            }

            
        }

    }

    function update(){
        $id  = $this->input->post('list');
        $title  = $this->input->post('title');
        $desc   = $this->input->post('desc');

        if ($title == null) {
            $this->session->set_flashdata("flash", "Title Can't Be Null, Try Again!");
            $this->session->set_flashdata("flash_show", "visible");
            $this->session->set_flashdata("flash_style", "text-red-500 fa-solid fa-x");
            $this->session->set_flashdata("flash_border", "border-red-500");
            redirect(base_url('/'));
        }

        if ($desc == null) {
            $this->session->set_flashdata("flash", "Description Can't Be Null, Try Again!");
            $this->session->set_flashdata("flash_show", "visible");
            $this->session->set_flashdata("flash_style", "text-red-500 fa-solid fa-x");
            $this->session->set_flashdata("flash_border", "border-red-500");
            redirect(base_url('/'));
        }

        $data = array(
            'list_title' => $title,
            'list_desc' => $desc,
        );

        $this->Mod->upd(array('list_id' => $id), $data, 'list');

        $this->session->set_flashdata("flash", "Data Updated, Success!");
        $this->session->set_flashdata("flash_show", "visible");
        $this->session->set_flashdata("flash_style", "text-green-500 fa-solid fa-check");
        $this->session->set_flashdata("flash_border", "border-green-500");
        redirect(base_url('/'));


    }

    function finish($id = null){
        $id  = $this->input->post('id');

        $data = array(
            'list_status' => '1'
        );

        $this->Mod->upd(array('list_id' => $id), $data, 'list');

        $this->session->set_flashdata("flash", "Data Tag Finished, Success!");
        $this->session->set_flashdata("flash_show", "visible");
        $this->session->set_flashdata("flash_style", "text-green-500 fa-solid fa-check");
        $this->session->set_flashdata("flash_border", "border-green-500");
        redirect(base_url('/'));

    }

}/* End of file Main.php and path /application/controllers/Main.php */