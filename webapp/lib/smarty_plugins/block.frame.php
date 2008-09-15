<?php

function smarty_block_frame($params,$content,&$o_smarty,&$repeat)
{
  if(is_null($content)) return;

  $repeat = false;
  $id = $params['id'];
  $classx = empty($params['class']) ? '' : $params['class'];
  $content = <<<EOT
<div id="$id" class="basestyle $classx">$content</div>
EOT;
  return $content;
}
