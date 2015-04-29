<?php
/**
 * Created by PhpStorm.
 * User: leafrainy
 * Date: 15-4-26
 * Time: 下午5:59
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller{

    public function index(){
        $this->load->view('admin/index.html');
    }

    public function info(){
        $this->load->view('admin/info.html');
    }

    /*
     * 修改密码
     */
    public function change(){
        $this->load->view('admin/changepw.html');

    }
    /*
     *
     * 修改密码动作
     */
    public function changepw(){
        $this->load->model('login_model','login');
        /*
         * 比较原始密码
         */
        $username=$this->session->userdata('username');
        $userData=$this->login->check_user($username);

        $passwd=$this->input->post('passwd');
        if(md5($passwd) != $userData[0]['passwd'] ||$passwd==null) {
            echo "<script type='text/javascript'>alert('原始密码错误');window.history.back();</script>";die;
        }


        $passwdS=$this->input->post('passwdS');

        $passwdF=$this->input->post('passwdF');

        if($passwdS != $passwdF || $passwdS==null || $passwdF==null){
            echo "<script type='text/javascript'>alert('两次密码不相同');window.history.back();</script>";die;

        }
        /*
         * 修改密码
         */
        $uid=$this->session->userdata('uid');
        $data=array(
            'passwd'=>md5($passwdF),

        );
        $this->login->changepw($uid,$data);
        success('admin/admin/change','修改密码成功');


    }
}