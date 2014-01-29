
<?php
	$con = mysqli_connect("localhost","root","","search_db") or die('Error in connection');
	$data='';
	if(isset($_POST['search']))
	{
		$str = $_POST['search'];
		$str = preg_replace("#[^0-9a-z]#i","",$str);
		$query = "select username from users where username LIKE '%$str%'";
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result);
		if($count>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$data = $data."<div>".$row['username']."</div>";
			}
			echo $data;
		}
	
	}else
	{
?>
<html>
<head>
	<title>PHP SEARCH</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-git2.min.js" ></script>
	<script>
		$(function(){
			$('.input').keyup(function(){
				var search = $('.input').val();
				$.post("index.php",{"search":search},function(data){
					$('.entry').html(data);
				});
			});
		});
	</script>
</head>
<body>
	<form action="index.php" method="post">
		<input type="text" name="search" class="input" />
		<input type="submit" value="search"/>
	</form>
	<div class="entry"></div>
</body>
</html>
<?php
}
?>