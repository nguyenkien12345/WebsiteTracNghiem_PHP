<?php include('../connect.php') ?>
<?php
        $search = $_GET["search"];
        $page = $_GET["page"];
        //Lấy ra toàn bộ danh sách câu hỏi
        $sql = $conn->prepare("SELECT * FROM cauhoi WHERE question like '%".$search."%' LIMIT 5 OFFSET " .($page-1)*5); //LIMIT 5 OFFSET 5 lấy ra 5 dòng và bỏ qua 5 dòng
        //Thực hiện câu truy vấn
        $sql->execute();
        //Duyệt lấy ra từng câu hỏi
        $index = 1;
        $data = '';
        while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data .= "<tr id=".$result['id'].">";
            //Các giá trị phải trùng với database
            $data .= "<td>".($index++)."</td>";
            $data .= "<td class='text-success'>".$result["question"]."</td>";
            $data .= "<td>";
            $data .= "<input type='button' class='btn btn-xs btn-info'    value='Xem' name='view'   />&nbsp";
            $data .= "<input type='button' class='btn btn-xs btn-warning' value='Sửa' name='update' />&nbsp";
            $data .= "<input type='button' class='btn btn-xs btn-danger'  value='Xóa' name='delete' />";
            $data .= "</td>";
            $data .= "</tr>";
        }
        echo $data;
?>