<form class="form-horizontal" action="{{url('library/issue-books')}}" method="post" autocomplete="off">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('student_code') ? ' has-error' : '' }}">
        <label for="student_code" class="control-label">@lang('Student Code')</label>
            <input id="student_code" type="text" class="form-control" name="student_code" value="{{ old('student_code') }}"
                placeholder="@lang('Student Code')" required>

            @if ($errors->has('student_code'))
            <span class="help-block">
                <strong>{{ $errors->first('student_code') }}</strong>
            </span>
            @endif
    </div>
    <div class="form-group{{ $errors->has('book_code') ? ' has-error' : '' }}">
        <label for="book_code" class="control-label" style="text-align: left">@lang('Book Title') &amp; @lang('Code') (<small>@lang('Type') & @lang('Search by Name/Code.')
                @lang('You can Select Multiple Books') (<i>@lang('Maximum') 10 @lang('books')</i>)</small>)</label>
            <select id="book_code" class="form-control select2" multiple name="book_id[]">
                @foreach($books as $book)
                <option value="{{$book->id}}">{{$book->title}} - {{$book->book_code}}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group{{ $errors->has('issue_date') ? ' has-error' : '' }}">
        <label for="issue_date" class="control-label">@lang('Issue Date')</label>
            <input id="issue_date" class="form-control datepicker" name="issue_date" value="{{ old('issue_date') }}"
                placeholder="@lang('Issue Date')" required>

            @if ($errors->has('issue_date'))
            <span class="help-block">
                <strong>{{ $errors->first('issue_date') }}</strong>
            </span>
            @endif
    </div>
    <div class="form-group{{ $errors->has('return_date') ? ' has-error' : '' }}">
        <label for="return_date" class="control-label">@lang('Return Date')</label>
            <input id="return_date" class="form-control datepicker" name="return_date" value="{{ old('return_date') }}"
                placeholder="@lang('Return Date')" required>

            @if ($errors->has('return_date'))
            <span class="help-block">
                <strong>{{ $errors->first('return_date') }}</strong>
            </span>
            @endif
    </div>
    <div class="form-group">
        <div class="col-sm-3 pl-0">
            <button type="submit" class="{{btnClass()}}">@lang('Save')</button>
        </div>
    </div>
</form>
