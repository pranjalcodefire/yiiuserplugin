<?php 
	use yii\helpers\Html;
	if($allAuthItem){
		foreach($allAuthItem as $key=>$value){
			$name = explode(":", $value['name']);
			
?>
<tr>
	<td><?php echo $name[0].' - '.$name[1]; ?></td>
	<td><?php echo $name[2]; ?></td>
		<?php if(in_array($value['name'], $childChildAction)){ ?>
			<td class="danger">
			<?php echo Html::checkbox($value['name'], true); ?>
			</td>
		<?php }elseif(in_array($value['name'], $mainChildAction)){ ?>
			<td class="success">
			<?php echo Html::checkbox($value['name'], true);  ?>
			</td>
		<?php }else{ ?>
			<td>
			<?php echo Html::checkbox($value['name']); ?>
			</td>
			<?php } ?>
</tr>
<?php } } ?>