<button type="button" class="btn btnModal" id="changeGreen" data-toggle="modal"
        data-target="#addSectionModal{{$class->id}}">@lang('Add New Section')</button>
@push('modalAppend')
    <div class="modal fade" id="addSectionModal{{$class->id}}" tabindex="-1" role="dialog"
         aria-labelledby="addSectionModal{{$class->id}}Label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">@lang('Add New Section')</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{url('school/add-section')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="class_id" value="{{$class->id}}"/>
                        <div class="form-group">
                            <label for="section_number{{$class->class_number}}"
                                   class="col-sm-3 control-label">@lang('Section Name')</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="section_number{{$class->class_number}}"
                                       name="section_number" placeholder="@lang('A, B, C, etc..')">
                                @error('section_number')
                                <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="room_number{{$class->class_number}}"
                                   class="col-sm-3 control-label">@lang('Room Number')</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="room_number{{$class->class_number}}"
                                       name="room_number" placeholder="@lang('Room Number')">
                                @error('room_number')
                                <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-4">
                                <button type="submit" class="{{btnClass()}}">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endpush