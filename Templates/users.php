<h2>Users</h2>
<button id="btnOpenForm" class="btn">
    Open form
</button>
<div id="formContainer" class="panel panel-default">
	<h3>Form</h3>
	<a href="#listContainer">Go to the list</a>

	<?php if ($error !== '') { ?>
	<div class="alert alert-danger" role="alert">
	  <?php echo $error ?>
	</div>
	<?php } ?>
	<form method="post" action="index.php">
		<input type="hidden" name="save" value="1">
		<input type="hidden" name="id" value="<?php echo $user->id ?>">
		
		<div class="form-group required col-md-6">
			<label class="control-label" for="salutation">Salutation</label>
			<select id="salutation" name="salutation" class="form-control">
				<option value="">Choose a Salutation</option>
				<option value="Mr."<?php if ($user->salutation === "Mr.") { echo ' selected="selected"'; } ?>>Mr.</option>
				<option value="Ms."<?php if ($user->salutation === "Ms.") {  echo ' selected="selected"'; } ?>>Ms.</option>
				<option value="Mrs."<?php if ($user->salutation === "Mrs.") {  echo ' selected="selected"'; } ?>>Mrs.</option>
				<option value="Dr."<?php if ($user->salutation === "Dr.") {  echo ' selected="selected"'; } ?>>Dr.</option>
			</select>
		</div>
		<div class="form-group required col-md-6">
			<label class="control-label" for="first_name">First Name</label>
			<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"
					<?php if ($user->first_name !== '') {  echo ' value="' . $user->first_name . '"'; } ?>>
		</div>
		<div class="form-group required col-md-6">
			<label class="control-label" for="last_name">Last Name</label>
			<input type="text" class="form-control" id="last_name" name="last_name" placeholder="last Name"
					<?php if ($user->last_name !== '') {  echo ' value="' . $user->last_name . '"'; } ?>>
		</div>
		<div class="form-group required col-md-6">
			<label class="control-label" for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Email"
					<?php if ($user->email !== '') {  echo ' value="' . $user->email . '"'; } ?>>
		</div>
		<div class="form-group required col-md-6">
			<label class="control-label" for="contry_id">Country</label>
			<select id="country_id" name="country_id" class="form-control">
				<option value="0">Choose a Country</option>
				<?php foreach ($countries as $country) { ?>
					<option value="<?php echo $country->id ?>"<?php if ($user->country_id === $country->id) {  echo ' selected="selected"'; } ?>>
						<?php echo $country->name ?>
					</option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group col-md-6">
			<label class="control-label" for="zip">Zip Code</label>
			<input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Code"
					<?php if ($user->zip !== '') {  echo ' value="' . $user->zip . '"'; } ?>>
		</div>
		<div class="form-group required col-md-6">
			<label class="control-label" for="expected_purchase_date">Expected Purchase Date</label>
			<input type="text" class="form-control" id="expected_purchase_date" name="expected_purchase_date" placeholder="Expected Purchase Date"
					<?php if ($user->expected_purchase_date !== null) { echo ' value="' . $user->expected_purchase_date->format('Y-m-d') . '"'; } ?>>
		</div>
		<div class="form-group required col-md-6">
			<label class="control-label" for="asset_class">Asset Class</label>
			<select id="asset_class" name="asset_class" class="form-control">
				<option value="">Choose an Asset Class</option>
				<option value="large"<?php if ($user->asset_class === 'large') {  echo ' selected="selected"'; } ?>>Large</option>
				<option value="mid"<?php if ($user->asset_class === 'mid') {  echo ' selected="selected"'; } ?>>Mid</option>
				<option value="small"<?php if ($user->asset_class === 'small') {  echo ' selected="selected"'; } ?>>Small</option>
			</select>
		</div>
		<div class="form-group required col-md-6">
			<label class="control-label" for="investment_time_horizon">Investment Time Horizon</label>
			<select id="investment_time_horizon" name="investment_time_horizon" class="form-control">
				<option value="">Choose an Investment Horizon</option>
				<option value="short"<?php if ($user->investment_time_horizon === 'short') {  echo ' selected="selected"'; } ?>>Short</option>
				<option value="medium"<?php if ($user->investment_time_horizon === 'medium') {  echo ' selected="selected"'; } ?>>Medium</option>
				<option value="long"<?php if ($user->investment_time_horizon === 'long') {  echo ' selected="selected"'; } ?>>Long</option>
			</select>
		</div>
		<div class="form-group col-md-6">
			<label class="control-label" for="comments">Comments</label>
			<textarea class="form-control" id="comments" name="comments"><?php echo $user->comments ?></textarea>
		</div>
		<div class="form-group required col-md-6">
			<label class="control-label">Add to Mailing</label><br>
			<label class="checkbox-inline">Yes</span>
			<input type="radio" id="in_mailing_on" name="in_mailing" value="1"
					<?php if ($user->in_mailing == 1) {  echo ' checked="checked"'; } ?>>
			<label class="checkbox-inline">No</label>
			<input type="radio" id="in_mailing_off" name="in_mailing" value="0"
					<?php if ($user->in_mailing == 0) {  echo ' checked="checked"'; } ?>>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
		<button type="button" id="btnReset" class="btn btn-secondary">Reset</button>
	</form>
</div>

<?php if ($user->id > 0 || $error !== '') { ?>
<script>
	$('#formContainer').show();
</script>
<?php } ?>

<?php if (isset($users)) { ?>
<h3>List</h3>
<a href="#formContainer">Go to the form</a>

<div class="panel panel-default">
	<?php if (count($users) === 0) { ?>
	    <div class="alert alert-warning">No User</div>
	<?php } else { ?>
		<div id="listContainer" class="table-responsive">
			<?php if ($success !== '') { ?>
			<div class="alert alert-success" role="alert">
			  <?php echo $success ?>
			</div>
			<?php } ?>
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Added to Mailing</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $user) { ?>
					<tr>
						<td><?php echo $user->id ?></td>
						<td><?php echo $user->last_name . ' ' . $user->first_name ?></td>
						<td>
							<a href="mailto:<?php echo $user->email ?>"><?php echo $user->email ?></a>
						</td>
						<td><?php echo ($user->in_mailing == 1) ? 'Yes' : 'No' ?></td>
						<td>
							<button class="btn btn-primary btn-edit-user" data-id="<?php echo $user->id ?>">
								Edit
							</button>
							<button class="btn btn-danger" data-href="index.php?delete=<?php echo $user->id ?>" data-toggle="modal" data-target="#confirm-delete">
								Delete
							</button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
    <?php } ?>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header" style="display: block">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="deleteUserModal">Confirm Delete</h4>
			</div>
		
			<div class="modal-body">
				<p>You are about to delete this User.</p>
				<p>Do you want to proceed?</p>
				<p class="debug-url"></p>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a class="btn btn-danger btn-ok">Delete</a>
			</div>
		</div>
	</div>
</div>
<?php } ?>
