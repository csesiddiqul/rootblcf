@if(Auth::user()->role == 'admin')
    <div class="" id="exportin">
        <form class="form-inline" action="{{url('admission/export/admission_students.xlsx')}}" method="get">
            <div class="form-group">
                <label for="export-year">@lang('Filter by Status'): </label>
                <input type="hidden" name="type" value="{{$type}}">
                {!! Form::select('status',admissionstatus(), old('status'), array('id' => 'status', 'class' => 'form-control input-sm btn-sm', 'placeholder' => trans('Choose'))) !!}
            </div>
            <button type="submit" class="btn btn-sm btn-default foqas-btn"><i class="material-icons">get_app</i>
                @lang('Download')
            </button>
        </form>
    </div>
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
    {{--@push('script')
        <script>
            $(document).ready(function () {
                function appendFunction() {
                    var appendHtml = $("#exportin").html();
                    $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                }
                setTimeout(function () {
                    appendFunction();
                }, 1000);
            })
        </script>
    @endpush--}}
@endif
