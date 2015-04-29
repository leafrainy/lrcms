<?php
/**
 * Created by PhpStorm.
 * User: leafrainy
 * Date: 15-4-28
 * Time: 上午10:08
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{

    public function check(){
        $data = $this->db->get('admin')->result_array();
        return $data;
    }
    /*
     * 查询后台用户
     */
    public function check_user($username){
        //$data=$this->db->where(array('username'=>$username))->get('admin')->result_array();
        $data=$this->db->get_where('admin',array('username'=>$username))->result_array();
        return $data;
    }
    /*
     * 修改密码
     */
    public function changepw($uid,$data){
        $this->db->update('admin',$data,array('uid'=>$uid));

    }
}