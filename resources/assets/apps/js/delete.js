function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Xóa bản ghi này?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data){
                    if(data.code===200){
                        that.parent().parent().remove();
                        Swal.fire(
                            'Done!',
                            'Xóa thành công',
                            'success'
                        )
                    }
                },
                error: function (){
                    Swal.fire(
                        'Error!',
                        'Xóa thất bại',
                        'error'
                    )
                }
            });
        }
    })
}

$( function (){
    $(document).on('click', '.action_delete', actionDelete);
})
