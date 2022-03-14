<?php include('../connect.php'); ?>
<?php 
    try
    {
        //Các giá trị POST nhận về chính là tên tham số khi data bên modalQuestion truyền đi
        $question = $_POST["question"];
        $option_a = $_POST["option_a"];
        $option_b = $_POST["option_b"];
        $option_c = $_POST["option_c"];
        $option_d = $_POST["option_d"];
        $answer   = $_POST["answer"];

        // $sql = "INSERT INTO `cauhoi`(`question`,`option_a`,`option_b`,`option_c`,`option_d`,`answer`) 
        // VALUES ('$question','$option_a','$option_b','$option_c','$option_d','$answer')"

        $sql = "INSERT INTO cauhoi(question,option_a,option_b,option_c,option_d,answer)";
        $sql = $sql."VALUES ('".$question."','".$option_a."','".$option_b."','".$option_c."','".$option_d."','".$answer."')";

        if($conn->query($sql) == TRUE)
        {
            echo "Thêm câu hỏi thành công";
        }
        else
        {
            echo "Thêm câu hỏi thất bại";
        }
    }
    catch(Exception $e)
    {
        echo "Lỗi: " + $e;
    }
?>