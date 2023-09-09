@if(Auth::user()->role == 'admin' || Auth::user()->role == 'librarian')
<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;"> 
      
        <a href="{{ route('library.issued-books.index') }}" class="btn {{(\Route::current()->getName() == 'library.issued-books.index')? 'active':''}}">@lang('All Issued Books')</a>

        <a href="{{ route('library.books.index') }}" class="btn {{(\Route::current()->getName() == 'library.books.index')? 'active':''}}">@lang('All Books')</a>
 	</div>
      
        <div class="pull-right">
        	@if(\Route::current()->getName() == 'library.issued-books.index')
            <a href="{{ route('library.issued-books.create') }}" class="btn btn-sm foqas-btn pull-left mr-15">@lang('Issue Books')</a>
    	 @endif
            @if(\Route::current()->getName() == 'library.books.index')
            <a href="{{ route('library.books.create') }}" class="btn btn-sm foqas-btn pull-left mr-15">@lang('Add New Book')</a>
            @endif
		</div>
<div class="clearfix"></div>
@endif

