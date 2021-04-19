$(".form-control").on("change keyup paste", function(){

    $tr = $(this).closest('tr');
    $tr.css("background-color","white")
})