<div class="modal-header">
    <h3>Vui lòng chọn thiết bị muốn thêm vào nhóm</h3>
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
                    <form method="post"
                          action="{{ route('liquidate.create') }}">
                        @csrf
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th data-priority="1">STT</th>
                                <th data-priority="1">Mã thiết bị</th>
                                <th data-priority="3">Tên thiết bị</th>
                                <th data-priority="3">Thông tin thiết bị</th>
                                <th data-priority="1">Đơn vị tính</th>
                                <th data-priority="1">Chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr class="item-wrapper">
                                    <td>
                                        {{ $i }}
                                        <p style="display: none">{{ $i++ }}</p>
                                    </td>
                                    <td>{{ $data->full_number }}</td>
                                    <td>{{ $data->device_name }}</td>
                                    <td>{{ $data->device_info }}</td>
                                    <td>{{ $data->unit }}</td>
                                    <td>
                                        <div
                                            class="custom-control custom-checkbox custom-checkbox-primary">
                                            <input type="checkbox"
                                                   name="device_id[]"
                                                   value="{{$data->id}}"
                                                   id="checkbox{{$data->id}}"
                                                   class="custom-control-input">
                                            <label class="custom-control-label text-danger"
                                                   style="font-size: 14px"
                                                   for="checkbox{{$data->id}}">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="text-align: right!important;">

                                    <button class="btn btn-primary badge badge-primary font-size-14 noPrint"
                                            style="height: 36px; width: 100px"
                                            type="submit">
                                        Đồng ý
                                    </button>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
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
