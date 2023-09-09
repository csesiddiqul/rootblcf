@if(Auth::user()->role == 'admin')
    <div class="">
        <form class="form-inline" action="{{url('users/export/students-xlsx')}}" method="get">
            <div class="form-group">
                <label for="export-year">@lang('Filter by Status'): </label>
                <input type="hidden" name="type" value="{{$type}}">
                {!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control input-sm btn-sm', 'required','placeholder' => trans('Choose'))) !!}
            </div>
            <button type="submit" class="btn btn-sm btn-default foqas-btn "><i class="fa fa-download"></i> @lang('Download')
            </button>
        </form>
    </div>
@push('styles')
    <style>
        .panel-body .well {
            background: none;
            padding: 0;
        }
        .input-sm.btn-sm {
            height: auto;
            padding: 8px 10px;
        }
    </style>
@endpush
@endif