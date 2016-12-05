<h2>New Scan</h2>
<br>

<p><?php echo Html::anchor(Uri::current().'?store_id=1', 'Carcasse'); ?> | <?php echo Html::anchor(Uri::current().'?store_id=2', 'Prodotto finito'); ?></p>

<?php echo render('admin/scans/_form'); ?>


<p><?php echo Html::anchor('admin/scans', 'Back'); ?></p>
