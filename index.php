<!DOCTYPE HTML>
<html lang="en">  
    <head>  
        <meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<script src="https://kit.fontawesome.com/bb3381b8a2.js" crossorigin="anonymous"></script>
		<title>Comment Page</title>
    </head>
<body>
	<div class="container">
		<span id="content"></span>
	</div>
		
	<script>
		var result_page = 6;
		var page = 1;
		$(document).ready(function () {
			list_comment(page, result_page);
		});
			
		function list_comment(page, result_page){
			var dados = {
				page: page,
				result_page: result_page
			}
			$.post('system/list.php', dados , function(retorna){
				$("#content").html(retorna);
			});
			}
		</script>
    </body>
</html>
