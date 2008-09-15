({$inc_ktai_header|smarty:nodefaults})
<table cellSpacing=0 cellPadding=0 width="100%" bgColor=#3399ff border=0>
  <tbody>
  <tr bgColor="#3399ff">
    <td colSpan="2"><div align="center"><font color="#ffffff">携帯アドレス登録</div></font></td></tr>
  </tbody>
</table>
({if $error || $msg})
    <div align="center"><p mode="nowrap"><font color="red">エラーがあります</font></p></div>
    ({if $msg})
    ({$msg})<br>
    ({/if})
    ({foreach from=$error item=item})
    <font color="red">({$item})</font><br>
    ({/foreach})

({else})
    <p>IDとパスワードを入力してください。</p>
    ({t_form m=ktai a=do_o_regist_mobileaddress})
    <input type="hidden" name="from_address" value="({$from_address})">
    ID(PCメールアドレス)<br>
    <input type="text" name="username" value="" istyle="3"><br>
    パスワード<br>
    <input type="text" name="password" value="" istyle="3"><br>
    <input type="submit" name="submit" value="送信">
    </form>
({/if})
<br>
<table cellSpacing=0 cellPadding=0 width="100%" bgColor=#3399ff border=0>
  <tbody>
  <tr bgColor="#3399ff">
    <td colSpan="2">
        <div align="center"><a href="({$smarty.const.OPENPNE_URL})">({$smarty.const.SNS_NAME}) TOP</a></div>
    </td></tr>
  </tbody></table>
({$inc_ktai_footer|smarty:nodefaults})
