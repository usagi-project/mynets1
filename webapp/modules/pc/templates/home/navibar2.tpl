<div id="menubar2">
({foreach from=$navi_h key=key item=item})
({if $item.url})
<a id="hmenu({$key+1})" href="({$item.url})"><img src="./skin/dummy.gif" title="({$item.caption})"></a>
({/if})
({/foreach})
</div>