$(document).ready(function(){
    edit.loadTinymce();
    process.getCovers($('#categories_id').val());
    process.addressAutocomplete();
});
edit = {
    loadTinymce: function () {
        tinymce.init({
            selector: '#content',
            menubar: false,
            language: 'fr_FR',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview '
        });
    }
}