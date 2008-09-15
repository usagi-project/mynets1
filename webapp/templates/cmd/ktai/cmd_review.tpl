({strip})
({if $c_review})
<hr>
<div align="left">
【おすすめﾚﾋﾞｭｰ】<br>
<br>
<font size="2">({$c_review.title|mb_convert_kana:'ak':'UTF-8'})</font><br>

<center>
<img src="({$c_review.image_medium|t_url2x})"><br>
</center>

<img src="({t_img_url_skin filename=satisfaction_level_`$satisfaction.level`})"> ({$satisfaction.average})点（({$satisfaction.review_count})人）<br>
({if $c_review.release_date})({$c_review.release_date})<br>({/if})
({if $c_review.manufacturer})({$c_review.manufacturer|mb_convert_kana:'ak':'UTF-8'})<br>({/if})
({if $c_review.artist || $c_review.author})({$c_review.artist|mb_convert_kana:'ak':'UTF-8'})({$c_review.author|mb_convert_kana:'ak':'UTF-8'})<br>({/if})
（({$c_review.category_disp})）<br>

<a href="({$amazon_url|t_url2x})">AMAZONで詳細を見る</a>
</div>
<hr>
({/if})
({/strip})
