<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Làm bài thi trắc nghiệm</title>
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">Làm Bài Thi</div>
                <div class="panel-body">
                    <!-- START -->
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button type="button" name="button" class="btn btn-success" id="btnStart">Bắt đầu</button>
                        </div>
                    </div>
                    <!--  -->
                    <!-- Câu hỏi và câu trả lời -->
                   <div id="questions"></div>
                    <!--  -->
                    <!-- END -->
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button type="button" name="button" class="btn btn-warning" id="btnFinish">Kết thúc bài thi</button>
                        </div>
                    </div>
                    <!--  -->
                    <!-- MARK -->
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4 id="mark" class="text-info"></h4>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var questions;
    $(document).ready(function(){
        $("#btnFinish").hide();
    })

    //Sự kiện nút Start bắt đầu làm bài
    $("#btnStart").click(function(){
        GetQuestions();
        $("#btnFinish").show();
        $(this).hide();
    });

    //Sự kiện nút Finish kết thúc làm bài
    $("#btnFinish").click(function(){
        $(this).hide();
        $('#btnStart').show();
        CheckResult();
    });

    function CheckResult(){
        let mark = 0;
        //Lấy câu hỏi ra
        $("#questions div.row").each(function(k,v){
            //Bước 1: Lấy đáp án đúng của câu hỏi.
            let id = $(v).find('h5').attr('id');   //Lấy id của câu hỏi ra thông qua thẻ h5
            let question = questions.find(x=>x.id == id)   //Tìm câu hỏi trong mảng questions dựa vào id đã có ở trên
            let answer = question['answer'];   //Lấy đáp án của từng câu hỏi
            //Bước 2: Lấy đáp án của người dùng ~ thằng radio nào được check
            let choice = $(v).find('fieldset input[type="radio"]:checked').attr('class');
            if(choice == answer)
            {
                console.log("Câu có id "+id+" đúng");
                mark += 2;
            }
            else
            {
                console.log("Câu có id "+id+" sai");
            }
            //Bước 3 đánh dấu đáp án đúng để người dùng đối chiếu
            $('#question_'+id+' > fieldset > div > label.'+answer).css("background-color","yellow");
        });
        $("#mark").text("Điểm của bạn là: " + mark);
    }

    function GetQuestions(){
        $.ajax({
            url:'questions.php',
            type:'GET',
            success:function(data){
                //Convert kiểu dữ liệu từ string về json
                questions = jQuery.parseJSON(data);
                let index = 1;
                let kq = '';
                //Với json thì khi duyệt luôn dùng $.each
                $.each(questions,function(k,v){
                    kq+= '<div class="row" style="margin-left:10px;" id="question_'+v['id']+'">';
                    kq+=    '<h5 style="font-weight:bold;" id="'+v['id']+'"><span class="text-danger">Câu '+index+': </span>'+v['question']+'</h5>';
                    kq+=    '<fieldset>';
                    kq+=    '<div class="radio col-md-12">';
                    kq+=        '<label class="A"><input type="radio" class="A" name="'+v['id']+'"/><span class="text-danger">A: </span>'+v['option_a']+'</label>';
                    kq+=    '</div>';
                    kq+=    '<div class="radio col-md-12">';
                    kq+=        '<label class="B"><input type="radio" class="B" name="'+v['id']+'"/><span class="text-danger">B: </span>'+v['option_b']+'</label>';
                    kq+=    '</div>';
                    kq+=    '<div class="radio col-md-12">';
                    kq+=        '<label class="C"><input type="radio" class="C" name="'+v['id']+'"/><span class="text-danger">C: </span>'+v['option_c']+'</label>';
                    kq+=    '</div>';
                    kq+=    '<div class="radio col-md-12">';
                    kq+=       '<label class="D"><input type="radio" class="D" name="'+v['id']+'"/><span class="text-danger">D: </span>'+v['option_d']+'</label>';
                    kq+=    '</div>';
                    kq+=    '</fieldset>';
                    // kq+=    '<input type="hidden" name="answer" value="'+v['answer']+'"/>';
                    kq+='</div>';
                    // Do ban đầu index đang là 1 nếu ta để index++ ở trên thì lúc này index sẽ bắt đầu từ 2.
                    index++;
                });
                $('#questions').html(kq);
            }
        })
    }
</script>
</html>