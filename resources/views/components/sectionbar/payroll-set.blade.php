<div class="panel-heading"> 
    <form action="{{ route('payroll.index.setting') }}" method="post" class="form-inline" autocomplete="off">
        {{ csrf_field() }} 
        <div class="form-group"> 
            <div class="input-group">
                <label for="monthfor" class="input-group-addon">Payroll for the month of</label>
                <input type="text" name="payrollMonth" value="{{ $schData->payrollMonth ? $schData->payrollMonth : date('Y-m-d') }}" class="form-control" id="monthfor" placeholder="{{ date('Y-m-d') }}" required> 
            </div>
        </div>
        <div class="form-group pl-15"> 
            <div class="input-group" style="border: 1px solid #dce4ec;"> 
                <div style="border: 0px;" class="input-group-addon">For the</div>
                <input value="1" style="margin: 0px;" type="radio" {{$schData->payFor == 1 ? 'checked' : ''}} class="form-control" id="radio1" name="emptype" required>
                <label style="border: 0px;" for="radio1" class="input-group-addon pl-5">Teacher</label> 
                <input value="2" style="margin: 0px;" type="radio" {{$schData->payFor == 2 ? 'checked' : ''}} class="form-control" id="radio2" name="emptype" required> 
                <label style="border: 0px;" for="radio2" class="input-group-addon pl-5">Employee</label> 
            </div>
        </div>
        <div class="form-group pl-15" style="padding-right: 15px;"> 
            <div class="input-group" style="border: 1px solid #dce4ec;padding-left:10px;"> 
                <input style="margin: 0px;" type="checkbox" name="bonus" value="1" {{$schData->bonus == 1 ? 'checked' : ''}} class="form-control" id="checkbox"> 
                <label style="border: 0px;" for="checkbox" class="input-group-addon pl-5">Bonus</label>
            </div>
        </div> 
        <button style="display: inline-block;width:100px;" type="submit" class="btn btn-info btn-block btn-sm">@lang('Set Now') </button> 
    </form>
    <div style="clear:both;"></div>
</div>

@push('script') 
<script>
    $(function () {
        $('#monthfor').datepicker({
            format: "yyyy-mm-dd",  
            autoclose: true
        });
    });
</script>
@endpush