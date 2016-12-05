<h2 class="noprint">Print QR Code for <?php echo $code->code ." - ". $store . ' - Posizione: '.$code->position ; ?> | id:<?php echo $code->id; ?></h2>
<h1 class="print"><?php echo $code->code ." - ". $store; ?></h1>

<?php
/* 1601151308 */
//$qr_code_str="http://store.codice.cc/admin/scans/create?code_id=".$code->id;
$qr_code_str="http://magazzino.demax.cc/admin/scans/create?code_id=".$code->id;
$qr_code_img="<img src=\"https://chart.googleapis.com/chart?chs=400x400&chld=L|2&cht=qr&chl=".$qr_code_str."&choe=UTF-8\" title=\"QR Code per la carta:\" />";
/* \1601151308 */
?>
<p><?php echo $qr_code_img;?></p>

<div class="noprint">
	<a href="#" onClick="window.print()" class="btnPrint">Print</a> | 
	<?php echo Html::anchor('admin/codes', 'Back'); ?>
</div>
