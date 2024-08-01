<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Follow model class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

class Naver_review_model extends CB_Model
{

	/**
	 * 테이블명
	 */
	public $_table = 'naver_goods';

	/**
	 * 사용되는 테이블의 프라이머리키
	 */
	public $primary_key = 'naver_goods_idx'; // 사용되는 테이블의 프라이머리키

	function __construct()
	{
		parent::__construct();
	}

	public function check_naver_goods_idx($naver_goods_idx)
	{
        return $this->db->where($this->primary_key, $naver_goods_idx)->get($this->_table)->result_array();
	}

    public function reg_naver_goods_data($naver_goods_datas)
    {
        // 데이터를 SQL 값 문자열로 변환
        $values = array();
        foreach ($naver_goods_datas as $row) {
            $values[] = '("' . implode('", "', array_map([$this->db, 'escape_str'], $row)) . '")';
        }

        // 필드 이름을 가져오기 위해 첫 번째 행 사용
        $fields = array_keys($naver_goods_datas[0]);

        // 필드 이름을 백틱(`)으로 감싸기
        $fields = array_map(function($field) {
            return "`$field`";
        }, $fields);

        $_table = "cb_{$this->_table}";
        // SQL 쿼리 작성
        $sql = 'INSERT IGNORE INTO ' . $_table . ' (' . implode(', ', $fields) . ') VALUES ' . implode(', ', $values);

        // 쿼리 실행
        $this->db->query($sql);
    }
}
