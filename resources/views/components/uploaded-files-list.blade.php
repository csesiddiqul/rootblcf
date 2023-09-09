<div class="table-responsive">
    <table class="table table-bordered table-data-div table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('File Name')</th>
            @if($upload_type == 'syllabus' && $parent == 'class')
                <th scope="col">@lang('Class')</th>
            @elseif($upload_type == 'routine' && $parent == 'section')
                <th scope="col">@lang('section')</th>
            @elseif($upload_type == 'certificate')
                <th scope="col">Certificates</th>
            @endif
            <th scope="col">@lang('Status')</th>
            <th scope="col">@lang('Action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($files as $file)
            <tr>
                <td>{{($loop->index + 1)}}</td>
                <td><a href="{{url($file->file_path)}}" target="_blank">{{$file->title}}</a></td>
                @if($upload_type == 'syllabus' && $parent == 'class')
                    <td>{{$file->myclass->class_number}}</td>
                @elseif($upload_type == 'routine' && $parent == 'section')
                    <td>{{$file->section->section_number}}</td>
                @elseif($upload_type == 'certificate')
                    @isset($file->student->name)
                        <td>{{$file->student->name}}</td>
                    @endisset
                    @empty($file->student)
                        <td>Student Code: <span style="color: #d93025;">{{$file->given_to}}</span> does not exist</td>
                    @endempty
                @endif
                <td class="width-100">
                    <a class="btn btn-xs btn-block btn-{{$file->active == 0 ? 'danger' : 'success'}}"
                       href="javascript:void(0)"
                       onclick="confirmStatus('{{$file->id}}','{{$file->active == 0 ? 'published?' : 'unpublished?'}}')">@lang($file->active == 1 ? 'Published' : 'Unpublished')</a>

                    <form id="confirm_form_{{$file->id}}"
                          action="{{route('academic.remove.'.$upload_type,[$file->id,($file->active == 1 ? 1 : 0)])}}"
                          method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </td>
                <td class="width-100">
                    <a class="btn btn-xs btn-block btn-danger"
                       onclick="confirm_delete('{{$file->id}}')">@lang('Delete')</a>
                    <form id="delete_form_{{$file->id}}"
                          action="{{route('academic.remove.'.$upload_type,[$file->id,$file->active])}}"
                          method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
