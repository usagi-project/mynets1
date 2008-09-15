({$inc_header|smarty:nodefaults})

<h2>世代別メンバー数表示</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<p>SNSメンバーの世代別メンバー分布を表示します</p>
<table class="basicType2">
({****})
<thead>
<tr>
<th>
年齢
</th>
<th>
人数
</th>
</tr>
</thead>
({****})
<tbody>
({****})
({foreach from=$analysis_generation key=key item=item})
<tr>
    <th>({$key})</th>
    <td>({$item})人</td>
</tr>
({/foreach})
</tbody>
<tfoot>
<tr>
    <th width="100">合計</th>
    <td>({$analysis_generation_sum})人</td>
</tr>
</tfoot>
</table>

({$inc_footer|smarty:nodefaults})
