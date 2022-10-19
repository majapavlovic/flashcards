$("#insert-question").submit(function(){
    event.preventDefault();
    console.log("Adding");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');
    console.log($input);
    

    const serialized = $form.serialize();
    console.log(serialized);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'system-operations/insert.php',
        type:'post',
        data: serialized
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Successfully added new question!");
            console.log("Added question");
            location.reload(true);
        }else {
            console.log("Failed adding question "+res);
            alert("Failed adding question");
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