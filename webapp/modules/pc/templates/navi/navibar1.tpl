({foreach from=$navi_global key=key item=item})
({if $item.url})
<a id="pmenu({$key+1})" href="({$item.url})"><img src="./skin/dummy.gif" alt=""  title="({$item.caption})"></a>
({/if})
({/foreach})
<a id="pmenu9" href="?m=pc&a=do_inc_page_header_logout&sessid=({$PHPSESSID})"><img src="./skin/dummy.gif" title="ログアウト"></a>
