<button type="button" class="btn btnModal btn-sm foqas-btn pull-left" id="changeGreen" data-toggle="modal"
        data-target="#addClassModal{{$school->id}}"
        style="margin-right: 5px;">{{trans(school('country')->code == 'BD' ? 'Add Class' : 'Add Grade')}}</button>
@push('modalAppend')
    <!-- Modal -->
    <div class="modal fade" id="addClassModal{{$school->id}}" tabindex="-1" role="dialog"
         aria-labelledby="addClassModal{{$school->id}}Label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"
                        id="myModalLabel">{{trans(school('country')->code == 'BD' ? 'Add New Class' : 'Add New Grade')}}</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{url('school/add-class')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="className{{$school->id}}"
                                   class="col-sm-4 control-label">{{trans(school('country')->code == 'BD' ? 'Class Name' : 'Grade Name')}}</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="className{{$school->id}}"
                                       placeholder="{{trans(school('country')->code == 'BD' ? 'Class Name' : 'Grade Name')}}"
                                       required>
                                @error('name')
                                <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="classNumber{{$school->id}}"
                                   class="col-sm-4 control-label">{{trans(school('country')->code == 'BD' ? 'Class Number' : 'Grade Number')}}</label>
                            <div class="col-sm-8">
                                <input type="number" min="0" name="class_number" class="form-control"
                                       id="classNumber{{$school->id}}"
                                       placeholder="{{trans(school('country')->code == 'BD' ? 'Class Number' : 'Grade Number')}}"
                                       required>
                                @error('class_number')
                                <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                     </span>
                                @enderror
                            </div>
                        </div>
                        {{--<div class="form-group">
                          <label for="classRoomNumber{{$school->id}}" class="col-sm-4 control-label">{{school('country')->code == 'BD' ? 'Class Room Number' : 'Grade Room Number '}}</label>
                          <div class="col-sm-8">
                            <input type="number" class="form-control" id="classRoomNumber{{$school->id}}" placeholder="@lang('Class Room Number')">
                          </div>
                        </div>
                        --}}
                        <div class="form-group">
                            <label for="classRoomNumber{{$school->id}}"
                                   class="col-sm-4 control-label">  {{trans(school('country')->code == 'BD' ? 'Class Group (If Any)' : 'Grade Group (If Any)')}}
                                <span title="{{school('country')->code == 'BD' ? trans('Leave Empty if this Class belongs to no Group') : trans('Leave Empty if this Grade belongs to no Group')}}"
                                      style="color: #9a5418;cursor: pointer;">?</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="group" id="classRoomNumber{{$school->id}}"
                                       placeholder="@lang('Ex: Science')">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-4">
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