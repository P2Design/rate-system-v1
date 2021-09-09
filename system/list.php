<?php
    include_once "conn.php";
    ini_set('default_charset','UTF-8');

    $page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_NUMBER_INT);
    $result_page = filter_input(INPUT_POST, 'result_page', FILTER_SANITIZE_NUMBER_INT);
    $index = ($page * $result_page) - $result_page;
    $result_comment = "SELECT * FROM rating ORDER BY id DESC LIMIT $index, $result_page";
    $result_comment_2 = mysqli_query($conn, $result_comment);

    if(($result_comment_2) AND ($result_comment_2->num_rows != 0)){
?>

    <?php while($row_comment = mysqli_fetch_assoc($result_comment_2)){?>
		<div id='box'class='box'>
			<div class='p-data'>
				<div class='p-image'><img src="img/user/<?php echo $row_comment['pic'];?>"></div>
				<h2><?php echo $row_comment['names']; ?></h2>
			</div>
			<h4><?php echo $row_comment['country']; ?> - <?php echo $row_comment['city']; ?></h4>
			<span><?php echo $row_comment['star'];?></span>
			<p><?php echo $row_comment['comment']; ?></p>
		</div>
	<?php } ?>

<?php
    $result_pg = "SELECT COUNT(id) AS num_result FROM rating";
    $result_pg_2 = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($result_pg_2);
    $amount_page = ceil($row_pg['num_result'] / $result_page);
    $max_links = 2;

    echo "<div class='btn-dep'><a href='#' onclick='list_comment(1, $result_page)'><i class='fas fa-chevron-left'></i></a>";

    for($pag_before = $page - $max_links; $pag_before <= $page - 1; $pag_before++){
        if($pag_before >= 1){
            echo " <a href='#' onclick='list_comment($pag_before, $result_page)'>$pag_before</a> ";
        }
    }

    echo "<a class='active'>$page</a>";

    for ($pag_after = $page + 1; $pag_after <= $page + $max_links; $pag_after++){
        if($pag_after <= $amount_page){
            echo "<a href='#' onclick='list_comment($pag_after, $result_page)'>$pag_after</a>";
        }
    }

    echo "<a href='#' onclick='list_comment($amount_page, $result_page)'><i class='fas fa-chevron-right'></i></a></div>";
    }else{
        echo "<div class='alert alert-danger' role='alert'>No comments here, how about leaving one?</div>";
    }
?>