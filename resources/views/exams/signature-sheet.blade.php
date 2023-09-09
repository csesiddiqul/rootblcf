@extends('layouts.app')

@section('content')
<style>
.spn{
        border-bottom: 1px dashed #000000;
        padding-bottom: 2px;
}
.two-div {
    padding-left: 25px!important;
    padding-right: 25px!important;
    margin-top: 5px!important;
}
.p-for{
    margin-top: 35px!important;
}
.pl-0{
    padding-left: 0px !important;
}

table.table-bordered.dataTable th, table.table-bordered.dataTable td {
    border-left-width: 1px !important;
}
table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable td:last-child, table.table-bordered.dataTable td:last-child {
    border-right-width: 1px !important;
}

table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 1px !important;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
          <br>
          <div class="row">
             <div class="col-md-3 pr-0">
                <div class="forImg">
                    <img src="{{asset('image/demo.png')}}" alt="demo" style="width: 25%; float:right;">
                </div>
            </div>
               
                {{--<div class="col-md-3"></div>--}}
                   <!--  middle start -->

                   <div class="col-md-9 text-center">
                <div class="div2" style=" float: left; margin-top: 25px;">
                    <h3 style="font-size:20px; font-weight:bold; margin-top: 0px; margin-bottom: 5px;">Bangladesh language and cultural foundation</h3>

                    <span style="font-size:18px; font-weight:400;">{{school('address')}}</span></br>
                   
                   
                  <img src="{{asset('image/demo.png')}}" alt="demo" style="width: 16%; margin-top: 10px ;"><br>
                    <h4 class="margin">First Term Exam Signature Sheet</h4>
                    
        
                </div>
        
             </div>
                          
            
            
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <div class="clearfix"></div>
                <table class="table table-bordered  table-striped" style="border-collapse: collapse;" cellpadding="0" cellspacing="0">
                        <thead>
                          <tr>
                            <th scope="col" >SL</th>
                            <th scope="col">@lang('ID')</th>
                            <th scope="col">@lang('Roll')</th>
                            <th scope="col">@lang('Photo')</th>
                            <th scope="col">@lang('Student Name')</th>
                            <th scope="col">@lang('Bangla')</th>
                            <th scope="col">@lang('English')</th>
                            <th scope="col">@lang('Mathematics')</th>
                            <th scope="col">@lang('Religion')</th>
                            <th scope="col">@lang('G.Knowledge')</th>
                            <th scope="col">@lang('Drawing')</th>
                            <th scope="col">@lang('Global Studies')</th>
                            <th scope="col">@lang('Physical Exercise')</th>
                            <th scope="col">@lang('Date')</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                          <tr>
                            <td>saac</td>
                            <td>csa</td>
                            <td>cacc</td>
                            <td>cac</td>
                            <td>cac</td>
                            <td>cccccccca</td>
                            <td>cacaca</td>
                            <td>cacc</td>
                            <td>cacac</td>
                            <td>scac</td>
                            <td>scaccc</td>
                            <td>accc</td>
                            <td>cacscsc</td>
                            <td>10/12/20</td>
                            
                          </tr> <tr>
                            <td>saac</td>
                            <td>csa</td>
                            <td>cacc</td>
                            <td>cac</td>
                            <td>cac</td>
                            <td>cccccccca</td>
                            <td>cacaca</td>
                            <td>cacc</td>
                            <td>cacac</td>
                            <td>scac</td>
                            <td>scaccc</td>
                            <td>accc</td>
                            <td>cacscsc</td>
                            <td>10/12/20</td>
                            
                          </tr><tr>
                            <td>saac</td>
                            <td>csa</td>
                            <td>cacc</td>
                            <td>cac</td>
                            <td>cac</td>
                            <td>cccccccca</td>
                            <td>cacaca</td>
                            <td>cacc</td>
                            <td>cacac</td>
                            <td>scac</td>
                            <td>scaccc</td>
                            <td>accc</td>
                            <td>cacscsc</td>
                            <td>10/12/20</td>
                            
                          </tr>
                      
                        </tbody>
                      </table>
                    </div>
          </div>
      </div>
    </div>
</div>

    @endsection


