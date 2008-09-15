({php})
header('Content-type: text/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>';
({/php})
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="ja">
    <title type="text">({$smarty.const.SNS_NAME})</title>
    ({if $description})<subtitle type="text">({$description})</subtitle>({/if})
    <id>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_home_rss_atom</id>
    <link rel="alternate" type="text/html" href="({$smarty.const.OPENPNE_URL})" />
    <link rel="self" type="application/atom+xml" href="({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_home_rss_atom" />
    <updated>({$date|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</updated>
    <rights>Copyright 2007 ({$smarty.const.SNS_NAME})</rights>
    <generator uri="http://nx2.jp/" version="0.0.1">OpenDiary</generator>
({foreach from=$c_diary_list item=key})
    <entry>
      <title>({$key.subject})</title>
      <link rel="alternate" type="text/html" href="({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_detail&amp;target_c_diary_id=({$key.c_diary_id})" />
      <id>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_detail&amp;target_c_diary_id=({$key.c_diary_id})</id>
      <published>({$key.r_datetime|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</published>
      <updated>({$key.r_datetime|date_format:"%Y-%m-%dT%H:%M:%S+09:00"})</updated>
      <author>
        <name>({$key.c_member_id})</name>
      </author>
      <content type="html"><![CDATA[
({if $key.image_filename_1})
          <img src="({t_img_url filename=$key.image_filename_1 w=120 h=120 _absolute=true})" />
({/if})
({if $key.image_filename_2})
          <img src="({t_img_url filename=$key.image_filename_2 w=120 h=120 _absolute=true})" />
({/if})
({if $key.image_filename_3})
              <img src="({t_img_url filename=$key.image_filename_3 w=120 h=120 _absolute=true})" />
({/if})<br />
          ({$key.body|t_truncate:500})
      ]]></content>
    </entry>
({/foreach})
</feed>
