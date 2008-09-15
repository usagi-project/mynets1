<div style="clear:left;padding:1px;border:#eee 1px solid;">
	<div style="height:25px;position:relative;overflow:hidden;background:url(./skin/default/img/bg_button.gif) left bottom repeat-x;">
		<ul id="tabs">
			<li>
				<a href="#tab1">公開日記</a>
			</li>
			<li>
				<a href="#tab2">公開コミュ</a>
			</li>
		</ul>
	</div>
	<div class="panel" id="tab1">
            <!--公開日記ループ処理-->
            ({foreach from=$diary_list item=item name=diary})
            <div style="padding:3px 5px;({if !$smarty.foreach.diary.last})border-bottom:#cccccc 1px dotted;({/if})">
                <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;">
                ({$item.r_datetime|t_date})…&nbsp;
                <a href="({$smaty.const.OPENPNE_URL})?m=diary&amp;a=page_detail&amp;target_c_diary_id=({$item.c_diary_id})">({$item.subject|t_body:'title'})</a>
            </div>
            ({/foreach})
	</div>
	<div class="panel" id="tab2">
            <!--公開コミュループ処理-->
            ({foreach from=$commu_list item=item name=commu})
            <div style="padding:3px 5px;({if !$smarty.foreach.commu.last})border-bottom:#cccccc 1px dotted;({/if})">
                <img src="({t_img_url_skin filename=icon_2})" style="margin-right:5px;">
                <a href="({$item.url})" class="top">({$item.info|t_body:'title'|t_truncate:"20"})</a>
            </div>
            ({/foreach})
	</div>
</div>
<script type="text/javascript">
    /*タブ初期化*/
    new Fabtabs('tabs', 'tab1');
</script>
