<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Naverreview class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 관리자>추가설정>네이버 리뷰 controller 입니다.
 */
class Naverreview extends CB_Controller
{

    /**
     * 관리자 페이지 상의 현재 디렉토리입니다
     * 페이지 이동시 필요한 정보입니다
     */
    public $pagedir = 'additional/naverreview';

    /**
     * 모델을 로딩합니다
     */
    protected $models = array('Naver_review');

    /**
     * 이 컨트롤러의 메인 모델 이름입니다
     */
    protected $modelname = 'Naver_review_model';

    /**
     * 헬퍼를 로딩합니다
     */
    protected $helpers = array('form', 'array');

    function __construct()
    {
        parent::__construct();

        /**
         * 라이브러리를 로딩합니다
         */
        $this->load->library(array('pagination', 'querystring'));
    }

    /**
     * 목록을 가져오는 메소드입니다
     */
    public function index()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_admin_additional_naverreview_index';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        /**
         * 페이지에 숫자가 아닌 문자가 입력되거나 1보다 작은 숫자가 입력되면 에러 페이지를 보여줍니다.
         */
        $param =& $this->querystring;
        $page = (((int)$this->input->get('page')) > 0) ? ((int)$this->input->get('page')) : 1;
        $findex = $this->input->get('findex') ? $this->input->get('findex') : $this->{$this->modelname}->primary_key;
        $forder = $this->input->get('forder', null, 'desc');
        $sfield = $this->input->get('sfield', null, '');
        $skeyword = $this->input->get('skeyword', null, '');

        $per_page = admin_listnum();
        $offset = ($page - 1) * $per_page;

        /**
         * 게시판 목록에 필요한 정보를 가져옵니다.
         */
        $this->{$this->modelname}->allow_search_field = array('brand_nm', 'naver_goods_nm', 'naver_goods_idx', 'created_at'); // 검색이 가능한 필드
        $this->{$this->modelname}->search_field_equal = array(''); // 검색중 like 가 아닌 = 검색을 하는 필드
        $this->{$this->modelname}->allow_order_field = array('created_at'); // 정렬이 가능한 필드
        $result = $this->{$this->modelname}
            ->get_admin_list($per_page, $offset, '', '', $findex, $forder, $sfield, $skeyword);
        $view['view']['data'] = $result;

        /**
         * primary key 정보를 저장합니다
         */
        $view['view']['primary_key'] = $this->{$this->modelname}->primary_key;

        /**
         * 페이지네이션을 생성합니다
         */
        $config['base_url'] = admin_url($this->pagedir) . '?' . $param->replace('page');
        $config['total_rows'] = $result['total_rows'];
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $view['view']['paging'] = $this->pagination->create_links();
        $view['view']['page'] = $page;

        /**
         * 쓰기 주소, 삭제 주소등 필요한 주소를 구합니다
         */
        $search_option = array('brand_nm' => '브랜드', 'naver_goods_nm' => '네이버 상품명', 'naver_goods_idx' => '네이버 상품코드', 'created_at' => '등록일시');
        $view['view']['skeyword'] = ($sfield && array_key_exists($sfield, $search_option)) ? $skeyword : '';
        $view['view']['search_option'] = search_option($search_option, $sfield);
        $view['view']['listall_url'] = admin_url($this->pagedir);
        $view['view']['write_url'] = admin_url($this->pagedir . '/write');
        $view['view']['list_update_url'] = admin_url($this->pagedir . '/listupdate/?' . $param->output());
        $view['view']['list_delete_url'] = admin_url($this->pagedir . '/listdelete/?' . $param->output());

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

        /**
         * 어드민 레이아웃을 정의합니다
         */
        $layoutconfig = array('layout' => 'layout', 'skin' => 'index');
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }

    public function checkNaverGoodsIdx($naver_goods_idx)
    {
        $finResult = array(
            "status" => "ok",
        );
        $result = $this->{$this->modelname}->check_naver_goods_idx($naver_goods_idx);
        if (count($result) > 0) {
            $finResult['status'] = "fail";
        }

        echo json_encode($finResult);
    }

    public function getNaverGoodsData()
    {
        $finResult = array(
            "status" => "ok",
        );
        $naver_store_url = $this->input->get_post('naver_store_url');

        $headers = [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
            'Sec-Ch-Ua: "Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'
        ];

        // HTTP 컨텍스트 옵션 설정
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => implode("\r\n", $headers)
            ]
        ];

        // 스트림 컨텍스트 생성
        $context = stream_context_create($options);

        // API 호출
        $finResult['html'] = file_get_contents($naver_store_url, false, $context);

        if (!$finResult['html']) {
            $finResult['status'] = "fail";
        }
        echo json_encode($finResult);
    }

    public function regNaverGoodsData()
    {
        $finResult = array(
            "status" => "ok",
        );
        $naver_goods_datas = $this->input->post('naver_goods_datas');
        $this->{$this->modelname}->reg_naver_goods_data($naver_goods_datas);

        echo json_encode($finResult);
    }

    public function getNaverGoodsAllUrl()
    {
        $finResult = array(
            "status" => "ok",
        );
        $naver_store_url = $this->input->post('naver_store_url');
        $finResult['html'] = file_get_contents($naver_store_url);

        if (!$finResult['html']) {
            $finResult['status'] = "fail";
        }
        echo json_encode($finResult);
    }

    public function getNaverGoodsList()
    {
        $finResult = array(
            "status" => "ok",
        );
        $shop_type = $this->input->post('shop_type');
        $naver_all_goods_url = $this->input->post('naver_all_goods_url');
        $channel_uid = $this->input->post('channel_uid');
        $params = http_build_query($this->input->post('params'));

        $url = "https://brand.naver.com/n/v2/channels/{$channel_uid}/categories/ALL/products?{$params}";
        if ($shop_type == 'smartstore') {
            $url = "https://smartstore.naver.com/i/v2/channels/{$channel_uid}/categories/ALL/products?{$params}";
        }

        $headers = [
            "Accept: application/json, text/plain, */*",
            "Referer: {$naver_all_goods_url}"
        ];

        // HTTP 컨텍스트 옵션 설정
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => implode("\r\n", $headers)
            ]
        ];

        // 스트림 컨텍스트 생성
        $context = stream_context_create($options);

        // API 호출
        $response = file_get_contents($url, false, $context);
        $finResult['goods_lists'] = json_decode($response, true)['simpleProducts'];

        if (!$finResult['goods_lists']) {
            $finResult['status'] = "fail";
        }
        echo json_encode($finResult);
    }
}
