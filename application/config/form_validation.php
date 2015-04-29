<?php
/**
 * Created by PhpStorm.
 * User: leafrainy
 * Date: 15-4-27
 * Time: 上午11:05
 */
$config = array(
    'write' => array(
        array(
            'field' => 'title',
            'label' => '标题',
            'rules' => 'required|min_length[5]'
        ),
        array(
            'field' => 'cid',
            'label' => '栏目',
            'rules' => 'integer',
        ),
        array(
            'field' => 'info',
            'label' => '摘要',
            'rules' => 'required|max_length[255]',
        ),
        array(
            'field' => 'content',
            'label' => '内容',
            'rules' => 'required|max_length[2000]'
        ),
    ),
    'cate' => array(
        array(
            'field' =>'cname',
            'label' => '栏目名称',
            'rules' => 'required|max_length[20]'
      ),
    ),
);