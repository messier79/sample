<h2>Unit Tests</h2>
<h4>Validation</h4>
<ul id="testsResults">
</ul>

<script>
	$.ajaxSetup({async:false});

    let urls = [
	    'tests.php?test=NoCountry',
	    'tests.php?test=InvalidCountry',
	    'tests.php?test=NoSalutation',
	    'tests.php?test=InvalidSalutation',
	    'tests.php?test=NoFirstName',
	    'tests.php?test=LongFirstName',
	    'tests.php?test=NoLastName',
	    'tests.php?test=LongLastName',
	    'tests.php?test=NoEmail',
	    'tests.php?test=WrongEmail',
	    'tests.php?test=NoInMailing',
	    'tests.php?test=WrongInMailing',
	    'tests.php?test=NoAssetClass',
	    'tests.php?test=WrongAssetClass',
	    'tests.php?test=NoInvestmentTimeHorizon',
	    'tests.php?test=WrongInvestmentTimeHorizon',
	    'tests.php?test=NoExpectedPurchaseDate',
	    'tests.php?test=WrongExpectedPurchaseDate',
	    'tests.php?test=PastExpectedPurchaseDate',
	    'tests.php?test=LongComments',
	    'tests.php?test=NoZipForUsa',
	    'tests.php?test=WrongZipForUsa',
	    'tests.php?test=NegativeZipForUsa',
	    'tests.php?test=ZeroZipForUsa',
	];
	let testResult = 'ERR';
	
	for (let i = 0 ; i < urls.length ; i++) {
		$.get(urls[i], function(data) {
    		$("#testsResults").append($("<li>").html(data));
		});
		testResult = 'ERR';
	}
</script>