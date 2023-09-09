<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'এই :attribute অবশ্যই গ্রহণ করতে হবে।',
    'active_url'           => 'এই :attribute কোনও বৈধ ইউআরএল নয়।',
    'after'                => 'এই :attribute অবশ্যই :date এর একটি তারিখ হতে হবে',
    'after_or_equal'       => 'এই :attribute টি, :date এর পরে বা সমান তারিখ হতে হবে.',
    'alpha'                => 'এই :attribute কেবলমাত্র বর্ণ থাকতে পারে।',
    'alpha_dash'           => 'এই :attribute কেবলমাত্র বর্ণ, সংখ্যা এবং ড্যাশ থাকতে পারে।',
    'alpha_num'            => 'এই :attribute কেবলমাত্র অক্ষর এবং সংখ্যা থাকতে পারে।',
    'array'                => 'এই :attribute একটি অ্যারে হতে হবে।',
    'before'               => 'এই :attribute অবশ্যই :date এর আগে একটি তারিখ হতে হবে ।',
    'before_or_equal'      => 'এই :attribute টি, :date এর আগে বা সমান তারিখ হতে হবে ।',
    'between'              => [
        'numeric' => 'এই :attribute এর মধ্যে হতে হবে :min এবং :max.',
        'file'    => 'এই :attribute এর মধ্যে হতে হবে :min এবং :max কিলোবাইট ।',
        'string'  => 'এই :attribute এর মধ্যে হতে হবে :min এবং :max অক্ষর ।',
        'array'   => 'এই :attribute এর মধ্যে হতে হবে :min এবং :max আইটেম ।',
    ],
    'boolean'              => 'এই :attribute ক্ষেত্রটি অবশ্যই সত্য বা মিথ্যা।',
    'confirmed'            => 'এই :attribute নিশ্চিতকরণ মেলে না।',
    'date'                 => 'এই :attribute টি বৈধ তারিখ নয়।',
    'date_format'          => 'এই :attribute টি এই :format বিন্যাসের সাথে মেলে না ।',
    'different'            => 'এই :attribute এবং :other অবশ্যই আলাদা হতে হবে।',
    'digits'               => 'এই :attribute অবশ্যই :digits সংখ্যা হতে হবে ।',
    'digits_between'       => 'এই :attribute এর মধ্যে হতে হবে :min এবং :max সংখ্যা।',
    'dimensions'           => 'এই :attribute অবৈধ চিত্রের মাত্রা রয়েছে।',
    'distinct'             => 'এই :attribute টির ইতিমধ্যে ডুপ্লিকেট  মান রয়েছে।',
    'email'                => 'এই :attribute একটি বৈধ ইমেইল ঠিকানা আবশ্যক ।',
    'exists'               => 'এই নির্বাচিত :attribute টি অবৈধ ।',
    'file'                 => 'এই :attribute একটি ফাইল হতে হবে।',
    'filled'               => 'এই :attribute ক্ষেত্রের অবশ্যই একটি মান থাকতে হবে।',
    'image'                => 'এই :attribute অবশ্যই একটি চিত্র হতে হবে।',
    'in'                   => 'এই নির্বাচিত :attribute টি অবৈধ ।',
    'in_array'             => 'এই :attribute টি :other এই ক্ষেত্র বিদ্যমান নেই ।',
    'integer'              => 'এই :attribute একটি পূর্ণসংখ্যা হতে হবে.',
    'ip'                   => 'এই :attribute অবশ্যই একটি বৈধ আইপি ঠিকানা হতে হবে।',
    'ipv4'                 => 'এই :attribute অবশ্যই একটি বৈধ IPv4 ঠিকানা হতে হবে।',
    'ipv6'                 => 'এই :attribute অবশ্যই একটি বৈধ IPv6 ঠিকানা হতে হবে।',
    'json'                 => 'এই :attribute অবশ্যই একটি বৈধ JSON স্ট্রিং হওয়া উচিত।',
    'max'                  => [
        'numeric' => 'এই :attribute টি এই :max চেয়ে বড় নাও হতে পারে।',
        'file'    => 'এই :attribute এর চেয়ে বেশি নাও হতে পারে :max কিলোবাইট।',
        'string'  => 'এই :attribute এর চেয়ে বেশি নাও হতে পারে :max অক্ষর।',
        'array'   => 'এই :attribute এর চেয়ে বেশি নাও হতে পারে :max আইটেম।',
    ],
    'mimes'                => 'এই :attribute টি এই প্রকারের একটি ফাইল হতে হবে: :values.',
    'mimetypes'            => 'এই :attribute ি এই প্রকারের একটি ফাইল হতে হবে: :values.',
    'min'                  => [
        'numeric' => 'এই :attribute টির ন্যূনতম মান :min.',
        'file'    => 'এই :attribute টির অবশ্যই ন্যূনতম মান :min কিলোবাইট।',
        'string'  => 'এই :attribute টির অবশ্যই ন্যূনতম মান :min অক্ষর।',
        'array'   => 'এই :attribute টির অবশ্যই ন্যূনতম মান :min আইটেম।',
    ],
    'not_in'               => 'এই নির্বাচিত :attribute টি অবৈধ।',
    'numeric'              => 'এই :attribute অবশ্যই একটি সংখ্যা হবে.',
    'present'              => 'এই :attribute ক্ষেত্র উপস্থিত থাকতে হবে।',
    'regex'                => 'এই :attribute ফর্ম্যাটটি অবৈধ।',
    'required'             => 'এই :attribute টি অবশ্যই পূরণ করতে হবে।',
    'required_if'          => 'এই :attribute ক্ষেত্র প্রয়োজন যখন :other হল :value।',
    'required_unless'      => 'এই :attribute ক্ষেত্র প্রয়োজন হয় না হলে :other ভিতরে আছে :values.',
    'required_with'        => 'এই :attribute যখন প্রয়োজন হয় :values উপস্থিত।',
    'required_with_all'    => 'এই :attribute যখন প্রয়োজন হয় :values উপস্থিত।',
    'required_without'     => 'এই :attribute যখন প্রয়োজন হয় :values উপস্থিত নয়।',
    'required_without_all' => 'এই :attribute যখন প্রয়োজন হয় তখন প্রয়োজন :values উপস্থিত আছেন।',
    'same'                 => 'এই :attribute এবং :other মিল থাকতে হবে।',
    'size'                 => [
        'numeric' => 'এই :attribute অবশ্যই :size.',
        'file'    => 'এই :attribute অবশ্যই :size কিলোবাইট।',
        'string'  => 'এই :attribute অবশ্যই :size অক্ষর।',
        'array'   => 'এই :attribute অবশ্যই থাকতে হবে :size আইটেম।',
    ],
    'string'               => 'এই :attribute একটি স্ট্রিং হতে হবে।',
    'timezone'             => 'এই :attribute অবশ্যই একটি বৈধ টাইমজোন হতে হবে।',
    'unique'               => 'এই :attribute আগেই নেয়া হয়েছে.',
    'uploaded'             => 'এই :attribute আপলোড করতে ব্যর্থ।',
    'url'                  => 'এই :attribute ফর্ম্যাটটি সঠিক নয়।',
    'required_field'       => 'এই attribute পূরণ করতে হবে।',
    'success'              => 'সমস্ত পরিবর্তন আপডেট করা হয়েছে',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
