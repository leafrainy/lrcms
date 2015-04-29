<?php
/**
 * Created by PhpStorm.
 * User: leafrainy
 * Date: 15-4-26
 * Time: 下午6:08
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model', 'art');
        $this->load->model('category_model', 'cate');
    }
        public function index(){
        //$this->output->cache(20/60);//缓存模式


            /*
             * 分页
             */
            $this->load->library('pagination');
            $perPage=3;

            $config['base_url']=site_url('index/home/index');
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
            $data['art']=$this->art->check();

        $this->load->view('index/index.html',$data);

    }
    /*
     * 文章阅读显示
     */
    public function article(){
        $aid=$this->uri->segment(2);
        $data['article']=$this->art->aid_article($aid);
        $this->load->view('index/article.html',$data);

    }
}
