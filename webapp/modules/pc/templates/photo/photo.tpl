({frame id="photo" class="border_07 bg_05"})
  ({frame id="photo-inner" class="border_07 bg_05"})
    <img src="({t_img_url filename=$c_member.image_filename w=180 h=180 noimg=no_image})" alt="写真"/><br/>
    <a href="({t_url m=pc a=page_h_config_image})">
    <img src="({t_img_url_skin filename=button_edit_photo})"/></a><br/>
    <a href="({t_url m=pc a=page_h_prof})">
    <img src="({t_img_url_skin filename=button_prof_conf})"/></a>
  ({/frame})
  ({$c_member.nickname|t_body:'name'})さん (({$c_friend_count}))
({/frame})