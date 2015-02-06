<?php 
	use yii\helpers\Html;
	
	$this->title = 'Update Permission';
?>
<div class="col-md-12">
	<?php echo Html::beginForm( $action = '', $method = 'post', $options = []); ?>
	
	<div class="row">
		<div class="col-md-2"><h4>Select Role</h4></div>
		<div class="col-md-10">
			<?php 
				echo Html::dropDownList('permission', $selection = null, $usersRole, $options = ['style'=>'padding: 5px; width: 200px; margin-top: 9px;', 'id'=>'userRoleParent']); 
			?>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-md-2"><h4>Select Role</h4></div>
		<div class="col-md-10">
			<?php 
				unset($usersRole[0]);
				echo Html::dropDownList('permission_child', $selection = null, $usersRole, $options = ['style'=>'padding: 5px; width: 200px; margin-top: 9px;', 'multiple' => 'multiple', 'id'=>'userRoleChild']); 
			?>
		</div>
	</div>
	<br><br>
	<?php echo Html::submitButton('Save Permission', ['class'=>'btn btn-success pull-right']);?>
	<table class="table table-hover table-bordered" id="permissionSectionBody">
      <thead>
        <tr>
          <th>Controller </th>
          <th>Action</th>
          <th>Permission</th>
        </tr>
      </thead>
      <tbody>
		<?php 
			if($allAuthItem){
				foreach($allAuthItem as $key=>$value){
					$name = explode(":", $value['name']);
		?>
		<tr>
			<td><?php echo $name[0].' - '.$name[1]; ?></td>
			<td><?php echo $name[2]; ?></td>
			<td><?php echo Html::checkbox($value['name']); ?></td>
		</tr>
		<?php } } ?>
	  </tbody>
	</table>
	<?php echo Html::submitButton('Save Permission', ['class'=>'btn btn-success pull-right']);?>
	<?php echo Html::endForm(); ?>
</div>