<div class="modal-header">
    <h5 class="modal-title">
        Mã công văn: CV-{{ str_pad($code[0]->id, 5 ,'0', STR_PAD_LEFT) }}
        <br>
        <p>Ngày tạo: {{ $code[0]->updated_at }}</p>
    </h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="popupMessageContainer">
        <div class="table-rep-plugin">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-striped">
                    <thead>
                    <tr>
                        <th data-priority="1">Tên thiết bị</th>
                        <th data-priority="3">Thông tin<br>thiết bị</th>
                        <th data-priority="1">Xuất xứ</th>
                        <th data-priority="3">Đơn vị tính</th>
                        <th data-priority="3">Số lượng<br>yêu cầu</th>
                        <th data-priority="6">Trong kho</th>
                        <th data-priority="6">Số lượng<br>đề nghị cấp</th>
                        <th data-priority="6">Đơn giá</th>
                        <th data-priority="6">Tổng tiền</th>
                        <th data-priority="6">Ghi chú</th>
                        {{--                      <th data-priority="6">Ngày nhập</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($message as $mess)
                        <tr>
                            <td>{{ $mess->device_name }}</td>
                            <td>{{ $mess->device_info }}</td>
                            <td>{{ $mess->origin }}</td>
                            <td>{{ $mess->unit }}</td>
                            <td>{{ $mess->order_quantity }}</td>
                            <td>{{ $mess->stock }}</td>
                            <td>{{ $mess->recommended_unit }}</td>
                            <td>{{ number_format($mess->price) }}</td>
                            <td>{{ number_format($mess->total_money) }}</td>
                            <td>{{ $mess->note }}</td>
                            {{--                        <td>{{ $mess->created_at }} </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <p></p>
            </div>
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <div class="d-flex float-md-right">
                    <div class="col-md-6">
                        <form method="post"
                              action="{{ route('document.approve', ['id'=>$code[0]->id]) }}">
                            @csrf
                            <button class="btn btn-primary badge badge-primary font-size-14"
                                    @if($code[0]->can_edit == 1)
                                    disabled
                                    @endif
                                    type="submit">Phê duyệt
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form method="post"
                              action="{{ route('document.refuse', ['id'=>$code[0]->id]) }}">
                            @csrf
                            <button class="btn btn-danger badge badge-danger font-size-14"
                                    @if($code[0]->can_edit == 1)
                                    disabled
                                    @endif
                                    type="submit">Từ chối
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div>
        <p></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
    </div>
</div>
