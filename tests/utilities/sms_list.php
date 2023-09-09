<?php
if (!function_exists('admission_submit_sms')) {
    function admission_submit_sms($data)
    {
        if (foqas_setting('admission_submit_sms') == 1 || foqas_setting('admission_submit_admin_sms') == 1) {
            $msg = $data->name . ', application submitted for admission to ' . school('name') . '  in class ' . $data->class->name . ' Admission ID ' . $data->roll;
            send_sms($data->mobile, $msg);
        }
    }
}
if (!function_exists('admission_approved_sms')) {
    function admission_approved_sms($data)
    {
        if (foqas_setting('admission_approved_sms') == 1) {
            $msg = $data->name . ', application approved for admission to ' . school('name') . '  in class ' . $data->class->name . ' Admission ID ' . $data->roll .' & Password: ' . $data->add_pass;
            send_sms($data->mobile, $msg);
        }
    }
}
if (!function_exists('admission_payment_sms')) {
    function admission_payment_sms($data)
    {
        if (foqas_setting('admission_payment_sms') == 1) {
            $msg = 'Congrats! ' . strtoupper($data->name) . ', your payment has been successful for admission to ' . school('name') . ' in class ' . $data->class->name . '. Your TrxID: ' . $data->admissionPayment->trans_number . ',  Admission ID: ' . $data->roll . ' & Password: ' . $data->add_pass;
            send_sms($data->mobile, $msg);
        }
    }
}
if (!function_exists('student_notification_sms')) {
    function student_notification_sms($phone, $message)
    {
        if (foqas_setting('notification_sms') == 1) {
            send_sms($phone, $message);
        }
    }
}
if (!function_exists('admission_lottery_sms')) {
    function admission_lottery_sms($data)
    {
        $message = 'Congrats! ' . strtoupper($data->name) . ', your are selected for admission to ' . school('name') . ' in class ' . $data->class->name;
        send_sms($data->mobile, $message);
    }
}
if (!function_exists('student_payment_sms')) {
    function student_payment_sms($data)
    {
        $message = strtoupper($data['name']) . ', your payment has been successful complete in ' . school('name') . ' Your TrxID: ' . $data['tranxID'] . ',  Amount : ' . number_format($data['amount'], 2) . (school('country')->code ? 'Tk' : '$');
        send_sms($data['mobile'], $message);
    }
}