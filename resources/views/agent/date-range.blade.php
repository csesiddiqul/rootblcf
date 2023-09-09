<div class="date-range-search">
	@lang('Start date')@lang(':')</span> 
   <span class="inp-btn"><input id="startdate" value="{{date('m-d-Y', mktime(0, 0, 0, date('m')- ($rangemonth ?? 1), 1))}}" class="datepicker" autocomplete="off"></span>
	@lang('End date')@lang(':')</span>   
	<span class="inp-btn"><input id="enddate" value="{{date('m-d-Y',strtotime(now()))}}" class="datepicker" autocomplete="off"></span>  
	<span class="btn fltr-btn" id="filter">@lang('Filter')</span>    
	<a href="{{\Request::url()}}" class="btn fltr-btn">@lang('Refresh')</a>
</div>
@push('script') 
    <script type="text/javascript">  
        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) { 
                    var min = $('#startdate').datepicker("getDate");
                    var max = $('#enddate').datepicker("getDate");
                    var hireDate = new Date(data[4]);
                    if (min == null && max == null) { return true; }
                    if (min == null && hireDate <= max) { return true;}
                    if(max == null && hireDate >= min) {return true;}
                    if (hireDate <= max && hireDate >= min) { return true; }
                    return false;
                }
            );
        });
        $("#filter").click(function () { 
            var min = $('#startdate').datepicker("getDate");
            var max = $('#enddate').datepicker("getDate");
            if (min==null) {
                $("#startdate").focus().prop('required',true);  
                return false;
            };
            if (max==null) {
                $("#enddate").focus().prop('required',true); 
                return false; 
            };
            
            var myDataTable = $('.table').DataTable();
                myDataTable.draw();
        });
        $(function () {
            $('.datepicker').datepicker({  
                format: 'mm-dd-yyyy',
                autoclose: true,
                todayHighlight: true
            }); 
        });
    </script>
@endpush