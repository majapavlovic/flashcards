
var modal = document.getElementById('questions-modal')
modal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  var action = button.getAttribute('data-bs-whatever');
  
  var modalTitle = modal.querySelector('.modal-title');

  $('#question').val("");
  $('#answer').val("");
  $("#category_id").val("0").change();
  
  if(action=="insert") {
    modalTitle.textContent = "Insert Question&Answer";
    $('input[name="type_of_action"]').val("insert-question");
  }
  
  else if(action=="update") {
    modalTitle.textContent = "Update Question&Answer";
    $('input[name="type_of_action"]').val("update-question");

    var id = $('input[name="checked-donut"]:checked').val();
    req = $.ajax({
        url: 'system-operations/get_by_id.php',
        type:'post',
        data: {'id':id},
        dataType: 'json'
    });

    req.done(function(res, textStatus, jqXHR){
            console.log("Found data");

            $('input[name="question_id"]').val(res[0]['id']);
            $('#question').val(res[0]['question']);
            $('#answer').val(res[0]['answer']);
            $("#category_id").val(res[0]['category_id']).change();
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error: '+textStatus, errorThrown)
    });
  }
});

$("#question-form").submit(function(){
    event.preventDefault();
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');
    
    if($('input[name="type_of_action"]').val()=="insert-question")
        reqUrl = 'system-operations/insert.php';
    else if($('input[name="type_of_action"]').val()=="update-question")
        reqUrl = 'system-operations/update.php';

    const serialized = $form.serialize();
    console.log(serialized);
    console.log(reqUrl);

    $input.prop('disabled', true);

    req = $.ajax({
        url: reqUrl,
        type:'post',
        data: serialized
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Successfully done!");
            location.reload(true);
        }else {
            console.log("Failed executing system operation "+res);
            alert("Failed executing system operation");
        }
        console.log(res);

    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error: '+textStatus, errorThrown)
    });
});

$('#btn-delete').click(function() {
    var id = $('input[name="checked-donut"]:checked').val();

    req = $.ajax({
        url: 'system-operations/delete.php',
        type:'post',
        data: {'id':id}
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Successfully deleted question!");
            console.log("Deleted question");
            location.reload(true);
        }else {
            console.log("Failed deleting question "+res);
            alert("Failed deleting question");
        }
        console.log(res);

    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error: '+textStatus, errorThrown)
    });

});


//filtering questions
$(document).ready(function(){
    $("#search-filter").on("keyup", function() {
      
       var unicode = event.charCode ? event.charCode : event.keyCode;
          if (unicode == 27) { $(this).val(""); }
          var searchKey = $(this).val().toLowerCase();
          $('.accordion-button').each(function() {
              var cellText = $(this).text().toLowerCase();
      
              if (cellText.indexOf(searchKey) >= 0) {
                  $(this).parent().parent().show();
              } else {
                  $(this).parent().parent().hide();
                   $('.panel-collapse.in').collapse('hide');
              }
          });     
    });
  });

$("#radio-questions").on("change", function() {
    var id = $('input[name="checked-category"]:checked').val();
      $('.accordion-button').each(function() {
          var question_id = $(this).siblings('.accordion_category_id').val();

          if (question_id == id) {
              $(this).parent().parent().show();
          } else {
              $(this).parent().parent().hide();
               $('.panel-collapse.in').collapse('hide');
          }
      });     
});
