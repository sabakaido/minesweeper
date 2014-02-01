<?php
function create_bomb ($a, $b, $flag) {
  $top = ($a+1) * 20;
  $left = ($b+1) * 20;
  if ($flag == 1) {
    $id = $a . 'bomb' . $b;
print<<<EOF
 <!--  bomb start  -->
    <div
      class="box"
      id="$id"
      style="top:{$top}px;left:{$left}px;"
    >
    </div>
 <!--  bomb end    -->
EOF;
  } else {
    $id = $a . 'to' . $b;
print<<<EOF
<!--  not bomb start  -->
   <div
      class="box"
      id="$id"
      style="top:{$top}px;left:{$left}px;"
   >
   </div>
<!--  not bomb end   -->
EOF;
  }
}
?>
