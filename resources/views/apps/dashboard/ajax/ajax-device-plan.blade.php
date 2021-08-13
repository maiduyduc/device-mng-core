<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="popupMessageContainer">
        @if($datas->count() != 0)
                @csrf
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0 list-group-item rounded px-3 mb-1" data-pattern="priority-columns"
                         id="list-item">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th data-priority="1">STT</th>
                                <th data-priority="1">Mã văn bản</th>
                                <th data-priority="3">Số lượng thiết bị</th>
                                <th data-priority="1">Số lượng đã dùng</th>
                                <th data-priority="3">Số lượng còn lại</th>
                                <th data-priority="3">Ngày tạo</th>
                                <th data-priority="6">Ghi chú</th>
                                <th data-priority="6">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr class="item-wrapper">
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $data->full_number }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>{{ $data->num_device_in_use }}</td>
                                    <td>{{ $data->num_device_not_use }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->note }}</td>
                                    <td>
                                        <a href="#!" class="btn btn-info badge badge-info font-size-14 collapsed"
                                           aria-expanded="false"
                                           data-toggle="collapse"
                                           data-target="#collapselist{{ $data->id }}"
                                           aria-controls="collapselist{{ $data->id }}">Xem chi tiết</a>
                                    </td>
                                </tr>
                                <tr id="lec{{ $data->id }}">
                                    <td id="collapselist{{ $data->id }}" class="collapse" data-parent="#list-item"
                                        colspan="8"
                                        rowspan="1">
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th data-priority="1">Tên thiết bị</th>
                                                <th data-priority="3">Thông tin thiết bị</th>
                                                <th data-priority="1">Số lượng</th>
                                                <th data-priority="3">Ghi chú</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data_devices[$i] as $device)
                                                <tr>
                                                    <td>{{ $device->device_name }}</td>
                                                    <td>{{ $device->device_info }}</td>
                                                    <td>{{ $device->qty }}</td>
                                                    <td>{{ $device->note }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5" style="text-align: right!important;">
                                                    <form method="post"
                                                          action="{{ route('device-plan.export', ['id'=>$data->id]) }}">
                                                        @csrf
                                                        <button class="btn btn-primary badge badge-primary font-size-14 noPrint"
                                                                style="height: 36px"
                                                                type="submit">
                                                            Xuất thông tin
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <p style="display: none">{{ $i++ }}</p>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <p></p>
                    </div>
                </div>

        @else
            <h1 style="text-align: center">Không có dữ liệu</h1>
        @endif
    </div>
    <div>
        <p></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
    </div>
</div>
