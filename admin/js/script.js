$(document).ready(function() {
    // CKEditor
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    // Select all posts
    $('#selectAllBoxes').click(function(e){
        if (this.checked) {
            $('.selectAllBoxes').each(function() {
                this.checked = true;
            });
        } else {
            $('.selectAllBoxes').each(function() {
                this.checked = false;
            });
        }
        e.preventDefault();
    });

    // Page loader
    // var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    // $("body").prepend(div_box);
    // $('#load-screen').delay(700).fadeOut(600, function () {
    //     $(this).remove();
    // });
});

// Users Online
function loadUsersOnline() {
    $.get("functions.php?usersOnline=result", function (data) {
        $(".online-user").text(data);
    });
}
setInterval(function () {
    loadUsersOnline();
}, 500);
