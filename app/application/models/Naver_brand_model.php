<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Follow model class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */
class Naver_brand_model extends CB_Model
{

    /**
     * 테이블명
     */
    public $_table = 'naver_brand';

    /**
     * 사용되는 테이블의 프라이머리키
     */
    public $primary_key = 'channel_no'; // 사용되는 테이블의 프라이머리키

    function __construct()
    {
        parent::__construct();
    }

    public function get_brand_list()
    {
        $select = array(
            "brand_nm"
          , "brand_cd"
          , "shop_type"
          , "COUNT(*) AS goods_cnt"
          , "created_at"
        );
        return $this->db->select($select)->group_by('brand_cd')->order_by('naver_goods_idx', 'desc')->get($this->_table)->result_array();
    }

    public function reg_brand($db)
    {
        $sql = "INSERT IGNORE INTO cb_naver_brand 
                            VALUES ('{$db['channel_no']}', '{$db['brand_cd']}', '{$db['brand_nm']}', '{$db['shop_type']}', NOW())";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function get_goods_list($data)
    {
        // brand_cd와 naver_goods_idx가 없을 경우 전체 리뷰 갱신
        if (!$data['brand_cd'] && !$data['product_no']) {
//            return $this->db->where('DATE(updated_at) !=', date('Y-m-d'))->order_by('channel_no', 'asc')->get('cb_naver_goods')->result_array();
            return $this->db->order_by('channel_no', 'asc')->get('cb_naver_goods')->result_array();
        }
        // 해당 브랜드 전체 리뷰 갱신
        else if ($data['brand_cd'] && !$data['product_no']) {
            return $this->db->where('brand_cd', $data['brand_cd'])->order_by('channel_no', 'asc')->get('cb_naver_goods')->result_array();
        }
        // 특정 상품 갱신
        else if ($data['brand_cd'] && $data['product_no']) {
            return $this->db->where('product_no', $data['product_no'])->get('cb_naver_goods')->result_array();
        }
    }
}
