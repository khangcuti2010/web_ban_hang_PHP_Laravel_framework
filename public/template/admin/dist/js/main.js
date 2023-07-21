$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function removeRow(id, url) { //hàm xử lý xoá
    if (confirm('Bạn có chắc chắn muốn xoá?')) {
        $.ajax({
            method: 'DELETE',
            dataType: 'JSON',
            data:  {id} ,
            url: url,
            success: function (result) {
                if(result.error == false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Lỗi vui lòng thử lại');
                }
            }
        })
    }
}



