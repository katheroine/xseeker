<!DOCTYPE html>
<html>
<head>
	<title>XSeeker</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="content-style-type" content="text/css">
	<meta name="description" content="XLab RSS channel search engine">
	<meta name="keywords" content="XSeeker, XLab">
	<meta name="author" content="Katarzyna Krasińska">
	<link rel="stylesheet" type="text/css" href="./application/assets/main.css">
	<link href='http://fonts.googleapis.com/css?family=Average+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="application">
		<div id="header">
			<a id="logo" href="/"></a>
		</div>
		<div id="menu">
			<a id="xlab" href="http://xlab.pl/">XLab</a>
			<a id="xsolve" href="http://www.xsolve.pl/">XSolve</a>
			<a id="contact" href="mailto:katarzyna.krasinska@onet.pl">Kontakt</a>
		</div>
		<?php include( __DIR__ . '/' . $view . '.php') ?>
		<div id="footer">
			<a href="mailto:katarzyna.krasinska@onet.pl">Katarzyna Krasińska</a> 2014
		</div>
	</div>
</body>
</html>