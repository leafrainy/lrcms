<?php
/**
 * Created by PhpStorm.
 * User: leafrainy
 * Date: 15-4-27
 * Time: 下午1:50
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller{
    /*
     * 构造函数 载入模型
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('category_model','cate');

    }

    /*
     * 查看栏目
     */
    public function index(){

        $data['category']=$this->cate->check();
        $this->load->view('admin/category.html',$data);

    }
    /*
     * 添加栏目
     */
    public function add_cate(){
        //$this->output->enable_profiler(TRUE);
        $this->load->helper('form');
        $this->load->view('admin/add_category.html');

    }
    /*
     * 添加动作
     */
    public function add(){

        $this->load->library('form_validation');
        $status=$this->form_validation->run('cate');

        if($status){
            $data=array(
                'cname'=>$this->input->post('cname')
            );
            $this->cate->add($data);
            success('admin/category/index','添加栏目成功');
        }else{
            $this->load->helper('form');
            $this->load->view('admin/add_category.html');
        }
    }
    /*
     * 编辑栏目
     */
    public function edit_cate(){
        $cid=$this->uri->segment(4);
        $data['category']=$this->cate->check_cate($cid);
        $this->load->helper('form');
        $this->load->view('admin/edit_category.html',$data);

    }
    /*
     * 编辑栏目动作
     */
    public function edit(){

        $this->load->library('form_validation');
        $status=$this->form_validation->run('cate');

        if($status){
            $cid= $this->input->post('cid');
            $cname=$this->input->post('cname');
            $data=array(
                'cname'=>$cname

            );
            $data['category']=$this->cate->update_cate($cid,$data);
            success('admin/category/index','修改栏目成功');

        }else{
            $this->load->helper('form');
            $this->load->view('admin/edit_category.html');
        }

    }
    /*
     * 删除栏目
     */
    public function del(){
        $cid=$this->uri->segment(4);
        $this->cate->del($cid);
        success('admin/category/index','删除栏目成功');
    }
    /*
     * 调取栏目
     */
    public function limit_category($limit){
        $data=$this->db->limit($limit)->get('category')->result_array();
        return $data;

    }

}