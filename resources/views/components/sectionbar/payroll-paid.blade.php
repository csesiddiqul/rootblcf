@if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')  
    <div class="panel-heading" style="padding: 5px 5px 0px 5px;">  
        <ul class="nav nav-tabs" role="tablist" style="margin-bottom:-1px;">
            <li role="presentation" class="{{(\Request::url() == url('payroll/paidlist/1'))? 'active':'teacher'}}"><a href="{{ url('payroll/paidlist/1') }}">&nbsp; Teacher &nbsp;</a></li>
            <li role="presentation" class="{{(\Request::url() == url('payroll/paidlist/2'))? 'active':'employee'}}"><a href="{{ url('payroll/paidlist/2') }}">&nbsp; Employee &nbsp;</a></li> 
            <li class="pull-right"><a class="bg-info" style="cursor: pointer;" href="{{ url('payroll/paidlist/'.$ids) }}">&nbsp; Refresh &nbsp;</a></li> 
        </ul> 
    </div>
    <div class="panel-body">
        <form action="{{ route('payroll.index.paidlist',$ids) }}" method="post" class="form-inline" autocomplete="off">
            {{ csrf_field() }} 
            <div class="row">
                <div class="form-group col-sm-3 col-md-3"> 
                    <div class="input-group w-100">
                        <label for="formMonth" class="input-group-addon">Month From</label>
                        <input type="text" name="formMonth" value="{{ $form_val }}" class="form-control" id="formMonth" placeholder="{{ date('Y-m-01') }}" required> 
                    </div>
                </div>
                <div class="form-group col-sm-3 col-md-3"> 
                    <div class="input-group w-100">
                        <label for="toMonth" class="input-group-addon">Month To</label>
                        <input type="text" name="toMonth" value="{{ $to_val }}" class="form-control" id="toMonth" placeholder="{{ date('Y-m-t') }}"> 
                    </div>
                </div>
                <div class="form-group col-sm-4 col-md-4"> 
                    <div class="input-group w-100"> 
                        <label for="emplistget" class="input-group-addon">Select</label>
                        <select name="emplistget" id="emplistget" class="select2 form-control">
                            <option value="">{{($ids == 1)? '-- Teacher Name --':'-- Employee Name --'}}</option>
                            @foreach ($emplists as $emplist) 
                                <option value="{{ $emplist->id }}" {{ $emplist->id == $selected ? 'selected':'' }}>{{ $emplist->name }}</option>
                            @endforeach
                        </select> 
                    </div>
                </div> 
                <div class="form-group col-sm-2 col-md-2 p-0">
                    <button style="display: inline-block;width:45%;height:37px;" type="submit" class="btn btn-info btn-sm">@lang('Search') </button> 
                   <button onclick="printPage()" style="display: inline-block;width:45%;height:37px;" class="btn btn-sm btn-warning">Print</button>
                </div>
            </div>
        </form>
        <div style="clear:both;"></div>
    </div>

    @push('script') 
    <script>
        $(function () {
            $('#formMonth, #toMonth').datepicker({
                format: "yyyy-mm-dd",  
                autoclose: true
            });
        });
    </script>
    @endpush
@endif