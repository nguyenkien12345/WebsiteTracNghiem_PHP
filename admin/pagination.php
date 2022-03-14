<?php include('../connect.php') ?>
<?php
        $search = $_GET["search"];
        //Lấy ra toàn bộ danh sách câu hỏi
        $sql = $conn->prepare("SELECT * FROM cauhoi WHERE question like '%".$search."%'"); 
        $sql->execute();
        $count = $sql->rowCount();
        //count: tổng số trang
        $pages = $count%5==0 ? $count/5 : floor($count/5)+1;
        echo json_encode($pages);
?>