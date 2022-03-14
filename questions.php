<?php include('connect.php') ?>
<?php
    //Lấy ngẫu nhiên 5 câu hỏi bất kì
    $sql = $conn->prepare("SELECT * FROM cauhoi ORDER BY RAND() LIMIT 5");
    //Thực hiện câu truy vấn
    $sql->execute();
    //Duyệt lấy ra từng câu hỏi
    // $index = 1;
    //Cách 1
    // $data = '';
    // while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
    // $data.= '<div class="row" style="margin-left:10px">';
    // $data.=    '<h5 style="font-weight:bold;"><span class="text-danger">Câu '.$index.': </span>'.$result['question'].'</h5>';
    // $data.=    '<fieldset id="group'.$index.'">';
    // $data.=    '<div class="col-md-12">';
    // $data.=        '<div class="radio">';
    // $data.=            '<label for=""><input type="radio" class="optradioA" name="group'.$index.'"/><span class="text-danger">A: </span>'.$result['option_a'].'</label>';
    // $data.=        '</div>';
    // $data.=    '</div>';
    // $data.=    '<div class="col-md-12">';
    // $data.=        '<div class="radio">';
    // $data.=            '<label for=""><input type="radio" class="optradioB" name="group'.$index.'"/><span class="text-danger">B: </span>'.$result['option_b'].'</label>';
    // $data.=         '</div>';
    // $data.=    '</div>';
    // $data.=    '<div class="col-md-12">';
    // $data.=        '<div class="radio">';
    // $data.=            '<label for=""><input type="radio" class="optradioC" name="group'.$index.'"/><span class="text-danger">C: </span>'.$result['option_c'].'</label>';
    // $data.=        '</div>';
    // $data.=    '</div>';
    // $data.=    '<div class="col-md-12">';
    // $data.=       '<div class="radio">';
    // $data.=           '<label for=""><input type="radio" class="optradioD" name="group'.$index.'"/><span class="text-danger">D: </span>'.$result['option_d'].'</label>';
    // $data.=        '</div>';
    // $data.=    '</div>';
    // $data.=    '</fieldset>';
    // $data.=    '<input type="hidden" name="answer" value="'.$result['answer'].'"/>';
    // $data.='</div>';
    // // Do ban đầu index đang là 1 nếu ta để index++ ở trên thì lúc này index sẽ bắt đầu từ 2.
    // $index++;
    // }
    // echo $data;

    // Cách 2
    $result = $sql->fetchAll(PDO::FETCH_ASSOC); //fetchAll Lấy ra toàn bộ danh sách. fetch là chỉ lấy ra 1 thằng
    echo json_encode($result,JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE hỗ trợ unicode
?>