<div class="table-responsive" style="clear: both;">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('Book Title')</th>
            <th>@lang('Book Code')</th>
            <th>@lang('Type')</th>
            <th>@lang('Issue Date')</th>
            <th>@lang('Return Date')</th>
            <th>@lang('Status')</th>
        </tr>
        </thead>
        <tbody>
        @if($user->issueBook->count())
        @foreach($user->issueBook as $result)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$result->book->title}}</td>
                <td>{{$result->book->book_code}}</td>
                <td>{{$result->book->type}}</td>
                <td>{{date('d M, Y',strtotime($result->issue_date))}}</td>
                <td>{{date('d M, Y',strtotime($result->return_date))}}</td>
                <td>
                    @if($result->quantity == 0 && $result->borrowed == 0)
                        <span class="text-success">
                        @lang('Returned at') <br>
                        {{date('d M, Y',strtotime($result->updated_at))}}
                        </span>
                    @else
                        <span class="text-danger">@lang("Didn't return")</span>
                    @endif
                </td>
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center text-danger">@lang('These student has no issue book')</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>