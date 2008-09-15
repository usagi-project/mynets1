        <a name="OpenCommu"></a>
        <img src="({$smarty.const.OPENPNE_URL})images/login/community_bar.jpg" />
        <!--<h2 class="highlighted style3">コミュニティ</h2>-->
        ({foreach from=$commu_list item=item})
            <h4 class="green style2 style4">({$item.name|t_body:'title'})</h4>
            ({if $item.image_filename})
            <p>
            <img src="({t_img_url filename=$item.image_filename w=120 h=120 f=jpg noimg=no_image_small})" alt="({$item.name|t_body:'title'})" />
            </p>
            ({/if})
            <p>
            ({$item.info|bbcode2del|t_truncate:"400"|t_body:'diary'})
            </p>
            <p class="line"></p>
        ({/foreach})
