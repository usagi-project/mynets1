({if $msg || $msg1 || $msg2 || $msg3 || $err_msg})
({if $msg})<div align="left"><font color="red">({$msg})</font></div>({/if})
({if $msg1})<div align="left"><font color="red">({$msg1})</font></div>({/if})
({if $msg2})<div align="left"><font color="red">({$msg2})</font></div>({/if})
({if $msg3})<div align="left"><font color="red"">({$msg3})</font></div>({/if})
({foreach from=$err_msg item=item})
<font color="red">({$item})</font></center>
({/foreach})
<hr color="red">
({/if})
