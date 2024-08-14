<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Naver_review class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 관리자>추가설정>네이버 리뷰 controller 입니다.
 */
class Naver_review extends CB_Controller
{

    /**
     * 관리자 페이지 상의 현재 디렉토리입니다
     * 페이지 이동시 필요한 정보입니다
     */
    public $pagedir = 'additional/naver_review';

    /**
     * 모델을 로딩합니다
     */
    protected $models = array('Naver_brand', 'Naver_review');

    /**
     * 이 컨트롤러의 메인 모델 이름입니다
     */
    protected $modelname = 'Naver_brand_model';

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
        $eventname = 'event_admin_additional_naver_review_list';
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
        $forder = $this->input->get('forder', 'created_at', 'desc');
        $sfield = $this->input->get('sfield', null, '');
        $skeyword = $this->input->get('skeyword', null, '');

        $per_page = admin_listnum();
        $offset = ($page - 1) * $per_page;

        /**
         * 게시판 목록에 필요한 정보를 가져옵니다.
         */
        $this->{$this->modelname}->allow_search_field = array('brand_nm', 'brand_cd', 'naver_goods_nm', 'naver_goods_idx', 'created_at'); // 검색이 가능한 필드
        $this->{$this->modelname}->search_field_equal = array('brand_cd'); // 검색중 like 가 아닌 = 검색을 하는 필드
        $this->{$this->modelname}->allow_order_field = array('created_at'); // 정렬이 가능한 필드

        $select = array(
            "*"
          , "(select count(*) from cb_naver_goods where channel_no = cb_naver_brand.channel_no) as goods_cnt"
        );

        $result = $this->{$this->modelname}
            ->get_admin_list($per_page, $offset, '', '', $findex, $forder, $sfield, $skeyword, '', $select, '');

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
        $search_option = array('brand_nm' => '브랜드', 'brand_cd' => '브랜드 코드');
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
    public function list()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_admin_additional_naver_review_list';
        $this->load->event($eventname);

        $this->modelname = "Naver_review_model";

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        /**
         * 페이지에 숫자가 아닌 문자가 입력되거나 1보다 작은 숫자가 입력되면 에러 페이지를 보여줍니다.
         */
        $param =& $this->querystring;
        $page = (((int)$this->input->get('page')) > 0) ? ((int)$this->input->get('page')) : 1;
//        $findex = $this->input->get('findex') ? $this->input->get('findex') : $this->{$this->modelname}->primary_key;
        $findex = ['updated_at', 'created_at'];
//        $forder = $this->input->get('forder', null, 'desc');
        $forder = ['desc', 'desc'];
        $sfield = $this->input->get('sfield', null, '');
        $skeyword = $this->input->get('skeyword', null, '');

        $per_page = admin_listnum();
        $offset = ($page - 1) * $per_page;

        /**
         * 게시판 목록에 필요한 정보를 가져옵니다.
         */
        $this->{$this->modelname}->allow_search_field = array('brand_nm', 'brand_cd', 'naver_goods_nm', 'naver_goods_idx', 'created_at'); // 검색이 가능한 필드
        $this->{$this->modelname}->search_field_equal = array('brand_cd'); // 검색중 like 가 아닌 = 검색을 하는 필드
        $this->{$this->modelname}->allow_order_field = array('updated_at', 'created_at'); // 정렬이 가능한 필드
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
        $config['base_url'] = admin_url($this->pagedir) . '/list?' . $param->replace('page');
        $config['total_rows'] = $result['total_rows'];
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $view['view']['paging'] = $this->pagination->create_links();
        $view['view']['page'] = $page;

