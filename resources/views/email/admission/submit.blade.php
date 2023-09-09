Dear Sir,
<br>
<br>
<p>Please be informed that an 'Admission Form' has been submitted to <a target="_blank" href="{{url('/')}}">{{school('name')}}</a>.
    <br>
</p>
<br>
<table>
    <tbody>
    <tr>
        <td>
            <h3><b>Admission Information :</b></h3>
        </td>
    </tr>
    <tr>
        <td><strong>Admission ID</strong></td>
        <td><span style="margin-right: 30px">:</span><b>{{$admission->roll}}</b></td>
    </tr>
    <tr>
        <td><strong>{{school('country')->code == 'BD' || 'SG' ? trans('Admission Class') : trans('Enroll In')}}</strong></td>
        <td><span style="margin-right: 30px">:</span><b>{{$admission->class->name}}</b></td>
    </tr>
    <tr>
        <td><strong>Student's Name</strong></td>
        <td><span style="margin-right: 30px">:</span><b>{{$admission->name}}</b></td>
    </tr>
    <tr>
        <td><strong>Father's Name</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$admission->father_name}}</b></td>
    </tr>
    <tr>
        <td><strong>Mother's Name</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$admission->mother_name}}</b></td>
    </tr>
    <tr>
        <td><strong>Mobile</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$admission->mobile}}</b></td>
    </tr>
    <tr>
        <td><strong>Gender</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{gender($admission->gender)}}</b></td>
    </tr>
    @if(school('country')->code == 'SG')
    <tr>
        <td><strong>Branch</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$admission->house->name}}</b></td>
    </tr>
    <tr>
        <td><strong>Resident Status</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{residentstatus($admission->singaporepr,true)}}</b></td>
    </tr>
    @endif
    <tr>
        <td><strong>Status</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{admissionstatus($admission->status)}}</b></td>
    </tr>
    <tr>
        <td><strong>Submitted Date</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{date('d M, Y',strtotime($admission->created_at))}}</b></td>
    </tr>
    </tbody>
</table>
<br>
<p>
    Click to view Admission Form View <a target="_blank" href="{{ route('academic.admission.show',$admission->id) }}">{{ route('academic.admission.show',$admission->id) }}</a>
</p>
<br>
<br>
Best Regards, <br><br>
Admin <br> <a target="_blank"
              href="{{url('/')}}">{{school('name')}}</a>
<br>
Email: <a href="mailto:{{foqas_setting('email')}}"
          target="_blank">{{foqas_setting('email')}}</a>
<br>
<br>
<p>
    This is an automatically generated e-mail. Please do not reply to this e-mail
    address. Thank you for your
    co-operation.
</p>
