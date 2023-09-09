Dear Sir,
<br>
<br>
<p>This is for your kind information that a message has been received through <b>'CONTACT US'</b> page of <a target="_blank" href="{{url('/')}}">{{school('name')}}</a>.
    <br>
</p>
<br>
<table>
    <tbody>
    <tr>
        <td colspan="2">
            <h3><b>Contact Person Information :</b></h3>
        </td>
    </tr>
    <tr>
        <td><strong>Subject</strong></td>
        <td><span style="margin-right: 30px">:</span><b>{{$contact->subject}}</b></td>
    </tr>
    <tr>
        <td><strong>Contact's Name</strong></td>
        <td><span style="margin-right: 30px">:</span><b>{{$contact->name}}</b></td>
    </tr>
    <tr>
        <td><strong>Phone</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$contact->phone}}</b></td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$contact->email}}</b></td>
    </tr>
    <tr>
        <td><strong>Submitted Date</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{date('d M, Y',strtotime($contact->created_at))}}</b></td>
    </tr>
    <tr>
        <td><strong>Message</strong></td>
        <td><span  style="margin-right: 30px">:</span><b>{{$contact->message}}</b></td>
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
