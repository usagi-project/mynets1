<a name="bottom"></a><br>
({if $help})
&em_9square;<a href="({t_url m=ktai a=page_help})&amp;page=({$help})({if $tail})&amp;({$tail})({/if})"  accesskey="9">ﾍﾙﾌﾟ</a><br>
({/if})
({if $tail})
&em_0square;<a href="({t_url m=ktai a=page_h_home})&amp;({$tail})#top"  accesskey="0">ﾎｰﾑ</a><br>
({/if})
<font color="blue">＊</font><a href="#top" accesskey="*">▲</a>
<font color="blue">＃</font><a href="#bottom" accesskey="#">▼</a> 
<br>
({$inc_ktai_footer|smarty:nodefaults}) ({strip})
</body>
</html>
({/strip})
