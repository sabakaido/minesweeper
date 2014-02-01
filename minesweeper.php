<?php
include 'header.html';
ini_set('display_errors','Off');
require_once 'function/create_bomb.php';
?>

<body style="background-color:dimgray;"> 
<div data-role="page">

<!-- content -->
<div data-role="content">
<?php
// 初期値
$width=20;
$height=20;
$bombnum=0;
$num = 10;

for ($i=0;$i<$width;$i++) {
  for ($j=0;$j<$height;$j++) {
    if (rand(1,10) == 1) {
      $num--;
      $bombnum++;
      $array[$i][$j] = 1;
      create_bomb($i, $j, 1);
    } else {
      $array[$i][$j] = 0;
      create_bomb($i, $j, 0);
    }
  }
}
?>

</div>
<!-- /content -->

<script type="text/javascript">
<!--
     var number=0;
     var bombs = <?php echo $bombnum ?>;
     hairetsu = new Array();
     var isTouch = ('ontouchstart' in window);
     <?php
     // 周囲の爆弾数
     for ($i=0;$i<$width;$i++) {
       for ($j=0;$j<$height;$j++) {
	 $flag = 0;
         if ($array[$i][$j] == 1) {
	   $bomb_not[$i][$j] = 'bomb';
	 } else {
	   $flag += $array[$i][$j+1];
	   $flag += $array[$i+1][$j];
	   $flag += $array[$i+1][$j+1];
	   $flag += $array[$i-1][$j-1];
	   $flag += $array[$i-1][$j];
	   $flag += $array[$i-1][$j+1];
	   $flag += $array[$i][$j-1];
	   $flag += $array[$i+1][$j-1];
	   $array_flag[$i][$j] = $flag;
	   $bomb_not[$i][$j] = 'to';
	 }
       }
     }
     for ($i=0;$i<$width;$i++) {
       for ($j=0;$j<$height;$j++) {
     ?>
     $('<?php echo "#" . $i . $bomb_not[$i][$j] . $j ?>').bind({'touchstart mousedown' : function(e) {
	   e.preventDefault();
	   
	   <?php
             // 爆弾だったら
	     if ($array[$i][$j]) {
	   ?>

	     $(this).css({'background-color':'red'});
	     window.alert("GAME OVER");
	     document.location.reload(true);

	   <?php
             // 爆弾じゃなかったら
	     } else if ($array_flag[$i][$j] == 0) {
	       $stack = array();
	       $store = array();
	       $stack[] = $i . "to" . $j;

               // 押されたときに一緒にオープンするやつ
	       while ($stack) {
		 $pop = array_pop($stack);
		 preg_match('/(^.+?)to(.+)/',$pop,$pop_array);
		 if ($array_flag[$pop_array[1]][$pop_array[2]]) {
		   $store[$pop]++;
		 } else {
	           for ($a=0;$a<3;$a++) {
		     for ($b=0;$b<3;$b++) {
                       // 端っこチェック
		       if ($pop_array[1]-$a+1<0 or
                           $pop_array[1]-$a+1>($width - 1) or
                           $pop_array[2]-$b+1<0 or
                           $pop_array[2]-$b+1>($height - 1)
                          ) continue;
		       if (!(array_key_exists(($pop_array[1]-$a+1) . "to" . ($pop_array[2]-$b+1), $store)) &&
                           !($array_flag[$array_flag[$pop_array[1]-$a+1]][$pop_array[2]-$b+1]))
			 $stack[] = ($pop_array[1]-$a+1) . "to" . ($pop_array[2]-$b+1);
		       $store[($pop_array[1]-$a+1) . "to" . ($pop_array[2]-$b+1)]++;
		     }
		   }
                 }
		 if (!$stack) {
		   break;
		 }
               }
	       foreach ($store as $key => $value) {
		 preg_match('/(^.+?)to(.+)/', $key, $hoge);
	 ?>
		 $('#<?php echo $key ?>').css({'background-color':'lightgrey'});
		 <?php if ($array_flag[$hoge[1]][$hoge[2]]) { ?>
  		 $('#<?php echo $key ?>').text('<?php echo $array_flag[$hoge[1]][$hoge[2]] ?>');
		 <?php } ?>
		 
		 if (!("<?php echo $key ?>" in hairetsu)){
		     hairetsu["<?php echo $key ?>"] = 1;
		     number++;
		 }
		 <?php
		     }
	     } else {
	       ?>
	     $(this).css({'background-color':'lightgrey'});
	     $(this).text('<?php echo $array_flag[$i][$j] ?>');
	     if (!("<?php echo $i . 'to' . $j ?>" in hairetsu)) {
	       hairetsu["<?php echo ($i . 'to' . $j) ?>"]=1;
	       number++;
	     }
	     
	     <?php } ?>
	       if ((number + bombs) == <?php echo ($height * $width) ?>) {
		 window.alert("よくできました");
	       }
	     }
	 
	 });
         
         <?php }} ?>
-->
  </script>
</div>
<!-- /page -->

</body>
</html>
