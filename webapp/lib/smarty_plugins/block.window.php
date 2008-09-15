<?php

function smarty_block_window($params,$content,&$o_smarty,&$repeat)
{
  if(is_null($content)) return;

  $repeat = false;
  $id = $params['id'];
  $name = $params['name'];
  $titlestyle =$params['title'];
  $classx = empty($params['class']) ? '' : $params['class'];
  $content = <<<EOT
<div id="$id" class="basestyle $classx"><div class="$titlestyle">$name</div>$content</div>
EOT;

  return $content;
}
