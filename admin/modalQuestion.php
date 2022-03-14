<div class="modal" tabindex="-1" role="dialog" id="modalQuestion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ADD QUESTION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <input type="hidden" id="txtQuestionId" value="">
          <div class="form-group">
            <textarea class="form-control"  id="txtQuestion" rows="1" placeholder="Câu hỏi"></textarea>
          </div>
          <div class="form-group">
            <textarea class="form-control"  id="txtOptionA" rows="1" placeholder="Đáp án A"></textarea>
          </div>
          <div class="form-group">
            <textarea class="form-control"  id="txtOptionB" rows="1" placeholder="Đáp án B"></textarea>
          </div>
          <div class="form-group">
            <textarea class="form-control"  id="txtOptionC" rows="1" placeholder="Đáp án C"></textarea>
          </div>
          <div class="form-group">
            <textarea class="form-control"  id="txtOptionD" rows="1" placeholder="Đáp án D"></textarea>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-md-3 col-sm-6">
                      <div class="radio">
                          <label for=""><input type="radio" name="optradio" id="optradioA"/>Đáp án A</label>
                      </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                      <div class="radio">
                          <label for=""><input type="radio" name="optradio" id="optradioB"/>Đáp án B</label>
                      </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                      <div class="radio">
                          <label for=""><input type="radio" name="optradio" id="optradioC"/>Đáp án C</label>
                      </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                      <div class="radio">
                          <label for=""><input type="radio" name="optradio" id="optradioD"/>Đáp án D</label>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSubmit">Xác nhận</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $('#btnSubmit').click(function(){
        let question = $('#txtQuestion').val();
        let option_a = $('#txtOptionA').val();
        let option_b = $('#txtOptionB').val();
        let option_c = $('#txtOptionC').val();
        let option_d = $('#txtOptionD').val();
        let answer = $("#optradioA").is(':checked')?'A'
                    :$("#optradioB").is(':checked')?'B'
                    :$("#optradioC").is(':checked')?'C'
                    :$("#optradioD").is(':checked')?'D':'';
        // console.log(question,option_a,option_b,option_c,option_d,answer)

        //Ràng buộc dữ liệu
        if(question.length == 0 || option_a.length == 0 || option_b.length == 0 || option_c.length == 0 || option_d.length == 0)
        {
            alert("Vui lòng nhập đầy đủ các câu hỏi và đáp án");
            return;
        }
        if(answer.length == 0)
        {
            alert("Vui lòng chọn đáp án");
            return;
        }

        let questionId = $('#txtQuestionId').val();
        if(questionId.length == 0)
        {
          $.ajax({
            url:'addQuestion.php',
            type: 'POST',
            data:{
                //tên tham số : giá trị
                question:question,
                option_a:option_a,
                option_b:option_b,
                option_c:option_c,
                option_d:option_d,
                answer:answer,
            },
            success:function(data){
                alert(data);
                //reset lại giá trị cho các textarea
                $('#txtQuestion').val('');
                $('#txtOptionA').val('');
                $('#txtOptionB').val('');
                $('#txtOptionC').val('');
                $('#txtOptionD').val('');
                //reset lại giá trị cho các radio button --> Không chọn thằng nào hết
                $('#optradioA').attr('checked',false);
                $('#optradioB').attr('checked',false);
                $('#optradioC').attr('checked',false);
                $('#optradioD').attr('checked',false);
                //Sau khi thêm xong đóng modal lại
                $('#modalQuestion').modal('hide');
                $('#btnSearch').click();
            }
        });
        }
        else
        {
          $.ajax({
            url:'updateQuestion.php',
            type: 'POST',
            data:{
                //tên tham số : giá trị
                id:questionId,
                question:question,
                option_a:option_a,
                option_b:option_b,
                option_c:option_c,
                option_d:option_d,
                answer:answer,
            },
            success:function(data){
                alert(data);
                //Sau khi cập nhật xong đóng modal lại
                $('#modalQuestion').modal('hide');
                $('#btnSearch').click();
            }
        });
        }
    })
</script>