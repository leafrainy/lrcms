<?php
/**
 * Created by PhpStorm.
 * User: leafrainy
 * Date: 15-4-28
 * Time: 上午9:53
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

 //   public function __construct(){
  //      parent::__construct();
  //      $this->load->model('admin_model','admin');

   // }
    public function index(){
        $this->load->view('admin/login.html');

    }

    /*
     * 登陆
     */
    public function login_in(){

        $username = $this->input->post('username');
        $this->load->model('login_model','login');
        $userData=$this->login->check_user($username);
        $passwd = $this->input->post('passwd');

        if(!$userData || $userData[0]['passwd']!=md5($passwd)) {
            echo "<script type='text/javascript'>alert('用户名或密码错误');window.history.back();</script>";
        }

        $sessionData=array(

            'username'=>$username,
            'uid'=>$userData[0]['uid'],
            'logintime'=>time()
        );

        $this->session->set_userdata($sessionData);
        success('admin/admin/index','登陆成功');




    }
    /*
     * 注销
     */
    public function login_out(){
        $this->session->sess_destroy();
        success('admin/login/index','退出成功');

    }
}