        /**
         * 쓰기 주소, 삭제 주소등 필요한 주소를 구합니다
         */
        $search_option = array('brand_nm' => '브랜드', 'brand_cd' => '브랜드 코드', 'naver_goods_nm' => '네이버 상품명', 'naver_goods_idx' => '네이버 상품코드', 'created_at' => '등록일시');
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
        $layoutconfig = array('layout' => 'layout', 'skin' => 'list');
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }

    public function checkNaverGoodsIdx($naver_goods_idx)
    {
        $this->modelname = "Naver_review_model";
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
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $naver_store_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $finResult['html'] = $response;

            if (curl_errno($ch)) {
                $finResult['error'] = 'cURL 오류: ' . curl_error($ch);
            }
        }

        if (!$finResult['html']) {
            $finResult['status'] = "fail";
        }

        echo json_encode($finResult);
    }

    public function regNaverGoodsData()
    {
        $this->modelname = "Naver_review_model";
        $finResult = array(
            "status" => "ok",
        );
        $naver_goods_datas = $this->input->post('naver_goods_datas');
        $this->{$this->modelname}->reg_naver_goods_data($naver_goods_datas);

        $data = array(
            "channel_no" => $naver_goods_datas[0]['channel_no'],
            "brand_cd" => $naver_goods_datas[0]['brand_cd'],
            "brand_nm" => $naver_goods_datas[0]['brand_nm'],
            "shop_type" => $naver_goods_datas[0]['shop_type'],
        );

        $this->modelname = "Naver_brand_model";
        $this->regBrand($data);

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
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $naver_store_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $finResult['html'] = curl_exec($ch);

            if (curl_errno($ch)) {
                $finResult['error'] = 'cURL 오류: ' . curl_error($ch);
            }
        }

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
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $finResult['goods_lists'] = json_decode($response, true)['simpleProducts'];

            if (curl_errno($ch)) {
                $finResult['error'] = 'cURL 오류: ' . curl_error($ch);
            }
        }

        if (!$finResult['goods_lists']) {
            $finResult['status'] = "fail";
        }

        echo json_encode($finResult);
    }

    public function regBrand($data=null)
    {
        $finResult = array(
            "status" => "ok",
        );

        $db = $this->input->post('data');
        if ($data) $db = $data;

        $result = $this->{$this->modelname}->reg_brand($db);
        if (!$result) {
            $finResult['status'] = "fail";
        }
        else {
            $finResult['data'] = $db;
        }

        if (!$data) {
            echo json_encode($finResult);
        }
    }

    public function regReview()
    {
        $finResult = array(
            "status" => "ok",
        );

        $data = $this->input->post('data');

        $this->modelname = "Naver_brand_model";
        $goods_list = $this->{$this->modelname}->get_goods_list($data);

        $pageSize = 30;

        // 총 몇건의 데이터가 입력되었는지
        $total_reg_data_cnt = 0;

        $this->modelname = "Naver_review_model";
        foreach ($goods_list AS $goods) {
            $page = 1;

            $naver_reviews = $this->getReviewData($goods, $page, $pageSize);

            // 네이버리뷰 전체 수
            $total_naver_review_cnt = $naver_reviews['totalElements'];

            // 현재 db에 적재된 수와의 차이
            $goods_reg_data_cnt = 0;
            $diff_cnt = $total_naver_review_cnt - $goods['db_review_cnt'];
            $total_page = ceil($diff_cnt / $pageSize);
            $max_page = ceil($total_naver_review_cnt / $pageSize);

            if ($total_page == 0) {
                continue;
            }

            $naver_review_list = array();
            // getReviewData를 통해 가져온 실제 네이버 리뷰를 db에 적재하기위해 가공하여 $naver_review_list 배열변수에 쌓아둔다
            $naver_review = $this->setReviewData($naver_reviews['contents']);
            if ($naver_review) { // 가져온 데이터가 있을 경우에 적재 및 다음페이지
                $naver_review_list[] = $naver_review;
                if ($total_page > 1) {
                    $page++;
                }
            }
            else { // 가져온 데이터가 없을 경우 다음 상품으로 넘어감
                continue;
            }

            $info_data = array(
                "total_naver_review_cnt" => $total_naver_review_cnt,
                "product_no" => $goods['product_no']
            );

            for ($page; $page <= $total_page; $page++) {
                $naver_reviews = $this->getReviewData($goods, $page, $pageSize);
                $naver_review = $this->setReviewData($naver_reviews['contents']);

                if ($naver_review) {
                    $naver_review_list[] = $naver_review;

                    // 한번에 많은 데이터를 전송하지 않게 하기 위해 5페이지 단위로 전송 또는
                    if ($total_page >= 5) {
                        if ($page % 5 == 0 || $page == $total_page) {
                            $reg_cnt = $this->{$this->modelname}->reg_naver_review($naver_review_list);
                            $total_reg_data_cnt += $reg_cnt;
                            $goods_reg_data_cnt += $reg_cnt;
                            // 등록 수량 업데이트
                            $this->{$this->modelname}->update_naver_review_info($info_data);

                            // 마지막 페이지에 도달했지만 부족한 개수를 채우지 못했을 경우 전체 페이지를 1씩 늘리며 반복
                            if ($page == $total_page) {
                                if ($diff_cnt > $goods_reg_data_cnt) {
                                    $total_page++;
                                }
                            }
                        }
                    }
                    else {
                        // 전체 페이지가 5페이지 미만일 경우
                        if ($page == $total_page) {
                            $reg_cnt = $this->{$this->modelname}->reg_naver_review($naver_review_list);
                            $total_reg_data_cnt += $reg_cnt;
                            $goods_reg_data_cnt += $reg_cnt;
                            // 등록 수량 업데이트
                            $this->{$this->modelname}->update_naver_review_info($info_data);

                            // 마지막 페이지에 도달했지만 부족한 개수를 채우지 못했을 경우 전체 페이지를 1씩 늘리며 반복
                            if ($diff_cnt > $goods_reg_data_cnt) {
                                $total_page++;
                            }
                        }
                    }
                }
                else {
                    continue;
                }
            }
        }

        if ($total_reg_data_cnt > 0) {
            $cnt = number_format($total_reg_data_cnt);
            $finResult['status'] = "success";
            $finResult['msg'] = "총 {$cnt}건의 리뷰데이터가 등록되었습니다.";
        }
        else {
            $finResult['status'] = "fail";
            $finResult['msg'] = "등록된 리뷰데이터가 없습니다.";
        }
        echo json_encode($finResult);
    }

    public function checkReviewCnt($product_no, $total_naver_review_cnt)
    {
        // db에 적재된 리뷰 개수와 비교하여 같지 않을 경우 반복 처리
        return $this->{$this->modelname}->check_review_cnt($product_no, $total_naver_review_cnt);
    }

    public function setReviewData($naver_reviews)
    {
        if (!$naver_reviews) {
            return false;
        }

        $review_datas = array();
        foreach ($naver_reviews AS $naver_review)
        {
            // 리뷰 이미지
            $review_imgs = null;
            if (is_array($naver_review['reviewAttaches']) && count($naver_review['reviewAttaches']) > 0) {
                $review_attaches = $naver_review['reviewAttaches'];
                $review_imgs = array();
                foreach ($review_attaches AS $review_attache) {
                    $review_imgs[] = $review_attache['attachUrl'];
                }
                $review_imgs = json_encode($review_imgs);
            }

            $review_data = array(
                "review_id"             => $naver_review['id'],
                "product_no"            => $naver_review['originProductNo'],
                "review_score"          => $naver_review['reviewScore'],
                "help_cnt"              => $naver_review['helpCount'],
                "review_type"           => $naver_review['reviewType'],
                "review_content_type"   => $naver_review['reviewContentClassType'],
                "review_imgs"           => $review_imgs,
                "option_nm"             => $naver_review['productOptionContent'],
                "review_text"           => $naver_review['reviewContent'],
                "review_evaluations"    => $naver_review['reviewEvaluations'],
                "writer_id"             => $naver_review['maskedWriterId'],
                "writer_profile_img"    => $naver_review['writerProfileImageUrl'],
                "created_at"            => (new DateTime($naver_review['createDate']))->format('YmdHis'),
                "saved_at"              => date('YmdHis'),
                "use_yn"                => 'Y',
            );
            $review_datas[] = $review_data;
        }
        return $review_datas;
    }

    public function getReviewData($goods, $page, $pageSize)
    {

        $url = "https://brand.naver.com/{$goods['brand_cd']}/products/{$goods['naver_goods_idx']}";
        $referer = "";
        if ($goods['shop_type'] == 'smartstore') {
            $url = "https://smartstore.naver.com/i/v1/contents/reviews/query-pages";
            $referer = "https://smartstore.naver.com/{$goods['brand_cd']}/products/{$goods['naver_goods_idx']}";
        }
        $postFields = array(
            'checkoutMerchantNo' => $goods['channel_no'],
            'originProductNo' => $goods['product_no'],
            'page' => $page,
            'pageSize' => $pageSize,
            'reviewSearchSortType' => 'REVIEW_CREATE_DATE_DESC'
        );

        $user_agents = array(
            'PostmanRuntime/7.41.1',
            'PostmanRuntime/7.41.0',
            'PostmanRuntime/7.40.0',
            'PostmanRuntime/7.39.1',
            'PostmanRuntime/7.39.0',
            'PostmanRuntime/7.38.0',
            ''
        );
        $user_agent = array_rand($user_agents);
        $user_agent = $user_agents[$user_agent];

        $cookies = array(
            'NNB=KN22YBMGHBWWK; NV_WETR_LOCATION_RGN_M="MDk2ODA2MTA="; _fwb=231tpe0Gnw7R7KGwNckcUy.1704945826687; ASID=d3238d2f0000018d3f2711370000004f; NaverSuggestUse=use%26unuse; NFS=2; _ga=GA1.1.518884317.1715847318; _ga_EFBDNNF91G=GS1.1.1715847317.1.1.1715847329.0.0.0; NAC=OgKxBMwHqyOfB; _fbp=fb.1.1718868515354.42986216166309981; _gcl_au=1.1.30271098.1718868516; naverfinancial_CID=1def82e47ed84f1da69b5f1925e9d861; _ga_Q7G1QTKPGB=GS1.1.1718868515.1.0.1718868516.0.0.0; NV_WETR_LAST_ACCESS_RGN_M="MDk2ODA2MTA="; nid_inf=399480247; NID_JKL=J2gLXimHCb4cnpcb1d9Jv1VtXAYjQeKcxyg4AWTgeyU=; NACT=1; tooltipDisplayed=true; page_uid=ird6Iwqo1LVssf7uNRGssssst/h-349915; memremind-exp-cnt=3; BUC=Kx9vB2S2xSJmh0edjeWGOXxpmRFMyxVFkefnhwLSeG0=',
            '_fwb=90asNGlFuf2EEUTRZu0gP7.1723082478218; NAC=VQE1BQQbm5h6; NNB=6UKRUQHOE22GM; BUC=EBlQj-BPJ7MLdvquBr_888hTha6ajh7K1ijM_1rtLao=',
            ''
        );
        $cookie = array_rand($cookies);
        $cookie = $cookies[$cookie];

        // 브랜드와 스마트스토어의 전송헤더에 차이가 있어 구분한다
        if ($goods['shop_type'] == 'smartstore') {
            $postFields = json_encode($postFields);
            $contentLength = strlen($postFields);
            $header = array(
                "Content-Type: application/json",
                "Accept: application/json, text/plain, */*",
                "Host: smartstore.naver.com",
                "Origin: smartstore.naver.com",
                "Content-Length: {$contentLength}",
                "User-Agent: {$user_agent}",
                "Referer: {$referer}",
                "Cookie: {$cookie}",
            );
        }
        else {
            $postFields = http_build_query($postFields);
            $contentLength = strlen($postFields);
            $header = array(
                "Content-Type: application/x-www-form-urlencoded",
                "Accept: application/json, text/plain, */*",
                "Host: brand.naver.com",
                "Origin: brand.naver.com",
                "Content-Length: {$contentLength}",
                "User-Agent: {$user_agent}",
                "Referer: {$referer}",
                "Cookie: {$cookie}",
            );
        }

        $options = [
            "http" => [
                "header" => $header,
                "method" => "POST",
                "content" => $postFields,
                "follow_location" => 1,
                "max_redirects" => 10,
                "timeout" => 5
            ]
        ];

        $context = stream_context_create($options);
        $response = @file_get_contents($url, false, $context);
        $naver_reviews = json_decode($response, true);

        if (!$naver_reviews) {

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $response = curl_exec($ch);
            $naver_reviews = json_decode($response, true);
        }

//        if ($goods['product_no'] == '4663591154') {
//            xmp($response);
//        }

        if (!$naver_reviews) {
            return false;
        }
        return $naver_reviews;
    }


}
