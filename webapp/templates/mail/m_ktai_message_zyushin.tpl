[({$smarty.const.SNS_NAME})]ﾒｯｾｰｼﾞが届いています
({$c_member_to.nickname})さん、こんにちは。
({$CATCH_COPY})({$smarty.const.SNS_NAME})からのお知らせです。

メッセージボックスに({$c_member_from.nickname})さんから
メッセージが届いています。

({if $contents_receive_flag})
件名 : ({$subject})
メッセージ :
({$body|bbcode2del})

({if $is_image_exist})
写真あり

({/if})
({/if})
({$smarty.const.SNS_NAME})ログインページ
({$login_url})
