<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => env('PAYPAL_CLIENT_ID', 'AVjLJHZ7H7mukU5-lzieT6MM1euAmV0QSjGjAf3UVwCuihNStjFkJm0zup5bzveBt2144hWpuUc733l5'),
		'ClientSecret' => env('PAYPAL_CLIENT_SECRET', 'ECTIa6lGk_nyLqFuq-2hKlPz23IT7SbXrifLV-SDU0KC_KfTmDNDkGoPYNoXAgWb84l3aqzYQSIcJHHP'),
	),

	# Connection Information
	'Http' => array(
		// 'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),


	# Logging Information
	'Log' => array(
		//'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		//'LogLevel' => 'FINE',
	),
);
