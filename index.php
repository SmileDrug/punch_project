<?php
$bool = 0;
if( $_POST['submit'] == 'Submit')
{

	
	$email = $_POST['email'];
	$file = "data.txt";
	$f = fopen ($file, 'a+');
	$cont = $email.''.PHP_EOL;
	fwrite($f, $cont);
	fclose($f);

	$bool = 1;
}

?>




<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="description" content="An awesome coming soon page" />
<meta name="keywords" content="coming, soon, page" />

<title>Punch !T</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div id="coming-soon">

<h1>Punch !T</h1>

<p>Content Here </p>

<?php 

if($bool == 1)
{
?>
  
<p>Thank You for subscribing . We will inform you as soon as possible </p>
<?php
}

?>

<form method="post" action="" >
	<div id="subscribe">
		<input type="email" name="email" id="email" placeholder="enter your email address..." required>
		<input type="submit" name="submit" id="submit" value="Submit">
		<div class="clear"></div>
	</div>
</form>
 
</div>

</body>
</html>