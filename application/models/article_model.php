<?php
/**
 * Created by PhpStorm.
 * User: leafrainy
 * Date: 15-4-27
 * Time: 下午7:42
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * 文章管理模型
 */
class Article_model extends CI_Model{

    /*
     * 发表文章
     */
    public function add($data){
        $this->db->insert('article',$data);

    }
    /*
     * 查看文章
     */
    public function art_cate(){
        $data=$this->db->select('aid,title,cname,time')->from('article')->join('category','article.cid=category.cid')->order_by('aid','desc')->get()->result_array();
        return $data;

    }
    /*
     * 首页查询文章
     */
    public function check(){
        $data=$this->db->select('aid,title,info')->order_by('time','desc')->get_where('article')->result_array();
        return $data;

    }
    /*
     * 通过aid调取文章
     */
    public function aid_article($aid){
        $data=$this->db->join('category','article.cid=category.cid')->get_where('article',array('aid'=>$aid))->result_array();
        return $data;

    }
    /*
     * 查询对应的文章
     */
    public function check_art($aid){
        $data=$this->db->select('aid,title,cid,info,content')->get_where('article',array('aid'=>$aid))->result_array();
        return $data;

    }
    /*
     * 修改文章
     */
    public function update_art($aid,$data){
        $this->db->update('article',$data,array('aid'=>$aid));
    }
    /*
     * 删除文章
     */
    public function del($aid){
        $this->db->delete('article',array('aid'=>$aid));
    }

}
