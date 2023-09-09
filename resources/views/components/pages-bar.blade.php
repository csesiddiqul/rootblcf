<div class="page-panel-title"
     @if (\Route::current()->getName() ==  'home') style="font-size: 30px;" @endif ><strong>@lang($pageTitle)</strong></div>
@if (\Route::current()->getName() ==  'home')
    <div class="float-right">
        <form class="navbar-form pull-right" action="{{route('search')}}" method="get" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="student_id" placeholder="@lang('Search')">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default" style="height: 38px"><span
                                class="glyphicon glyphicon-search"></span></button>
                </div>
            </div>
        </form>
    </div>
    <div class="onlyclear"></div>
@else
    <div class="onlyclear"></div>
    <style>
        #main-container .head-custom, .panel-body {
            background: #ffffff !important;
            border-radius: 7px;
        }

        #main-container .panel .onlyclear:first-child {
            background: #f6f5fb !important;
        }
    </style>
@endif