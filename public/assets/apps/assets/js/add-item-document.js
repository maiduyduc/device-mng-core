let count = 2;
let valueDeviceName = "'value='{{ old('device_name."+ (count - 1) +" } ') }}''" ;
function appendText() {
    // let title = "Bài " + count;

    let element = "<div id='lec" + count + "' class='list-group-item rounded px-3 mb-1'>" +
        "<div class='d-flex align-items-center justify-content-between'>" +
            "<h5 class='mb-0'>" +
               " <a href='#!' class='text-dark' data-toggle='collapse' data-target='#collapselist" + count + "'\> " +
                    "<i class='fe fe-menu mr-1 text-muted align-middle'></i>" +
                "<span class='align-middle'>Item "+ count +" </span>" +
                "</a>" +
            "</h5>" +
            "<div>" +
                "<a href='#!' class='mr-1 text-dark' data-toggle='tooltip' data-placement='top' onClick='delLecture(" + count + ")' data-original-title='Delete'>" +
                    "<i class='bx bx-trash'></i>" +
                "</a>" +
                "<a href='#!' class='text-dark' aria-expanded='true' data-toggle='collapse' data-target='#collapselist" + count + "' aria-controls='collapselist" + count + "'>" +
                    "<span class='chevron-arrow'>" +
                        "<i class='bx bx-down-arrow'></i>" +
                    "</span>" +
                "</a>" +
            "</div>" +
        "</div>" +
        "<div id='collapselist" + count + "' class='collapse show' data-parent='#list-item'>" +
            "<div class='card-body'>" +
                "<div class='row'>" +
                    "<div class='col-lg-3'>" +
                        "<div class='form-group'>" +
                            "<label For='formrow-inputDeviceName'>Tên thiết bị (<span class='text-danger'>*</span>)</label>" +
                          " <input type='text' class='form-control' name='device_name[]' required id='formrow-inputDeviceName'>" +
                        "</div>" +
                    "</div>" +
                   " <div class='col-lg-3'>"+
                        "<div class='form-group'>"+
                            "<label For='formrow-inputOrigin'>Xuất xứ</label>"+
                            "<input type='text' class='form-control' name='origin[]' id='formrow-inputOrigin'>"+
                        "</div>"+
                    "</div>"+
                   " <div class='col-lg-2'>"+
        "<div class='form-group'>"+
        " <label class='control-label '>Loại thiết bị</label>"+
        "<select name='category_id[]' class='form-control select2-search-disable'>"+
        "<option selected hidden value=''>Chọn loại thiết bị</option>"+
        "<option value='1'>Bàn ghế</option>"+
        "<option value='2'>Máy tính</option>"+
        "<option value='3'>Thiết bị mạng</option>"+
        "<option value='4'>Dụng cụ mỹ thuật</option>"+
        "<option value='5'>Thiết bị khác</option>"+
        "</select>"+
        "</div>"+
        "</div>"+
                    " <div class='col-lg-2'>"+
                        "<div class='form-group'>"+
                            " <label class='control-label '>Mã thiết bị</label>"+
                            "<select name='device_prefix_id[]' class='form-control select2-search-disable'>"+
                                "<option selected hidden value='1'>Chọn mã thiết bị</option>"+
                                "<option value='1'>TB - Thiết bị khác</option>"+
                                "<option value='2'>MT - Máy tính</option>"+
                                "<option value='3'>MH - Màn hình</option>"+
                                "<option value='4'>RMT - Ram</option>"+
                                "<option value='5'>MC - Máy chiếu</option>"+
                                "<option value='6'>CASE</option>"+
                            "</select>"+
                        "</div>"+
                    "</div>"+
                    " <div class='col-lg-2'>"+
                        "<div class='form-group'>"+
                            " <label class='control-label '>Đơn vị tính</label>"+
                                "<select name='unit[]' class='form-control select2-search-disable'>"+
                                "<option selected hidden value=' '>Chọn đơn vị tính</option>"+
                                "<option value='Bộ'>Bộ</option>"+
                                "<option value='Chiếc'>Chiếc</option>"+
                                "<option value='Cái'>Cái</option>"+
                                "<option value='Thùng'>Thùng</option>"+
                                "<option value='Hộp'>Hộp</option>"+
                                "<option value='Ram'>Ram</option>"+
                                "<option value='Cuộn'>Cuộn</option>"+
                            "</select>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='row'>"+
                    "<div class='col-lg-2'>"+
                        "<div class='form-group'>"+
                            "<label for='formrow-inputorder_quantity'>Số lượng yêu cầu (<span class='text-danger'>*</span>)</label>"+
                            "<input type='number' min='0' class='form-control' required name='order_qty[]' id='formrow-inputorder_quantity'>"+
                        "</div>"+
                    "</div>"+
                    "<div class='col-lg-2'>"+
                        "<div class='form-group'>"+
                            "<label for='formrow-inputstock'>Số lượng trong kho (<span class='text-danger'>*</span>)</label>"+
                            "<input type='number' min='0' class='form-control' required name='stock[]' id='formrow-inputstock'>"+
                        "</div>"+
                    "</div>"+
                    "<div class='col-lg-2'>"+
                        "<div class='form-group'>"+
                            "<label for='formrow-inputrecommened_unit'>Số lượng đề nghị cấp (<span class='text-danger'>*</span>)</label>"+
                            "<input type='number' min='0' class='form-control' required name='recommended_qty[]' id='formrow-inputrecommened_unit'>"+
                        "</div>"+
                    "</div>"+
                    "<div class='col-lg-3'>"+
                        "<div class='form-group'>"+
                            "<label for='formrow-inputUnitPrice'>Đơn giá (đã bao gồm VAT) (<span class='text-danger'>*</span>)</label>"+
                            "<input type='number' min='0' class='form-control' required name='unit_price[]' id='formrow-inputUnitPrice'>"+
                        "</div>"+
                    "</div>"+
                    "<div class='col-lg-3'>"+
                        "<div class='form-group'>"+
                            "<label for='formrow-inputTotal'>Tổng tiền (đã bao gồm VAT) (<span class='text-danger'>*</span>)</label>"+
                            "<input type='number' min='0' class='form-control' required name='total_money[]' id='formrow-inputTotal'>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='row'>"+
                    "<div class='form-group col-lg-12'>"+
                        "<label for='device_info'>Thông tin chi tiết thiết bị</label>"+
                        "<textarea rows='5' name='device_info[]' id='device_info' class='form-control'></textarea>"+
                    "</div>"+
                "</div>"+
                "<div class='row'>"+
                    "<div class='col-lg-12'>"+
                        "<div class='form-group'>"+
                            "<label for='formrow-inputNote'>Ghi chú</label>"+
                            "<input type='text' class='form-control' name='note[]' id='formrow-inputNote'>"+
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
    // count -= 1;
    let lectureId = 'lec' + x.toString();
    let elementId = document.getElementById(lectureId);
    elementId.remove();
}
