({strip})
({if $c_review})
<div class="cmd_review">

<div class="title_bar">
レビュー
</div>

<div class="package">
<a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$c_review.c_review_id})"><img src="({$c_review.image_medium|t_url2x})" class="package_image"></a>
</div>

<div class="detail">
<p class="title">
<a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$c_review.c_review_id})">({$c_review.title|regex_replace:'/([,\/\.\}\)\]]|の|』|」|）)/':'$1&#x200B;'|regex_replace:'/([\[\(]|『|（)/':'&#x200B;$1'})</a>
</p>

<p class="satisfaction">
<img src="({t_img_url_skin filename=satisfaction_level_`$satisfaction.level`})" class="level"> ({$satisfaction.average})点 （({$satisfaction.review_count})人）
</p>

<p class="package_info">
({if $c_review.release_date})({$c_review.release_date})<br>({/if})
({if $c_review.manufacturer})({$c_review.manufacturer})<br>({/if})
({if $c_review.artist})({$c_review.artist})<br>({/if})
({if $c_review.author})({$c_review.author})({/if})
</p>
</div>

<div class="footer">
<div class="category">
カテゴリ：({$c_review.category_disp})
</div>
<div class="more_info">
<img src="./skin/default/img/dummy.gif" class="icon arrow_1"><a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$c_review.c_review_id})">もっと読む</a></div>
</div>

</div>
({/if})
({/strip})
