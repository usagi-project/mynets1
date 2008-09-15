({php})
header('Content-type: text/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>';
({/php})
<rss version="2.0" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:foaf="http://xmlns.com/foaf/0.1/">
   <channel>
      <title>({$smarty.const.SNS_NAME})</title>
      <link>({$smarty.const.OPENPNE_URL})</link>
      <description>({$description})</description>
      <language>ja</language>
      <copyright>Copyright 2006-2007</copyright>
      <lastBuildDate>({$date|date_format:"%a, %d %b %Y %H:%M:%S +0900"})</lastBuildDate>
      <generator>http://nx2.jp/</generator>
      <docs>http://blogs.law.harvard.edu/tech/rss</docs>
({foreach from=$c_diary_list item=key})
           <item>
              <title>({$key.subject})</title>
              <description><![CDATA[
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
              ]]></description>
              <link>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_detail&amp;target_c_diary_id=({$key.c_diary_id})</link>
              <guid>({$smarty.const.OPENPNE_URL})?m=diary&amp;a=page_detail&amp;target_c_diary_id=({$key.c_diary_id})</guid>
              <pubDate>({$key.r_datetime|date_format:"%a, %d %b %Y %H:%M:%S +0900"})</pubDate>
           </item>
({/foreach})
   </channel>
</rss>
