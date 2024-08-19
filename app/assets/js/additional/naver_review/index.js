$(document).ready(function() {
    naver_review.init();
});

var naver_review = {
    base_url: `${$("#base_url").val()}admin/additional/naver_review/`,
    init: function() {
        $(".btn-reg-brand").on("click", this.reg_brand);
        $(".btn-single-product").on("click", this.reg_single_product);
        $(".btn-multiple-products").on("click", this.reg_multiple_products);
        $(".btn-refresh-review").on("click", this.refresh_review);
    },
    // 브랜드 등록
    reg_brand: function() {
        if(naver_store_url = prompt("등록할 네이버스토어 브랜드 url을 입력해주세요")) {
            naver_review.get_naver_goods_all_url(naver_store_url, null, true);
        }
        else {
            if (!naver_store_url && naver_store_url != null) {
                alert("url을 입력해주세요");
                naver_review.reg_brand();
            }
        };
    },
    // 이미 등록된 브랜드인지 체크 후 등록
    check_brand: function(db) {
        $.ajax({
            url: `${naver_review.base_url}regBrand`,
            method: "post",
            data: {
                data: db
            },
            dataType: "json",
            success: function(obj) {
                if (obj.status == 'ok') {
                    naver_review.get_naver_goods_all_url(db.naver_store_url, obj.data.channel_no, false);
                }
                else {
                    alert("이미 등록된 브랜드 입니다.");
                }
            }
        });
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
            url: `${naver_review.base_url}checkNaverGoodsIdx/${naver_goods_idx}`,
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
            url: `${naver_review.base_url}getNaverGoodsData`,
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
                    var _review_evaluations = window.__PRELOADED_STATE__.productReviewSummary.A.reviewEvaluations;

                    var naver_goods_datas = new Array();
                    var naver_goods_data = new Object();

                    naver_goods_data.naver_goods_idx = _tmp.id;
                    naver_goods_data.product_no = _tmp.productNo;
                    naver_goods_data.naver_goods_nm = _tmp.name;
                    naver_goods_data.channel_no = _tmp.channel.channelNo;
                    naver_goods_data.brand_cd = _tmp.channel.channelSiteUrl;
                    naver_goods_data.brand_nm = _tmp.channel.channelName;
                    naver_goods_data.naver_review_cnt = _tmp.reviewAmount.totalReviewCount;
                    naver_goods_data.shop_type = 'brand';
                    naver_goods_data.updated_at = null;
                    if (window.__PRELOADED_STATE__.smartStoreV2) {
                        naver_goods_data.shop_type = 'smartstore';
                        naver_goods_data.channel_no = window.__PRELOADED_STATE__.smartStoreV2.channel.payReferenceKey;
                    }

                    // 단일 상품 등록때만 평가 항목 추가(전체 상품 등록시엔 데이터가 없어서 등록 불가능)
                    var evaluations_arr = new Array();
                    _review_evaluations.forEach(function(review_evaluation) {
                        review_evaluation.reviewEvaluationValues.forEach(function(review_evaluation_value) {

                            var value = `{"value_name": "${review_evaluation_value.reviewEvaluationValueName}", "evaluation_name": "${review_evaluation.reviewEvaluationName}", "evaluation_id": "${review_evaluation.reviewEvaluationId}"}`;
                            var obj = `{"${review_evaluation_value.reviewEvaluationValueId}": ${value}}`;

                            evaluations_arr.push(JSON.parse(obj));
                        });
                    });
                    naver_goods_data.evaluations = JSON.stringify(evaluations_arr);
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
    reg_naver_goods_data: function(naver_goods_datas, is_finish=false) {
        $(".loading-area").show();
        $.ajax({
            url: `${naver_review.base_url}regNaverGoodsData`,
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
            naver_review.get_naver_goods_all_url(naver_store_url, null, false);
        }
        else {
            if (!naver_store_url && naver_store_url != null) {
                alert("url을 입력해주세요");
                naver_review.reg_single_product();
            }
        };
    },
    get_naver_goods_all_url: function(naver_store_url, channel_no = null, is_brand = false) {
        $(".loading-area").show();
        $.ajax({
            url: `${naver_review.base_url}getNaverGoodsAllUrl`,
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
                    var _channel_no;
                    var _brand_cd;
                    var _brand_nm;
                    var _shop_type = 'brand';
                    var _tmp = window.__PRELOADED_STATE__;
                    if (_tmp.smartStoreV2) {
                        _categories = _tmp.smartStoreV2.firstCategories;
                        _total_cnt = _tmp.smartStoreV2.productCount;
                        _channel_uid = _tmp.smartStoreV2.channel.channelUid;
                        _channel_no = _tmp.smartStoreV2.channel.payReferenceKey;
                        _brand_cd = _tmp.smartStoreV2.channel.brandUrl;
                        _brand_nm = _tmp.smartStoreV2.channel.brandStoreName;
                        _shop_type = 'smartstore';
                    }
                    else {
                        _categories = _tmp.storeCategory.A.firstCategories;
                        _total_cnt = _tmp.storeCategory.A.totalProductCount;
                        _channel_uid = _tmp.channel.A.channelUid;
                        _channel_no = _tmp.channel.A.id;
                        _brand_cd = _tmp.channel.A.brandUrl;
                        _brand_nm = _tmp.channel.A.brandStoreName;
                    }
                    if (channel_no) _channel_no = channel_no;

                    // 전체 상품 등록일 경우
                    if (!is_brand) {
                        _categories.forEach(function(category) {
                            if (category.categoryId == 'ALL') {
                                naver_all_goods_url = `${naver_store_url}/category/${category.id}`;
                            }
                        });
                        naver_review.get_naver_goods_list(_shop_type, naver_store_url, naver_all_goods_url, _channel_uid, _channel_no, _total_cnt, 0);
                    }
                    // 브랜드 등록일 경우
                    else {
                        var db = new Object();
                        db.channel_no = _channel_no;
                        db.brand_cd = _brand_cd;
                        db.brand_nm = _brand_nm;
                        db.shop_type = _shop_type;
                        db.naver_store_url = naver_store_url;
                        naver_review.check_brand(db);
                    }
                }
                else {
                    alert("유효하지 않은 상품 url 입니다");
                    if (!is_brand) {
                        naver_review.reg_multiple_products();
                    }
                    else {
                        naver_review.reg_brand();
                    }
                }
                $(".loading-area").hide();
            }
        });
    },
    get_naver_goods_list: function(shop_type, naver_store_url, naver_all_goods_url, channel_uid, channel_no, total_cnt, page) {
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
            url: `${naver_review.base_url}getNaverGoodsList`,
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
                    naver_goods_data.channel_no = goods_list.channel.channelNo;
                    if (shop_type == 'smartstore') {
                        naver_goods_data.channel_no = channel_no;
                    }
                    naver_goods_data.naver_review_cnt = goods_list.reviewAmount.totalReviewCount;
                    naver_goods_data.shop_type = shop_type;
                    naver_goods_data.updated_at = null;

                    naver_goods_datas.push(naver_goods_data);
                });

                if (total_page > page) {
                    naver_review.reg_naver_goods_data(naver_goods_datas, false);
                    naver_review.get_naver_goods_list(shop_type, naver_store_url, naver_all_goods_url, channel_uid, channel_no, total_cnt, page);
                }
                else {
                    naver_review.reg_naver_goods_data(naver_goods_datas, true);
                }
                $(".loading-area").hide();
            }
        });
    },
    refresh_review: function() {
        var data = new Object();

        data.brand_cd = $(this).data('brand-cd');
        data.product_no = $(this).data('product-no');

        naver_review.reg_review(data);
    },
    reg_review: function(data) {
        $(".loading-area").show();
        $.ajax({
            url: `${naver_review.base_url}regReview`,
            method: "POST",
            dataType: "json",
            data: {
                data: data
            },
            success: function(obj) {
                if (obj.status == 'ok') {
                    alert("등록되었습니다");
                    location.reload();
                }
                else {
                    alert(obj.msg);
                    location.reload();
                }
                $(".loading-area").hide();
            }
        });
    },
    update_show: function(obj, type, idx) {
        var data = new Object();
        data = {
            is_checked: (obj.prop("checked")? 1:0),
            type: type,
            idx: idx,
        };
        $.ajax({
            url: `${naver_review.base_url}updateShow`,
            method: "POST",
            dataType: "json",
            data: {
                data: data
            },
            success: function(obj) {}
        });
    }
}