$( function() {
	$( "#expected_purchase_date" ).datepicker({
	  dateFormat: "yy-mm-dd"
	});
	
	$( "#btnReset" ).on('click', function() {
	  $( "#id" ).val(0);
	  $( "#country_id" ).val(0);
	  $( "#salutation" ).val('');
	  $( "#first_name" ).val('');
	  $( "#last_name" ).val('');
	  $( "#email" ).val('');
	  $( "#zip" ).val('');
	  $( "#expected_purchase_date" ).val('');
	  $( "#investment_time_horizon" ).val('');
	  $( "#asset_class" ).val('');
	  $( "#comments" ).val('');
	  $( "#in_mailing_off" ).prop("checked", true);
	});
	
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
	
	$('.btn-edit-user').on('click', function(e) {
		let id = $(this).data('id');
		let url = 'index.php?id=' + id;
		
		$(location).attr('href', url);
	});
	
	$('#btnOpenForm').on('click', function(e) {
		$('#formContainer').show();
	});
});
