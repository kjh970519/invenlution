<div class="box">
    <div class="loading-area" style="position: absolute; width: 100%; height: 100%; background-color: rgb(0, 0, 0, 0.6); z-index: 10; display: none;">
        <img src="<?=base_url('assets/images/ajax-loader.gif');?>" style="position: absolute; transform: translate(-50%, -50%); left: 50%; top: 50%;">
    </div>
    <div class="box-table">
        <?php
        echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
        $attributes = array('class' => 'form-inline', 'name' => 'flist', 'id' => 'flist');
        echo form_open(current_full_url(), $attributes);
        ?>
        <div class="box-table-header">
            <?
                ob_start();
            ?>

            <div class="btn-group pull-right" role="group" aria-label="...">
                <button type="button" class="btn btn-default btn-sm btn-single-product">단일 상품 등록</button>
                <button type="button" class="btn btn-default btn-sm btn-multiple-products">전체 상품 등록</button>
                <button type="button" class="btn btn-default btn-sm btn-refresh-review" data-type="all">전체 리뷰 갱신</button>
                <a href="<?=$view['listall_url']?>" class="btn btn-outline btn-default btn-sm">전체목록</a>
            </div>
            <?php
            $buttons = ob_get_contents();
            ob_end_flush();
            ?>
        </div>
        <div class="row">전체 : <?=($view['data']['total_rows'])? $view['data']['total_rows'] : 0?>건</div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" style="font-family: Helvetica, '나눔고딕', 'Nanum Gothic', '나눔스퀘어', 'Nanum Square', 'Apple SD Gothic Neo', 'Malgun Gothic', '맑은 고딕', Dotum, '돋움', sans-serif; font-size: 12px; line-height: 1.5em;">
                <thead>
                <tr>
                    <th>번호</th>
                    <th>브랜드</th>
                    <th>네이버 상품코드</th>
                    <th>네이버 상품명</th>
                    <th>등록일시</th>
                    <th>네이버 리뷰 수</th>
                    <th>DB 리뷰 수</th>
                    <th>리뷰 업데이트 일시</th>
                    <th>최신 리뷰 업데이트</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($view['data']['list']) {
                    foreach ($view['data']['list'] as $k => $v) {
                ?>
                        <tr>
                            <td><?=number_format($k+1)?></td>
                            <td>
                                <a href="<?="https://{$v['shop_type']}.naver.com/{$v['brand_cd']}"?>" target="_blank"><?=$v['brand_nm']?></a>
                            </td>
                            <td>
                                <a href="<?="https://{$v['shop_type']}.naver.com/{$v['brand_cd']}/products/{$v['naver_goods_idx']}"?>" target="_blank"><?=$v['naver_goods_idx']?></a>
                            </td>
                            <td><?=$v['naver_goods_nm']?></td>
                            <td><?=$v['created_at']?></td>
                            <td><?=$v['naver_review_cnt']?></td>
                            <td><?=$v['db_review_cnt']?></td>
                            <td><?=$v['updated_at']?></td>
                            <td style="text-align: center;">
                                <button type="button" <?=($v['naver_review_cnt'] > 0 && $v['naver_review_cnt'] > $v['db_review_cnt'])? "" : "disabled"?> class="btn btn-default btn-sm btn-refresh-review" data-type="single" data-goods-idx="<?=$v['naver_goods_idx']?>">갱신</button>
                            </td>
                            <td></td>
                        </tr>
                <?
                    }
                }
                if (!$view['data']['list']) {
                    ?>
                    <tr>
                        <td colspan="10" class="nopost">자료가 없습니다</td>
                    </tr>
                    <?
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="box-info">
            <?=$view['paging']?>
            <div class="pull-left ml20"><?=admin_listnum_selectbox()?></div>
            <?php echo $buttons; ?>
        </div>
        <?=form_close()?>
    </div>
    <form name="fsearch" id="fsearch" action="<?=current_full_url(); ?>" method="get">
        <div class="box-search">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <select class="form-control" name="sfield" >
                        <?=$view['search_option']?>
                    </select>
                    <div class="input-group">
                        <input type="text" class="form-control" name="skeyword" value="<?=html_escape($view['skeyword']); ?>" placeholder="Search for..." />
                        <span class="input-group-btn">
							<button class="btn btn-default btn-sm" name="search_submit" type="submit">검색!</button>
						</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="naver_goods_form" style="display: none;">

</div>

<script>
    $(document).ready(function() {
        naver_review.init();
    });

    var naver_review = {
        init: function() {
            $(".btn-single-product").on("click", this.reg_single_product);
            $(".btn-multiple-products").on("click", this.reg_multiple_products);
            $(".btn-refresh-review").on("click", this.refresh_review);
        },
        // 단일 상품 등록
        reg_single_product: function() {
            if(naver_store_url = prompt("등록할 네이버스토어 상품 url을 입력해주세요")) {

                var regex = /products\/(\d+)/;
                var match = naver_store_url.match(regex);
                var naver_goods_idx;
                if (match) {
                    var naver_goods_idx = match[1];
                }
                if (!naver_goods_idx) {
                    alert("유효하지 않은 상품 url 입니다");
                    naver_review.reg_single_product();
                }
                else {
                    naver_review.check_naver_goods_idx(naver_goods_idx, naver_store_url);
                }
            }
            else {
                if (!naver_store_url && naver_store_url != null) {
                    alert("url을 입력해주세요");
                    naver_review.reg_single_product();
                }
            };
        },
        check_naver_goods_idx: function(naver_goods_idx, naver_store_url) {
            $(".loading-area").show();
            $.ajax({
                url: `<?=current_url()?>/checkNaverGoodsIdx/${naver_goods_idx}`,
                method: "get",
                dataType: "json",
                success: function(obj) {
                    if (obj.status == 'ok') {
                        naver_review.get_naver_goods_data(naver_store_url);
                    }
                    else {
                        alert("이미 등록된 상품코드입니다");
                        naver_review.reg_single_product();
                    }
                    $(".loading-area").hide();
                }
            });
        },
        get_naver_goods_data: function(naver_store_url) {
            $(".loading-area").show();
            $.ajax({
                url: `<?=current_url()?>/getNaverGoodsData`,
                method: "post",
                data: {
                    naver_store_url: naver_store_url
                },
                dataType: "json",
                success: function(obj) {
                    if (obj.status == 'ok') {
                        window.__PRELOADED_STATE__ = null;
                        $("#naver_goods_form").empty();
                        $("#naver_goods_form").append(obj.html);

                        var _tmp = window.__PRELOADED_STATE__.product.A;
                        var naver_goods_datas = new Array();
                        var naver_goods_data = new Object();

                        naver_goods_data.naver_goods_idx = _tmp.id;
                        naver_goods_data.product_no = _tmp.productNo;
                        naver_goods_data.naver_goods_nm = _tmp.name;
                        naver_goods_data.brand_cd = _tmp.channel.channelSiteUrl;
                        naver_goods_data.brand_nm = _tmp.channel.channelName;
                        naver_goods_data.naver_review_cnt = _tmp.reviewAmount.totalReviewCount;
                        naver_goods_data.shop_type = 'brand';
                        naver_goods_data.updated_at = null;
                        if (window.__PRELOADED_STATE__.smartStoreV2) {
                            naver_goods_data.shop_type = 'smartstore';
                        }

                        naver_goods_datas.push(naver_goods_data);

                        naver_review.reg_naver_goods_data(naver_goods_datas, true);
                    }
                    else {
                        alert("유효한 상품코드가 아닙니다");
                    }
                    $(".loading-area").hide();
                }
            });
        },
        reg_naver_goods_data: function(naver_goods_datas, is_finish) {
            $(".loading-area").show();
            $.ajax({
                url: `<?=current_url()?>/regNaverGoodsData`,
                method: "post",
                dataType: "json",
                data: {
                    naver_goods_datas: naver_goods_datas
                },
                success: function (obj) {
                    if (obj.status == 'ok') {
                        if (is_finish) {
                            alert("등록되었습니다");
                            location.reload();
                        }
                    }
                    $(".loading-area").hide();
                }
            });
        },
        reg_multiple_products: function() {
            if(naver_store_url = prompt("등록할 네이버스토어 브랜드 url을 입력해주세요")) {
                naver_review.get_naver_goods_all_url(naver_store_url);
            }
            else {
                if (!naver_store_url && naver_store_url != null) {
                    alert("url을 입력해주세요");
                    naver_review.reg_single_product();
                }
            };
        },
        get_naver_goods_all_url: function(naver_store_url) {
            $(".loading-area").show();
            $.ajax({
                url: `<?=current_url()?>/getNaverGoodsAllUrl`,
                method: "post",
                dataType: "json",
                data: {
                    naver_store_url: naver_store_url
                },
                success: function(obj) {
                    if (obj.status == 'ok') {
                        window.__PRELOADED_STATE__ = null;
                        $("#naver_goods_form").empty();
                        $("#naver_goods_form").append(obj.html);

                        var naver_all_goods_url;
                        var _categories;
                        var _total_cnt;
                        var _channel_uid;
                        var _shop_type = 'brand';
                        if (window.__PRELOADED_STATE__.smartStoreV2) {
                            _categories = window.__PRELOADED_STATE__.smartStoreV2.firstCategories;
                            _total_cnt = window.__PRELOADED_STATE__.smartStoreV2.productCount;
                            _channel_uid = window.__PRELOADED_STATE__.smartStoreV2.channel.channelUid;
                            _shop_type = 'smartstore';
                        }
                        else {
                            _categories = window.__PRELOADED_STATE__.storeCategory.A.firstCategories;
                            _total_cnt = window.__PRELOADED_STATE__.storeCategory.A.totalProductCount;
                            _channel_uid = window.__PRELOADED_STATE__.channel.A.channelUid;
                        }

                        _categories.forEach(function(category) {
                            if (category.categoryId == 'ALL') {
                                naver_all_goods_url = `${naver_store_url}/category/${category.id}`;
                            }
                        });
                        naver_review.get_naver_goods_list(_shop_type, naver_store_url, naver_all_goods_url, _channel_uid, _total_cnt, 0);
                    }
                    else {
                        alert("유효하지 않은 상품 url 입니다");
                        naver_review.reg_single_product();
                    }
                    $(".loading-area").hide();
                }
            });
        },
        get_naver_goods_list: function(shop_type, naver_store_url, naver_all_goods_url, channel_uid, total_cnt, page) {
            page++;

            var naver_goods_datas = new Array();
            var _brand_cd;
            var regex = /:\/\/[^\/]+\/([^\/]+)/;
            var match = naver_store_url.match(regex);
            if (match) {
                _brand_cd = match[1];
            }

            var size = 80; // 한페이지에 80개씩 출력
            var total_page = total_cnt / size;

            var _params = new Object();
            _params.categorySearchType = 'DISPCATG';
            _params.sortType = 'POPULAR';
            _params.page = page;
            _params.pageSize = size;

            $(".loading-area").show();
            $.ajax({
                url: `<?=current_url()?>/getNaverGoodsList`,
                method: "POST",
                dataType: "json",
                data: {
                    shop_type: shop_type,
                    channel_uid: channel_uid,
                    naver_all_goods_url: naver_all_goods_url,
                    params: _params
                },
                success: function(obj) {

                    var goods_lists = obj.goods_lists;
                    goods_lists.forEach(function(goods_list) {
                        var naver_goods_data = new Object();

                        naver_goods_data.naver_goods_idx = goods_list.id;
                        naver_goods_data.product_no = goods_list.productNo;
                        naver_goods_data.naver_goods_nm = goods_list.name;
                        naver_goods_data.brand_cd = _brand_cd;
                        naver_goods_data.brand_nm = goods_list.channel.channelName;
                        naver_goods_data.naver_review_cnt = goods_list.reviewAmount.totalReviewCount;
                        naver_goods_data.shop_type = shop_type;
                        naver_goods_data.updated_at = null;

                        naver_goods_datas.push(naver_goods_data);
                    });

                    if (total_page > page) {
                        naver_review.reg_naver_goods_data(naver_goods_datas, false);
                        naver_review.get_naver_goods_list(shop_type, naver_store_url, naver_all_goods_url, channel_uid, total_cnt, page);
                    }
                    else {
                        naver_review.reg_naver_goods_data(naver_goods_datas, true);
                    }
                    $(".loading-area").hide();
                }
            });
        },
        refresh_review: function() {
            console.log($(this).data('type'));
        }
    }
</script>