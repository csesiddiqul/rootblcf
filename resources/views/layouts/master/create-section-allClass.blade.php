<button type="button" class="btn btnModal btn-sm foqas-btn pull-left pl-2" data-toggle="modal"
        data-target="#addSectionModal{{$school->id}}">@lang('Add Section')</button>
@push('modalAppend')
    <div class="modal fade" id="addSectionModal{{$school->id}}" tabindex="-1" role="dialog"
         aria-labelledby="addSectionModalLabel">
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
                        <div class="form-group">
                            <label for="class_id"
                                   class="col-sm-4 control-label text-left">{{trans(school('country')->code == 'BD' ? 'Class' : 'Grade ')}}</label>
                            <div class="col-sm-8">
                                {!! Form::select('class_id',$pluckClass, old('class_id'), array('id' => 'class_id', 'class' => 'form-control','required', 'placeholder' => trans('Choose'))) !!}
                                @error('class_id')
                                <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="section_number"
                                   class="col-sm-4 control-label text-left">@lang('Section Name')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="section_number" required
                                       name="section_number" placeholder="@lang('Ex: A')">
                                <code id="admissionMsg" class="d-none">@lang('Note')
                                    : @lang('Create an <mark id="markAd">"Admission"</mark> section for online admissions in each class')</code>
                                @error('section_number')
                                <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="room_number"
                                   class="col-sm-4 control-label text-left">@lang('Room Number')</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="room_number" required
                                       name="room_number" placeholder="@lang('Room Number')">
                                @error('room_number')
                                <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                     </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group admission_field d-none">
                            <label for="add_total"
                                   class="control-label col-sm-4 text-left">@lang('Admission Total Student')</label>
                            <div class="col-sm-8">
                                {!! Form::number('add_total', null,array('id' => 'add_total', 'class' => 'form-control','min'=>0)) !!}
                            </div>
                        </div>
                        <div class="form-group admission_field d-none">
                            <label for="add_amount"
                                   class="control-label col-sm-4 text-left">@lang('Admission Amount')</label>
                            <div class="col-sm-8">
                                {!! Form::number('add_amount', null,array('id' => 'add_amount', 'class' => 'form-control','min'=>0)) !!}
                            </div>
                        </div>
                        <div class="form-group admission_field d-none">
                            <label for="lottery_on_mark"
                                   class="control-label col-sm-4 text-left">@lang('Lottery Base')</label>
                            <div class="col-sm-8">
                                {!! Form::select('lottery_on_mark',['0'=>'Base on without Mark','1'=>'Base on with Mark'], null,array('id' => 'lottery_on_mark', 'class' => 'form-control')) !!}
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
@push('script')
    <script>
        $(document).ready(function () {
            $("#section_number").on('input', function () {
                var value = $(this).val();
                value = value.toLowerCase();
                if (value == 'admission') {
                    $(".admission_field").removeClass('d-none');
                } else {
                    $(".admission_field").addClass('d-none');
                }
            });
            $("#markAd").click(function () {
                $("#section_number").val("Admission").trigger("input");
            })
            $("#class_id").change(function () {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "/checkIsClassAdmission/" + id,
                    success: function (data) {
                        if (data.status === 200)
                            $("#admissionMsg").addClass('d-none');
                        else
                            $("#admissionMsg").removeClass('d-none');
                    },
                    error: function (xhr, textStatus, thrownError, jqXHR) {
                    },
                });
            })
        })
    </script>
@endpush