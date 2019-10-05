jQuery(document).ready(function($) {
    // CKEditor
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            // console.error( error );
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
});