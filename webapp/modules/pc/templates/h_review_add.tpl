({$inc_html_header|smarty:nodefaults})
<body>
({ext_include file="inc_extension_pagelayout_top.tpl"})
<table class="mainframe" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="container inc_page_header">
({$inc_page_header|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container inc_navi">
({$inc_navi|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container main_content" align="center">

({ext_include file="inc_alert_box.tpl"})({* エラーメッセージコンテナ *})

<table class="container" border="0" cellspacing="0" cellpadding="0">({*BEGIN:container*})
<tr>
<td class="full_content" align="center">
({***************************})
({**ここから：メインコンテンツ**})
({***************************})

<img src="./skin/dummy.gif" alt="dummy" class="v_spacer_l">

<!-- ********************************** -->
<!-- ******ここから：レビューを書く****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_05" align="left">
<!-- *ここから：レビューを書く＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:598px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">レビューを書く</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<div class="border_01" class="bg_05">

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ここから：主内容＞＞内枠 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:550px;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:548px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="center" valign="middle">

<!-- ここから：主内容＞＞内枠＞＞検索説明文 -->
<div style="padding:10px 30px 10px 30px;text-align:left;">

レビューを書きたい商品を検索します。<br>
キーワードを入力し、該当するカテゴリを選択してください。<br>


</div>
<!-- ここまで：主内容＞＞内枠＞＞検索説明文 -->


<!-- ここから：主内容＞＞内枠＞＞検索フォーム -->
<div style="padding:10px 0px;text-align:center;">

({t_form m=pc a=page_h_review_add})
<input type="hidden" name="search_flag" value="1">
キーワード&nbsp;<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1">
<input type="text" class="text" name="keyword" size="15" value="({$keyword})">
&nbsp;カテゴリ&nbsp;<img src="./skin/dummy.gif" alt="dummy" style="width:14px;height:14px;" class="icon icon_1">
<select name="category_id">
<option value="" selected="selected">選択
({html_options options=$category_disp selected=$category_id})
</select>
&nbsp;<input type="submit" class="submit" name="button" value="　検 索　">
</form>

</div>
<!-- ここまで：主内容＞＞内枠＞＞検索フォーム -->

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞内枠 -->

<img src="./skin/dummy.gif" class="v_spacer_l">

</div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：レビューを書く＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：レビューを書く****** -->
<!-- ********************************** -->

<img src="./skin/dummy.gif" alt="dummy" class="v_spacer_l">

({if $search_result})
<!-- ************************************ -->
<!-- ******ここから：検索結果****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td align="left">
<!-- *ここから：検索結果内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:598px;padding:2px 0px;" class="bg_06"><span class="c_00"><span class="b_b">({$keyword})の検索結果</span>&nbsp;&nbsp;***&nbsp;<span class="b_b">({$total_num})件</span>&nbsp;が該当しました。</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
<!-- ここから：次前表示上段 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;">
({*********})
<tr>
<td style="width:636px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:634px;" class="bg_05" align="right">

<div class="padding_s">

({if $is_prev}) <a href="({t_url m=pc a=page_h_review_add})&amp;keyword=({$keyword|escape:url|smarty:nodefaults})&amp;search_flag=1&amp;category_id=({$category_id})&amp;page=({$page-1})">前を表示</a>&nbsp;&nbsp;({/if})
({$start_num})件～({$end_num})件を表示&nbsp;&nbsp;
({if $is_next}) <a href="({t_url m=pc a=page_h_review_add})&amp;keyword=({$keyword|escape:url|smarty:nodefaults})&amp;search_flag=1&amp;category_id=({$category_id})&amp;page=({$page+1})">次を表示</a>({/if})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：次前表示上段 -->
({*ここまで：header*})
({*ここから：body*})
<table class="bg_01" border="0" cellspacing="0" cellpadding="0" style="width:636px;">
	<tr>
		<td>
			<td class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
		</td>
	</tr>
</table>
<!-- *ここから：検索結果内容＞＞商品情報* -->
({foreach from=$search_result item=product key=key})
<table class="bg_01" border="0" cellspacing="0" cellpadding="0" style="width:636px;">
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" style="width:192px; float:left;">
				<!-- ****************************** -->
				<!-- ******商品画像：ここから****** -->
				<!-- ****************************** -->
				<tr style="height:100%;">
					<!-- ------画像左の線：ここから------ -->
					<td style="width:1px;" class="bg_01" rowspan="6"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
					<!-- ------画像左の線：ここまで------ -->
					<!-- ------画像本体：ここから------ -->
					<td class="bg_02" style="width:190px; height:192px; text-align:center;" rowspan="6">
						<div class="padding_s">
							<a href="({$product.DetailPageURL})" target="_blank"><img src="({if $product.MediumImage})({$product.MediumImage.URL})({else})./skin/dummy.gif({/if})" /></a><br />
							<a href="({$product.DetailPageURL})" target="_blank">詳細を見る</a>
						</div>
					</td>
					<!-- ------画像本体：ここまで------ -->
					<!-- ------画像右の線：ここから------ -->
					<td style="width:1px;" class="bg_01"rowspan="6"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
					<!-- ------画像右の線：ここまで------ -->
				</tr>
				<!-- ****************************** -->
				<!-- ******商品画像：ここまで****** -->
				<!-- ****************************** -->
			</table>
			<table border="0" cellspacing="0" cellpadding="0" style="width:444px; float:right;">
				<!-- ****************************** -->
				<!-- ******タイトル：ここから****** -->
				<!-- ****************************** -->
				<tr style="height:50px;">
					<!-- ------タイトルって表示：ここから------ -->
					<td class="bg_02" style="width:70px; text-align:center;">
						タイトル
					</td>
					<!-- ------タイトルって表示：ここまで------ -->
					<!-- ------タイトルって表示左の線：ここから------ -->
					<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
					<!-- ------タイトルって表示左の線：ここまで------ -->
					<!-- ------タイトル本体：ここから------ -->
					<td class="bg_02" style="width:372px;">
						<div style="margin:0 0 0 10px;">
							<span class="b_b">({$product.ItemAttributes.Title})</span>
						</div>
					</td>
					<!-- ------タイトル本体：ここまで------ -->
					<!-- ------タイトル本体左の線：ここから------ -->
					<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
					<!-- ------タイトル本体左の線：ここまで------ -->
				</tr>
				<!-- ****************************** -->
				<!-- ******タイトル：ここまで****** -->
				<!-- ****************************** -->
				<tr>
					<td class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
				</tr>
				<!-- ****************************** -->
				<!-- ********説明：ここから******** -->
				<!-- ****************************** -->
				<tr style="height:90px;">
					<!-- ------説明って表示：ここから------ -->
					<td class="bg_02" style="width:70px; text-align:center;">
						説明
					</td>
					<!-- ------説明って表示：ここまで------ -->
					<!-- ------説明って表示左の線：ここから------ -->
					<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
					<!-- ------説明って表示左の線：ここまで------ -->
					<!-- ------説明本体：ここから------ -->
					<td class="bg_02" style="width:372px;">
						<div style="margin:0 0 0 10px;">
							<p style="margin0; padding:0;">
								({$product.ItemAttributes.PublicationDate})
							</p>
							<p style="margin0; padding:0;">
								({$product.ItemAttributes.Manufacturer})
							</p>
							<p style="margin0; padding:0;">
								({$product.artist})({$product.author})
							</p>
						</div>
					</td>
					<!-- ------説明本体：ここまで------ -->
					<!-- ------説明本体左の線：ここから------ -->
					<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
					<!-- ------説明本体左の線：ここまで------ -->
				</tr>
				<!-- ****************************** -->
				<!-- ********説明：ここまで******** -->
				<!-- ****************************** -->
				<tr>
					<td class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
				</tr>
				<!-- ****************************** -->
				<!-- ********書く：ここから******** -->
				<!-- ****************************** -->
				<tr style="height:50px;">
					<!-- ------レビューを書くって表示：ここから------ -->
					<td class="bg_02" style="width:443px; text-align:right;" colspan="3">
						<a href="({t_url m=pc a=page_h_review_add_write})&amp;category_id=({$category_id})&amp;asin=({$product.ASIN})">レビューを書く</a>&nbsp;&nbsp;
					</td>
					<!-- ------レビューを書くって表示：ここまで------ -->
					<!-- ------レビューを書く左の線：ここから------ -->
					<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
					<!-- ------レビューを書く左の線：ここまで------ -->
				</tr>
				<!-- ****************************** -->
				<!-- ********書く：ここまで******** -->
				<!-- ****************************** -->
			</table>
		</td>
	</tr>
</table>

<table class="bg_01" border="0" cellspacing="0" cellpadding="0" style="width:636px;">
	<tr>
		<td>
			<td class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
		</td>
	</tr>
</table>
({/foreach})
<!-- *ここまで：検索結果内容＞＞商品情報* -->
<table class="bg_01" border="0" cellspacing="0" cellpadding="0" style="width:636px;">
	<tr>
		<td>
			<td class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy" /></td>
		</td>
	</tr>
</table>
({*ここまで：body*})
({*ここから：footer*})
<!-- ここから：次前表示下段 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;">
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:634px;" class="bg_05" align="right">

<div class="padding_s">

({if $is_prev}) <a href="({t_url m=pc a=page_h_review_add})&amp;keyword=({$keyword|escape:url|smarty:nodefaults})&amp;search_flag=1&amp;category_id=({$category_id})&amp;page=({$page-1})">前を表示</a>&nbsp;&nbsp;({/if})
({$start_num})件～({$end_num})件を表示&nbsp;&nbsp;
({if $is_next}) <a href="({t_url m=pc a=page_h_review_add})&amp;keyword=({$keyword|escape:url|smarty:nodefaults})&amp;search_flag=1&amp;category_id=({$category_id})&amp;page=({$page+1})">次を表示</a>({/if})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：次前表示下段 -->
({*ここから：footer*})
<!-- *ここまで：検索結果内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：検索結果****** -->
<!-- ************************************ -->
({/if})

<img src="./skin/dummy.gif" alt="dummy" class="v_spacer_l">

<img src="./skin/dummy.gif" alt="dummy" class="v_spacer_l">

({***************************})
({**ここまで：メインコンテンツ**})
({***************************})
</td>
</tr>
</table>({*END:container*})
</td>
</tr>
<tr>
<td class="container inc_page_footer">
({$inc_page_footer|smarty:nodefaults})
</td>
</tr>
</table>
({ext_include file="inc_extension_pagelayout_bottom.tpl"})
</body>
</html>
