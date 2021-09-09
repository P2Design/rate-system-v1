<?php
    include_once 'conn.php';

    if(isset($_FILES['pic'])){
        $extensao = strtolower(substr($_FILES['pic']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "../img/user/";
        $names = $_POST['names'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $star = $_POST['star'];
        $star_implode = implode(",",$star);
        $comment = $_POST['comment'];   

        move_uploaded_file($_FILES['pic']['tmp_name'], $diretorio.$novo_nome);

        $sql_code = 'INSERT INTO rating VALUES';
        $sql_code .= "(null, '$novo_nome','$names', '$email', '$country', '$city','$star_implode','$comment')"; 
        
        if( $conn->query($sql_code) === TRUE){
            echo "<div class='ty'><h2>Thanks for comment!</h2>";
            echo "<a href='rate.php'>Comment again</a></div>";
        } else{
            echo "Erro: ".$sql_code."<br>". $conn->error;
        }
    }
?>

<style>
    .ty{
        width: 100%;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }.ty h2{
        color: #7773F1;
        font-size: 20px;
    }.ty a{
        color: #534EF1;
        font-size: 30px;
    }
</style>