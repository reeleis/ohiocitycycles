<html>

<head>
<title>test</title>
</head>

<body>

<pre>
<?php

date_default_timezone_set("America/New_York");

print "date(): " . date('g:i a') . "\n";
print "date(strtotime(gmdate())): " . date('g:i a', strtotime(gmdate("M d Y H:i:s", time()))) . "\n";

if (date_default_timezone_get()) {
  echo 'date_default_timezone_get: ' . date_default_timezone_get() . "\n";
}

if (ini_get('date.timezone')) {
  echo 'date.timezone: ' . ini_get('date.timezone') . "\n";
}

?>
</pre>

</body>
</html>