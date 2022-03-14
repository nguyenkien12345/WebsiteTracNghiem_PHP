<?php include('../connect.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Khai báo modalQuestion -->
    <?php include('modalQuestion.php') ?>
    <div class="container">
        <!-- Button ADD Question -->
        <div class="row">
            <!-- TÌM KIẾM -->
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" id="txtSearch"/>
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit" id="btnSearch">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- PHÂN TRANG -->
            <div class="col-sm-6">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" style="margin:0px;padding-top:0;margin-left:10px" id="pagination">
                    </ul>
                </nav>
            </div>
            <!-- THÊM CÂU HỎI -->
            <div class="col-sm-2 text-right">
                <button id="btnQuestion" class="btn btn-success">Thêm câu hỏi</button>
            </div>  
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Câu hỏi</th>
                    <th></th>
                </tr>
            </thead>

            <tbody id="questions">
            </tbody>
        </table>
    </div>
<script type="text/javascript">
    var page = 1;
    $(document).ready(function(){
        $('#btnSearch').click();
    })

    $('#btnQuestion').click(function(){
        $('#txtQuestionId').val('');
        $('#modalQuestion').modal();
    });

    //Sự kiện của button xem chi tiết câu hỏi
    $(document).on('click','input[name="view"]',function(){
            $(".modal-title").text("INFO QUESTION");
            //Từ thẻ input có name là view tìm đến thẻ tr gần nhất và lấy ra giá trị id của thẻ tr đó
            var trid = $(this).closest('tr').attr('id'); //trid: có nghĩa là table row id
            GetDetail(trid);
            $('#txtQuestion').attr('readonly',true);
            $('#txtOptionA').attr('readonly',true);
            $('#txtOptionB').attr('readonly',true);
            $('#txtOptionC').attr('readonly',true);
            $('#txtOptionD').attr('readonly',true);

            $('#optradioA').attr('disabled', true);
            $('#optradioB').attr('disabled', true)
            $('#optradioC').attr('disabled', true)
            $('#optradioD').attr('disabled', true)

            $('#btnSubmit').hide();
    });

    //Sự kiện của button xem cập nhật câu hỏi
    $(document).on('click','input[name="update"]',function(){
            $(".modal-title").text("UPDATE QUESTION");
            //Từ thẻ input có name là update tìm đến thẻ tr gần nhất và lấy ra giá trị id của thẻ tr đó
            var trid = $(this).closest('tr').attr('id'); //trid: có nghĩa là table row id
            GetDetail(trid);
            $('#txtQuestion').attr('readonly',false);
            $('#txtOptionA').attr('readonly',false);
            $('#txtOptionB').attr('readonly',false);
            $('#txtOptionC').attr('readonly',false);
            $('#txtOptionD').attr('readonly',false);

            $('#optradioA').attr('disabled', false);
            $('#optradioB').attr('disabled', false)
            $('#optradioC').attr('disabled', false)
            $('#optradioD').attr('disabled', false)

            $('#txtQuestionId').val(trid);
            $('#btnSubmit').show();
    });

    //Sự kiện của button xóa câu hỏi
    $(document).on('click','input[name="delete"]',function(){
            //Từ thẻ input có name là update tìm đến thẻ tr gần nhất và lấy ra giá trị id của thẻ tr đó
            var trid = $(this).closest('tr').attr('id'); //trid: có nghĩa là table row id
            if(confirm("Bạn có muốn xóa câu hỏi này không?"))
            {
                $.ajax({
                    url:'deleteQuestion.php',
                    type:'POST',
                    data:{
                        id:trid,
                    },
                success:function(data)
                {
                    alert(data);
                    ReadData();
                }
                });
            }
            $('#btnSubmit').show();
    });

    //Sự kiện của button tìm kiếm
    $('#btnSearch').click(function(){
        let search = $('#txtSearch').val().trim();
        ReadData(search);
        Pagination(search);
    })

    //Sự kiện click nút enter
    $('#txtSearch').on('keypress',function(e){
        if(e.which === 13)
        {
            $("#btnSearch").click();
        }
    })

    function GetDetail(id)
    {
        $.ajax({
        url:'detail.php',
        type: 'GET',
        data:{
            //Tên tham số:giá trị
            id:id,
        },
        success:function(data){
            $('#modalQuestion').modal();
            //Convert kiểu dữ liệu từ string về json
            var q = jQuery.parseJSON(data);
            //Các giá trị trong q[''] phải giống tên tham số trong addQuestion.php
            $('#txtQuestion').val(q['question']);
            $('#txtOptionA').val(q['option_a']);
            $('#txtOptionB').val(q['option_b']);
            $('#txtOptionC').val(q['option_c']);
            $('#txtOptionD').val(q['option_d']);
            switch(q['answer']){
                case 'A':
                    $('#optradioA').prop('checked',true);
                    break;
                case 'B':
                    $('#optradioB').prop('checked',true);
                    break;
                case 'C':
                    $('#optradioC').prop('checked',true);
                    break;
                case 'D':
                    $('#optradioD').prop('checked',true);
                    break;
            }
        }
    });
    }

    function ReadData(search){
        $.ajax({
            url:'view.php',
            type:'GET',
            data:{
                search:search,
                page:page,
            },
            success:function(data){
                // console.log(data);
                //Trước khi đỗ dữ liệu nên làm rỗng để không bị đổ trùng dữ liệu
                $('#questions').empty();
                $('#questions').append(data);
            }
        })
    }

    $("#pagination").on('click','li a',function(e){
        e.preventDefault();
        page = $(this).text();
        ReadData($('#txtSearch').val());
    });

    function Pagination(search){
        $.ajax({
            url:'pagination.php',
            type:'GET',
            data:{
                search:search,
            },
            success:function(data){
                console.log(data);
                //Nếu số trang bé hơn hoặc bằng 1
                if(data<=1)
                {
                    $('#pagination').hide();
                }
                else
                {
                    $('#pagination').show();
                    //Trước khi đỗ dữ liệu nên làm rỗng để không bị đổ trùng dữ liệu
                    $('#pagination').empty();
                    let pagi = '';
                    for(i = 1;i <= data; i++)
                    {
                        pagi += '<li class="page-item"><a href="#" class="page-link">'+i+'</a></li>'
                    }
                    $('#pagination').append(pagi);
                }
            }
        })
    }
</script>
</body>
</html>