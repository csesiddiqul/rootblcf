Dear Sir,
<br>
<br>
<p>Please be informed that an <b>'New Feedback'</b> has been Received to <a target="_blank" href="{{url('/')}}">{{school('name')}}</a>.
    <br>
</p>
<br>
<table>
    <tbody>
    <tr>
        <td colspan="2">
            <h3><b>Feedback Information :</b></h3>
        </td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td><span style="margin-right: 30px">:</span><b>{{$complain->name}}</b></td>
    </tr>
    <tr>
        <td><strong>Contact Number</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$complain->contactnumber}}</b></td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$complain->email}}</b></td>
    </tr>
    <tr>
        <td><strong>Submitted Date</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{date('d M, Y',strtotime($complain->created_at))}}</b></td>
    </tr>
    <tr>
        <td><strong>Description of Feedback</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$complain->description}}</b></td>
    </tr>
    </tbody>
</table>
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
