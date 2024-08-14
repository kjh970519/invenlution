<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *--------------------------------------------------------------------------
 *Admin Page 에 보일 메뉴를 정의합니다.
 *--------------------------------------------------------------------------
 *
 * Admin Page 에 새로운 메뉴 추가시 이곳에서 수정해주시면 됩니다.
 *
 */


$config['admin_page_menu']['additional'] =
	array(
		'__config'					=> array('추가설정', 'fa-gears'),
		'menu'						=> array(
			'naver_review'			=> array('네이버 리뷰', ''),
			'instagram'			=> array('인스타그램', ''),
		),
	);
