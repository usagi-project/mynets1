<?php

function smarty_block_window2($params,$content,&$o_smarty,&$repeat)
{
  if(is_null($content)) return;

  $repeat = false;
  $id = $params['id'];
  $name = $params['name'];
  $titlestyle =$params['title'];
  $borderstyle = "borderstyle";
  if( $params['border'] )
    $borderstyle = $params['border'];
  $classx = empty($params['class']) ? '' : $params['class'];
  $content = <<<EOT
<div id="$id" class="basestyle $classx"><div class="$borderstyle"><div class="$titlestyle">$name</div>$content</div></div>
EOT;

  return $content;
}
