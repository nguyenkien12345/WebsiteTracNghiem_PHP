<?php include('../connect.php'); ?>
<?php
        try
        {
            //Các giá trị POST nhận về chính là tên tham số khi data bên modalQuestion truyền đi
            $id = $_POST["id"];
            $sql = "DELETE FROM cauhoi WHERE id = '".$id."'";
            if($conn->query($sql) == TRUE)
            {
            echo "Xóa câu hỏi thành công";
            }
            else
            {
            echo "Xóa câu hỏi thất bại";
            }
        }
        catch(Exception $e)
        {
            echo "Lỗi: " + $e;
        }
?>