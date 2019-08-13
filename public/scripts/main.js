console.log("Hello js is working");

$(".fa-trash-o").click(function(){
    console.log("Clicked on "+$(this).attr('value'));
    $.post("delete.php",
    {uid: $(this).attr('value')},
    () => {location.reload()});
})

