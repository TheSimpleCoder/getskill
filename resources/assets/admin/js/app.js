require('./bootstrap');


$('.summernote').summernote({
    height: 300,
   /* callbacks: {
        onImageUpload: function(files) {
            var editor = $(this);
            var url = editor.data('image-url');
            var data = new FormData();
            data.append('file', files[0]);
            axios
                .post(url, data).then(function(response) {
                editor.summernote('insertImage', response.data);
            })
                .catch(function (error) {
                    console.error(error);
                });
        }
    }*/
});


$('.btn-confirm').click(function (e) {
    let message = $(this).data('message');
    if (!confirm(message)){
        return false;
    }
});
