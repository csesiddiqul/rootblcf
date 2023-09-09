<div class="table-responsive">
    <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('Fee Name')</th>
            <th scope="col">{{transMsg(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Grade')}}</th>
            <th scope="col">@lang('Section')</th>
            <th scope="col">@lang('Amount')</th>
            <th scope="col">@lang('Total Students')</th>
            <th scope="col">@lang('Total Cycle')</th>
            <th scope="col">@lang('Cycle Done')</th>
            <th scope="col">@lang('Cycle Status')</th>
            <th scope="col">@lang('Created Date')</th>
            <th scope="col">@lang('View')</th>
            {{--<th scope="col">@lang('Select')</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($fees as $key=>$fee)
            <tr>
                <td scope="row">{{  $key + 1 }}</td>
                <td>
                    {{$fee->account_sector['name']}}
                </td>
                <td>{{$fee->due_one->class->name}}</td>
                <td>{{$fee->due_one->section->section_number}}</td>
                <td><small>{{number_format($fee->amount, 2)}}</small></td>
                <td>{{$fee->due->count()}}</td>
                <td><small>{{$fee->cycle}}</small></td>
                <td><small>{{$fee->cycle_status}}</small></td>
                <td>
                    <small class="label label-{{$fee->cycle == $fee->cycle_status ? 'success' : 'warning'}}">{{$fee->cycle == $fee->cycle_status ? 'Complete' : 'In-complete'}}</small>
                </td>
                <td>{{date('d-m-Y',strtotime($fee->date))}}</td>
                <td>
                    <a class="btn btn-xs btn-default" href="{{ route('fees.show',$fee->id) }}">@lang('View')</a>
                </td>
                {{--<td>
                  <div class="form-check">
                    <input class="form-check-input position-static" type="checkbox" value="{{$fee->fee_name}}" name="isSelected" aria-label="Select">
                  </div>
                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@push('script')
    <script type="text/javascript">
        $.extend(true, $.fn.dataTable.defaults, {
            "bFilter": true,
            initComplete: function () {
                this.api().column(1).every(function () {
                    var column = this;
                    var select = $('<select><option value="">@lang('Fee Name')</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                this.api().column(2).every(function () {
                    var column = this;
                    var select = $('<select><option value="">{{transMsg(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Grade')}}</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                this.api().column(3).every(function () {
                    var column = this;
                    var select = $('<select><option value="">{{transMsg('Section')}}</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
                this.api().column(9).every(function () {
                    var column = this;
                    var select = $('<select><option value="">{{transMsg('Created Date')}}</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            },
        });
    </script>
@endpush