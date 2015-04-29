<?php
/**
 * Created by PhpStorm.
 * User: leafrainy
 * Date: 15-4-27
 * Time: 上午11:14
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('article_model','art');
        $this->load->model('category_model','cate');


    }
    /*
     * 查看文章
     */
    public function index(){
        /*
         * 载入分页类
         */
        $this->load->library('pagination');
        $perPage=3;

        $config['base_url']=site_url('admin/article/index');
        $config['total_rows']=$this->db->count_all_results('article');
        $config['per_page']=$perPage;
        $config['uri_segment']=4;
        $config['first_link']='首页';
        $config['prev_link']='上一页';
        $config['next_link']='下一页';
        $config['last_link']='末页';

        $this->pagination->initialize($config);
        $data['links']=$this->pagination->create_links();
        $offset=$this->uri->segment(4);
        $this->db->limit($perPage,$offset);
        $data['article']=$this->art->art_cate();
        $this->load->view('admin/article.html',$data);

    }

    public function send_article(){
        $data['category']=$this->cate->check();
        $this->load->helper('form');
        $this->load->view('admin/write.html',$data);
    }

    /*
     * 发表文章动作
     */
    public function send(){

        $this->load->library('form_validation');
        $status = $this->form_validation->run('write');


        if($status){
            $data=array(
                'title' => $this->input->post('title'),
                'cid' => $this->input->post('cid'),
                'info' => $this->input->post('info'),
                'content' => $this->input->post('content'),
                'time' => time()
            );
            $this->art->add($data);
            success('admin/article/index','发表文章成功');
        }else{
            $this->load->helper('form');
            $this->load->view('admin/write.html');
        }
    }
    /*
     * 编辑文章
     */
    public function edit_article(){
        $aid=$this->uri->segment(4);
        $data['article']=$this->art->check_art($aid);
        $this->load->helper('form');
        $this->load->view('admin/edit_article.html',$data);

    }
    /*
     * 编辑动作
     */
    public function edit(){

        $this->load->library('form_validation');
        $status=$this->form_validation->run('write');

        if($status){
            $aid=$this->input->post('aid');
            $title=$this->input->post('title');
            $cid=$this->input->post('cid');
            $info=$this->input->post('info');
            $content=$this->input->post('content');

            $data= array(
                'title' => $title,
                'info'  => $info,
                'content'=> $content,
                'cid'=>$cid
            );
            $data['article']=$this->art->update_art($aid,$data);
            success('admin/article/index','修改文章成功');

        }else{
            $this->load->helper('form');
            $this->load->view('admin/edit_article.html');
        }
    }
    /*
     * 删除文章
     */
    public function del(){
        $aid=$this->uri->segment(4);
        $this->art->del($aid);
        success('admin/article/index','删除文章成功');
    }

}