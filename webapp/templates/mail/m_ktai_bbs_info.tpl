[({$smarty.const.SNS_NAME})]({$commu_name})(({$topic_name}))
({$nickname})>>

({$body|bbcode2del})

({if $image_filename1 || $image_filename2 || $image_filename3})
[画像あり]
({/if})

({$url})