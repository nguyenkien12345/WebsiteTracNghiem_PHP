<?php include('../connect.php') ?>
<?php 
    //Lấy id được truyền đi khi click input[name="view"] bên index.html
    $id = $_GET["id"];
    $sql = "SELECT * FROM cauhoi where id = '".$id."'";
    $rs = $conn->prepare($sql);
    $rs->execute();
    $result = $rs->fetch();
    //Trả về dữ liệu kiểu json
    echo json_encode($result);
?>