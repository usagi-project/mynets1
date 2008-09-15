<!-- ******ここから：トピックのコメントを日記で書く****** -->
({if defined('BBCODE_USE_TOPIC_COMMENT_ON_DIARY') && $smarty.const.BBCODE_USE_TOPIC_COMMENT_ON_DIARY})
<img src="./skin/dummy.gif" alt="dummy" class="v_spacer_l">

({literal})
<script type="text/javascript">
<!--
function doQuoteResponseByDiary() {
({/literal})
	var url = "({t_url m=pc})&a=page_h_diary_add";
	url += "&subject=({"【日記："|urlencode})({$c_topic.name|urlencode})({"】について"|urlencode})";
({if defined('BBCODE_USE_TOPIC_COMMENT_ON_DIARY_WITH_BODY') && $smarty.const.BBCODE_USE_TOPIC_COMMENT_ON_DIARY_WITH_BODY})
	url += "&body=({"[topic]"|urlencode})({$c_topic.c_commu_topic_id|urlencode})({"[/topic]\n[quote="|urlencode})({$c_topic.name|urlencode})({"]"|urlencode})({$c_topic.body|urlencode})({"[/quote]"|urlencode})";
({else})
	url += "&body=({"[topic]"|urlencode})({$c_topic.c_commu_topic_id|urlencode})({"[/topic]"|urlencode})";
({/if})
	window.location.href = url;
}
({literal})
//-->
</script>
({/literal})

<a name="topic_comment"></a>

<form action="./" method="post" target="_blank">
<input type="hidden" name="m" value="pc">
<input type="hidden" name="a" value="page_h_diary_add">
<input type="hidden" name="subject" value="【日記：({$c_topic.name})】について">

<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" alt="square" class="square"></td>
<td style="width:524px;" class="bg_00"><img src="./skin/dummy.gif" alt="square" class="square"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" alt="square" class="square"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" alt="square" class="square"></td>
<td class="bg_01" align="center">
<table border="0" cellspacing="0" cellpadding="0" style="width:634px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:598px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">このトピックのコメントを日記で書く</span></td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" style="width:634px;" class="border_01">
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" alt="dot" class="dot"></td>
<td style="width:634px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" alt="dot" class="dot"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" alt="dot" class="dot"></td>
<td class="bg_02" align="center" colspan="3">
<div style="padding:4px 3px;">

({if defined('BBCODE_USE_TOPIC_COMMENT_ON_DIARY_WITH_BODY') && $smarty.const.BBCODE_USE_TOPIC_COMMENT_ON_DIARY_WITH_BODY})
<input type="button" class="submit" title="このトピックを引用して日記を書く" value="日記でコメント" onclick="javascript:doQuoteResponseByDiary();">
({else})
<input type="button" class="submit" title="このトピックのコメントを日記で書く" value="日記でコメント" onclick="javascript:doQuoteResponseByDiary();">
({/if})

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" alt="dot" class="dot"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" alt="dot" class="dot"></td>
</tr>
({*********})
</table>
</td>
<td class="bg_00"><img src="./skin/dummy.gif" alt="square" class="square"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" alt="square" class="square"></td>
<td class="bg_00"><img src="./skin/dummy.gif" alt="square" class="square"></td>
<td class="bg_00"><img src="./skin/dummy.gif" alt="square" class="square"></td>
</tr>
</table>

</form>
({/if})
<!-- ******ここまで：トピックのコメントを日記で書く****** -->
