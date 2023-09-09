@php
    $status = false;
    if (session('school_expired'))
          $status = true;
    if (\Route::current()->getName() == 'school.subscription.plans' || \Route::current()->getName() == 'school.subscription')
        $status = false;
@endphp
@if($status)
    <script>
        (async () => {
            Swal.fire({
                title: '<strong>{{trans('School Expired')}}</strong>',
                icon: 'info',
                html:
                    '<h4>{{transMsg('Your school has been expired')}}' +
                    ' <a href="{{route('school.subscription.plans')}}" class="btn-link">{{transMsg('Renew now')}}</a></h4>',
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false,
                focusConfirm: false,
                allowOutsideClick: false
            })
        })()
    </script>
@endif