@if(Auth::user()->role == 'admin')
    <div class="well pull-right d-none" id="exportin">
        <form class="form-inline" action="{{url('committee/export/committees.xlsx')}}" method="get">
            <div class="form-group">
                <label for="export-year">@lang('Excel by Designation'): </label>
                <input type="hidden" name="type" value="{{$type}}">
                {!! Form::select('designation',designation(), old('designation'), array('id' => 'designation', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
            </div>
            <button type="submit" class="btn btn-sm btn-default exdownbtn"><i class="material-icons">get_app</i>
                @lang('Download')
            </button>
        </form>
    </div>
    <style>
        .panel-body .well {
            background: none;
            padding: 0;
        }
    </style>
    @push('script')
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
    @endpush
@endif
