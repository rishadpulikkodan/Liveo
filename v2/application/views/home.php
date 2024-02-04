<!DOCTYPE html>
<html>
<head>
	<title>Livio</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link href="<?=base_url()?>res/css/micons.css" rel="stylesheet">
	<script src="<?=base_url()?>res/js/jquery.js"></script>
	<style type="text/css">
		button{
			width: 100%;
			height: 20vh;
			font-size: 5vh;
		}
	</style>
</head>
<body>
	<a href="<?=base_url()?>guest">
		<button><i class="material-icons">&#xe8d3;</i> Guest</button>
	</a>
	<br><br>
	<a href="<?=base_url()?>user">
		<button><i class="material-icons">&#xe853;</i> User</button>
	</a>
	<br><br>
	<p align="center">About<br/><br/>
		Demo live video + location <br><br>
	Powerd By Firmtech<br/>
	&copy; <?php echo date('Y'); ?> <!-- <a target="_blank" href="https://firmtech.tech"> -->firmtech<!-- </a> -->
	</p>
</body>
</html>