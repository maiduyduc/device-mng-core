let count = 2;

function appendText() {

    let element = "<div id='lec" + count + "' class='list-group-item rounded px-3 mb-1'>" +
        "<div class='d-flex align-items-center justify-content-between'>" +
            "<h5 class='mb-0'>" +
                "<a href='#!' class='text-dark' data-toggle='collapse' data-target='#collapselist" + count + "'>" +
                    "<i class='fe fe-menu mr-1 text-muted align-middle'></i>" +
                    "<span class='align-middle'>Item " + count + "</span>" +
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
               " <div class='row'>" +
                    "<div class='col-lg-6'>" +
                        "<div class='form-group'>" +
                            "<label for='formrow-inputDeviceName'>Tên thiết bị (<span class='text-danger'>*</span>)</label>" +
                            "<input type='text' name='device_name[]' autofocus class='form-control' required id='formrow-inputDeviceName'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-lg-3'>" +
                        "<div class='form-group'>" +
                            "<label for='qty'>Số lượng (<span class='text-danger'>*</span>)</label>" +
                            "<input type='number' class='form-control' name='qty[]' required min='1' id='qty'>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col-lg-3'>"+
                        "<div class='form-group'>"+
                            "<label class='control-label '>Loại thiết bị</label>"+
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
                "</div>" +
                "<div class='row'>" +
                    "<div class='col-md-12'>" +
                        "<div class='form-group'>" +
                            "<label for='formrow-inputNote'>Thông tin thiết bị</label>" +
                            "<textarea name='device_info[]' rows='5' class='form-control'></textarea>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
                "<div class='row'>" +
                    "<div class='col-lg-12'>" +
                        "<div class='form-group'>" +
                            "<label for='formrow-inputNote'>Ghi chú</label>" +
                            "<input type='text' class='form-control' name='note[]' id='formrow-inputNote'>" +
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
function delLecture(x)
    {
        // count -= 1;
        let lectureId = 'lec' + x.toString();
        let elementId = document.getElementById(lectureId);
        elementId.remove();
    }
