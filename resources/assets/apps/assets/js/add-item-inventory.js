let count = 2;

function appendText() {
    let element = "<div id='lec"+count+"' class='list-group-item rounded px-3 mb-1'>" +
        "<div class='d-flex align-items-center justify-content-between'>" +
            "<h5 class='mb-0'>" +
                "<a href='#!' class='text-dark' data-toggle='collapse' data-target='#collapselist"+count+"'>" +
                    "<i class='fe fe-menu mr-1 text-muted align-middle'></i>" +
                    "<span class='align-middle'>Item "+count+"</span>" +
                "</a>" +
            "</h5>" +
            "<div>" +
                "<a href='#!' class='mr-1 text-dark' data-toggle='tooltip' data-placement='top' onClick='delLecture(" + count + ")' data-original-title='Delete'>" +
                    "<i class='bx bx-trash'></i>" +
                "</a>" +
                "<a href='#!' class='text-dark' aria-expanded='true' data-toggle='collapse' data-target='#collapselist"+count+"' aria-controls='collapselist"+count+"'>" +
                    "<span class='chevron-arrow'>" +
                       " <i class='bx bx-down-arrow'></i>" +
                    "</span>" +
                "</a>" +
            "</div>" +
        "</div>" +
       " <div id='collapselist"+count+"' class='collapse show' data-parent='#list-item'>" +
            "<div class='card-body'>" +
                "<div class='row'>" +
                    "<div class='col-lg-3'>" +
                        "<div class='form-group'>" +
                            "<label>Tên thiết bị</label>" +
                            "<input type='text' name='device_name[]' class='form-control' required>" +
                       " </div>" +
                    "</div>" +
                    "<div class='col-lg-3'>" +
                        "<div class='form-group'>" +
                            "<label>Mã thiết bị</label>" +
                            "<input type='text' class='form-control' name='device_code[]'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                            "<label class='control-label'>Mã Serial</label>" +
                           " <input type='text' class='form-control' name='serial[]'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                           " <label class='control-label'>Ngày mua</label>" +
                            "<input type='date' class='form-control' name='date_purchase[]'>" +
                        "</div>" +
                    "</div>" +
                   " <div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                            "<label class='control-label'>Đơn vị tính</label>" +
                           " <select name='unit[]' class='form-control'>" +
                                "<option selected value=' '>Chọn đơn vị tính </option>" +
                                "<option value='Bộ'>Bộ</option>" +
                                "<option value='Chiếc'>Chiếc</option>" +
                                "<option value='Cái'>Cái</option>" +
                                "<option value='Thùng'>Thùng</option>" +
                                "<option value='Hộp'>Hộp</option>" +
                                "<option value='Ram'>Ram</option>" +
                                "<option value='Cuộn'>Cuộn</option>" +
                            "</select>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
                "<div class='row'>" +
                    "<div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                            "<label>Số lượng theo sổ sách</label>" +
                            "<input type='number' name='qty_document[]' min='0' class='form-control' required>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                            "<label>Nguyên giá</label>" +
                            "<input type='number' name='price_document[]' min='0' required class='form-control'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                            "<label>Số lượng theo kiểm kê</label>" +
                            "<input type='number' name='qty_inventory[]' required min='0' class='form-control'>" +
                       " </div>" +
                    "</div>" +
                    "<div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                            "<label>Nguyên giá (theo kiểm kê)</label>" +
                            "<input type='number' name='price_inventory[]' required min='0' class='form-control'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                            "<label>Nguồn tiền</label>" +
                           " <input type='number' name='funds[]' min='0' class='form-control'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-lg-2'>" +
                        "<div class='form-group'>" +
                            "<label>Giá trị ước tính</label>" +
                            "<input type='number' name='estimate_price[]' required min='0' class='form-control'>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
                "<div class='row'>" +
                    "<div class='col-lg-12'>" +
                        "<div class='form-group'>" +
                            "<label>Ghi chú</label>" +
                            "<input type='text' class='form-control' name='note[]'>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
            "</div>" +
        "</div>" +
    "</div>";
    $("#list-item").append(element);   // Append new elements
    count += 1;
}
//xoa
function delLecture(x) {
    let lectureId = 'lec' + x.toString();
    let elementId = document.getElementById(lectureId);
    elementId.remove();
}
