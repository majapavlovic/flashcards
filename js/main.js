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