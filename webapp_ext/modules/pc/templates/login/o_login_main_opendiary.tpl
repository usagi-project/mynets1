        <img src="({$smarty.const.OPENPNE_URL})images/login/diary_bar.jpg" />
        <a name="OpenDiary"></a>
        <!--<h2  class="highlighted style3">新着日記</h2>-->
        <!--新着日記のループ-->
        ({foreach from=$diary_list item=item})
            <p><img src="({t_img_url filename=$item.c_member_image w=76 h=76 f=jpg noimg=no_image_small})">&nbsp;
            Posted by <a href="#">({$item.c_member|t_body:'name'})</a></p>
            <h4 class="green style4 style3">({$item.subject|t_body:'title'})</h4>
            <p>
            ({$item.body|bbcode2del|t_truncate:"400"|t_body:'diary'})
            </p>
            ({if $item.image_filename_1})
            <img src="({t_img_url filename=$item.image_filename_1 w=180 h=180})">&nbsp;
            ({/if})
            ({if $item.image_filename_2})
            <img src="({t_img_url filename=$item.image_filename_2 w=180 h=180})">&nbsp;
            ({/if})
            ({if $item.image_filename_3})
            <img src="({t_img_url filename=$item.image_filename_3 w=180 h=180})">&nbsp;
            ({/if})
            <p class="post-footer align-right">
            <a href="({$item.url})" class="readmore"><u>Read more</u></a>
            <span class="date">({$item.r_datetime})</span>
            </p>
            <p class="line"></p>
        ({/foreach})
