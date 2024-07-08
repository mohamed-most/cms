$(document).ready(function() {
    $('#summernote').summernote({
        height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true 
        
    });
});
  
$(document).ready(function () {
    $("#selectAllBoxes").on('change', function () {
        const isChecked = this.checked;
        $(".checkBoxes").each(function () {
            this.checked = isChecked;
        });
    });
});
