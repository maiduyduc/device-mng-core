<div class="modal-header">
    <h3>Nhập tên nhóm muốn tạo</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="popupMessageContainer">
        <form method="post"
              action="{{ route('device-group.store') }}">
            @csrf
            <div class="form-group">
                <label for="formrow-name-input">Tên nhóm</label>
                <input type="text" name="name"
                       class="form-control"
                       id="formrow-name-input"
                       placeholder="Nhập tên nhóm"
                       required="">
                <input type="hidden" value="{{ $ids }}" name="room_id">
                <input type="hidden" value="ajax" name="ajax">
            </div>
            <button class="btn btn-primary badge badge-primary font-size-14 noPrint"
                    style="height: 36px; width: 100%"
                    type="submit">
                Đồng ý
            </button>
        </form>
        @if($datas->count() != 0)
            @csrf
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0 list-group-item rounded px-3 mb-1" data-pattern="priority-columns"
                     id="list-item">
                    <h3 class="mb-3 mt-2" style="text-align: center">Danh sách nhóm thiết bị hiện có</h3>
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th data-priority="1">STT</th>
                                <th data-priority="1">Tên nhóm</th>
                                <th data-priority="3">Số lượng thiết bị trong nhóm</th>
                                <th data-priority="3">Ngày tạo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr class="item-wrapper">
                                    <td>
                                        {{ $i }}
                                        <p style="display: none">{{ $i++ }}</p>
                                    </td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>{{ $data->created_at }}</td>
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
            <h1 class="mt-2" style="text-align: center">Không có dữ liệu nhóm</h1>
        @endif
    </div>
    <div>
        <p></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
    </div>
</div>
<style>
    th, td {
        vertical-align: middle !important;
        text-align: center !important;
    }
</style>
