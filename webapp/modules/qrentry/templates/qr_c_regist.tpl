({$inc_ktai_header|smarty:nodefaults})
<table cellSpacing=0 cellPadding=0 width="100%" bgColor=#3399ff border=0>
  <tbody>
  <tr bgColor="#3399ff">
    <td colSpan="2"><div align="center"><font color="#ffffff">QRﾒﾆｭｰ</div></font></td></tr>
  </tbody></table>
({if $msg == ''})
    <div align="center"><p mode="nowrap"><a href="#"><font color="red">利用規約をお読みください</font></a></p></div>
    <blockquote>
    &em_memo;<a href="({t_url m=ktai a=page_o_sns_kiyaku})">利用規約</a><br>
    &em_memo;<a href="({t_url m=ktai a=page_o_sns_privacy})">ﾌﾟﾗｲﾊﾞｼｰﾎﾟﾘｼｰ</a>
    </blockquote>
    <div>&nbsp;&em_pen;<a href="({t_url m=qrentry a=page_qr_regist_input})&amp;ses=({$ses})&amp;c_commu_id=({$c_commu_id})">新規登録はこちら</a><br></div><font size="1"><br></font>
({else})
    ({$msg})
({/if})
<table cellSpacing=0 cellPadding=0 width="100%" bgColor=#3399ff border=0>
  <tbody>
  <tr bgColor="#3399ff">
    <td colSpan="2"><div align="center"><font color="#ffffff">QRﾒﾆｭｰ</div></font></td></tr>
  </tbody></table>
({$inc_ktai_footer|smarty:nodefaults})