console.log("Hello js is working");

$(".fa-trash-o").click(function(){
    console.log("Clicked on "+$(this).attr('value'));
    $.post("delete.php",
    {uid: $(this).attr('value')},
    () => {location.reload()});
})




  var checkboxValues = JSON.parse(localStorage.getItem('checkboxValues')) || {},
    $checkboxes = $(":checkbox");

$checkboxes.on("change", function(){
  $checkboxes.each(function(){
    checkboxValues[this.id] = this.checked;
  });
  
  localStorage.setItem("checkboxValues", JSON.stringify(checkboxValues));
});

// On page load
$.each(checkboxValues, function(key, value) {
  $("#" + key).prop('checked', value);
});

$("input").click(function (event) {
    let message = $(event.target).parent();
    // $(message).css('border', 'solid 1px red');
    $(message)[0].click();
});



   
    // $logout = document.querySelector('.logout');
    // console.log($logout);
    // function onLogin(){
    //     console.log("botton is presed");
    //       window.location.href="http://google.com";
    //     };
