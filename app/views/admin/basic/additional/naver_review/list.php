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
                <button type="button" class="btn btn-default btn-sm btn-refresh-review" data-brand-cd="<?=$_GET['skeyword']?>">전체 리뷰 갱신</button>
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
                        <tr <?=($v['naver_review_cnt'] != $v['db_review_cnt'])? "style='background: #E9EC69;'" : ""?>>
                            <td><?=number_format($k+1)?></td>
                            <td>
                                <a href="<?="https://{$v['shop_type']}.naver.com/{$v['brand_cd']}"?>" target="_blank"><?=$v['brand_nm']?></a>
                            </td>
                            <td>
                                <a href="<?="https://{$v['shop_type']}.naver.com/{$v['brand_cd']}/products/{$v['naver_goods_idx']}"?>" target="_blank"><?=$v['naver_goods_idx']?></a>
                            </td>
                            <td><?=$v['naver_goods_nm']?></td>
                            <td><?=$v['created_at']?></td>
                            <td><?=number_format($v['naver_review_cnt'])?>건</td>
                            <td><?=number_format($v['db_review_cnt'])?>건</td>
                            <td><?=$v['updated_at']?></td>
                            <td style="text-align: center;">
                                <button type="button" class="btn btn-default btn-sm btn-refresh-review" data-brand-cd="<?=$v['brand_cd']?>" data-product-no="<?=$v['product_no']?>" data-shop-type="<?=$v['shop_type']?>">갱신</button>
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
    <input type="hidden" id="base_url" value="<?=base_url()?>">
</div>

<div id="naver_goods_form" style="display: none;">

</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/additional/naver_review/index.js'); ?>"></script>