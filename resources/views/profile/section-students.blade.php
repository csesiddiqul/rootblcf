@extends('layouts.app')

@section('title', __('Course Students'))

@section('content')
    <!-- Add the SheetJS library -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <ol class="breadcrumb" style="margin-top: 3%;">
                    @if(isset($_GET['grade']) && $_GET['grade'] == 1)
                        <li><a href="{{route('grades.index')}}" style="color:#3b80ef;">@lang('Grades')</a></li>
                    @else
                        <li><a href="{{url('school/sections?course=1')}}" style="color:#3b80ef;">@lang('Section')</a>
                        </li>
                    @endif
                    <li class="active">@lang('Students')</li>
                </ol>

                <button onclick="downloadExcelFile()">Download Excel</button>



                <div  id="myPrintArea" class="panel panel-default">


{{--                    <p id="notShow">Only this part will be printed when the button is clicked.</p>--}}

                    @if(count($students) > 0)
                        <div class="panel-body">
                            <table id="example" class="table myDataAll table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('Sl')</th>
                                    <th scope="col">@lang('Student Code')</th>
                                    <th scope="col">@lang('Student Name')</th>
                                    <th scope="col">@lang('Father Name')</th>
                                    <th scope="col">@lang('Mother Name')</th>
                                    <th scope="col">@lang('Class Roll')</th>
                                    <th scope="col">@lang('Class')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Grade History')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{($loop->index+1)}}</td>
                                        <td>{{$student->student_code}}</td>
                                        <td><a href="{{url('user/'.$student->student_code)}}">{{$student->name}}</a>
                                        </td>

                                        <td>
                                            {{$student->father_name}}
                                        </td>
                                        <td>
                                            {{$student->mother_name}}
                                        </td>
                                        <td>
                                            {{$student->class_roll}}
                                        </td>
                                        <td>
                                            {{$student->section->class->name}}
                                        </td>

                                        <td>
                                            @if(isset($student->studentInfo['session']) && ($student->studentInfo['session'] == now()->year || $student->studentInfo['session'] > now()->year))
                                                <span class="label label-success">@lang('Promoted/New')</span>
                                            @else
                                                <span class="label label-danger">@lang('Not Promoted')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a  class="btn btn-xs btn-success" role="button"
                                               href="{{route('grade.each_student',$student->student_code)}}">@lang('View Grade History')</a>
                                            <a    class="btn btn-xs btn-info" role="button"
                                                href="{{route('grades.index','section='. $student->section_id.'&id='.$student->student_code)}}">@lang('Print Grade History')</a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="panel-body">
                            @lang('No Related Data Found.')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



@endsection

@push('script')
    <script>


        new DataTable('#example', {
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ]
        });


        function downloadExcelFile() {
            var data = [
                ['Sl', 'Student Code', 'Student Name', 'Father Name', 'Mother Name', 'Class Roll', 'Class']
            ];

            // Extract data from the table and add it to the 'data' array
            var table = document.querySelector('.myDataAll');
            var rows = table.getElementsByTagName('tr');
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i].getElementsByTagName('td');
                var rowData = [];
                for (var j = 0; j < row.length; j++) {
                    rowData.push(row[j].innerText.trim());
                }
                // Remove the last two columns (Status and Grade History)
                rowData.pop();
                rowData.pop();
                data.push(rowData);
            }

            var sheetName = 'Course_Students';
            var workbook = XLSX.utils.book_new();
            var worksheet = XLSX.utils.aoa_to_sheet(data);

            XLSX.utils.book_append_sheet(workbook, worksheet, sheetName);

            var wopts = { bookType: 'xlsx', bookSST: false, type: 'binary' };

            var wbout = XLSX.write(workbook, wopts);

            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
                return buf;
            }

            var blob = new Blob([s2ab(wbout)], { type: 'application/octet-stream' });

            var filename = 'Course_Students.xlsx';
            if (window.navigator.msSaveBlob) {
                // For Microsoft Edge or Internet Explorer
                window.navigator.msSaveBlob(blob, filename);
            } else {
                // For other modern browsers
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }
        }
    </script>




@endpush