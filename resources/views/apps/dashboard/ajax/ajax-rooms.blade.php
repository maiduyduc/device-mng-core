<div class="modal-header">
    <h5 class="modal-title">
        Chọn phòng
    </h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="popupMessageContainer">
        <form method="post" action="{{ route('document.export', ['id'=>$code[0]->id]) }}">
            @csrf
            <div class="form-group">
{{--                <label class="control-label">Chọn phòng</label>--}}
                <select name="room_id"
                        class="form-control">
                    <option selected disabled hidden value=" ">Chọn phòng</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-primary"
                            style="width: 100%"
                            type="submit">Xuất thông tin
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div>
        <p></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
    </div>
</div>
