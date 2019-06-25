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

    'accepted'             => ':attribute باید پذیرفته شود.',
    'active_url'           => ':attribute لینک نیست.',
    'after'                => ':attribute باید یه زمانی بعد از :date باشد.',
    'alpha'                => ':attribute فقط می تواند شامل حروف باشد.',
    'alpha_dash'           => ':attribute فقط میتواند شامل حروف و اعداد و فاصله باشد.',
    'alpha_num'            => ':attribute فقط میتواند شامل حروف و اعداد باشد.',
    'array'                => ':attribute باید یک آرایه باشد.',
    'before'               => ':attribute میتواند یک زمان قبل از :date باشد .',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file'    => ': attribute باید بین :min و :max کیلوبایت باشد.',
        'string'  => ': :attribute باید بین :min و :max کاراکتر باشد.',
        'array'   => ': :attribute باید بین :min و :max عدد باشد.',
    ],
    'boolean'              => ':فیلد باید دارای :attribute درستی یا نادرستی باشد..',
    'confirmed'            => ':تایید :attribute مطابقت ندارد.',
    'date'                 => ':attribute دارای یک تاریخ معتبر نمی باشد.',
    'date_format'          => ':attribute از فرمت پشتیبانی نمیکند :format.',
    'different'            => ':attribute و :other باید تفاوت داشته باشد.',
    'digits'               => ':attribute باید حاوی :digits باشد .',
    'digits_between'       => ':attribute باید بین :min و :max باشد.',
    'email'                => ':attribute باید یک آدرس ایمیل معتبر باشد.',
    'exists'               => 'selected :attribute نامعتبر است',
    'filled'               => ':فیل :attribute دارای اهمیت است.',
    'image'                => ':attribute باید یک عکس باشد.',
    'in'                   => ':attribute انتخاب شده نامعتبر است.',
    'integer'              => ':attribute باید یک عدد صحیح باشد.',
    'ip'                   => ':attribute باید یک آدرس آی پی معتبر باشد.',
    'json'                 => ':attribute باید یک رشته json معتبر باشد.',
    'max'                  => [
        'numeric' => ':attribute نباید از مقدار :max بیشتر باشد.',
        'file'    => ':attribute نباید از مقدار :max کیلوبایت بزرگتر باشد .',
        'string'  => ':attribute نباید از مقدار :max کاراکتر بیشتر باشد.',
        'array'   => ':attribute نباید از مقدار :max آیتم بیشتر باشد',
    ],
    'mimes'                => ':attribute باید یک فایل از نوع :values مقداری باشد. .',
    'min'                  => [
        'numeric' => ':attribute باید حداقل :min باشد.',
        'file'    => ':attribute باید حداقل :min کیلوبایت را دارا باشد.',
        'string'  => ':attribute باید حداقل :min کراکتر را داشته باشد.',
        'array'   => ':attribute باید حداقل :min آیتم را داشته باشد.',
    ],
    'not_in'               => ':attribute انتخاب شده نامعتبر است.',
    'numeric'              => ':attribute باید یک عدد باشد.',
    'regex'                => 'فرمت :attribute نمعتبر است.',
    'required'             => 'فیلد :attribute الزامی است.',
    'required_if'          => ':attribute وقتی خواسته میشود که دیگر موارد مقدار دهی شده باشد.',
    'required_unless'      => ':attribute تا زمانی که دیگز موارد مقدار دهی نشده اند خواسته نمیشود.',
    'required_with'        => 'فیلد :attribute زمانی پر میشود که مقداری برای آن وجود داشته باشد.',
    'required_with_all'    => 'فیلد :attribute زمانی پر میشود که مقداری برای آن وجود داشته باشد ',
    'required_without'     => 'فیلد :attribute زمانی پر میشود که مقداری برای آن وجود داشته باشد.',
    'required_without_all' => 'فیلد :attribute زمانی خواسته  میشود که هیچ مقداری برای آن وجود نداشته باشد ',
    'same'                 => ':attribute با :other باید همخوانی داشته باشد',
    'size'                 => [
        'numeric' => ':attribute باید :size  باشد.',
        'file'    => ':attribute باید :size کیلو بایتی باشد.',
        'string'  => ':attribute باید :size کاراکتری باشد.',
        'array'   => ':attribute باید تعداد :size باشد .',
    ],
    'string'               => ':attribute باید یک رشته باشد.',
    'timezone'             => ':attribute باید یک ناحیه جغرافیایی معتبر باشد.',
    'unique'               => 'این :attribute قبلا ثبت شده است.',
    'url'                  => 'فرمت :attribute نامعتبر است.',
    /*my messages*/
    'my_mobile'                  => ':attribute را صحیح وارد نمایید.',
    'repassword'                  => 'رمزهای عبور مطابقت ندارند.',
    'captcha'                  => 'لطفا رباط نبودن خود را ثابت کنید.',
    'persian_title'                  => ':attribute باید فقط شامل اعداد و حروف باشد',

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
        'rate-1' => [
            'required' => 'حداقل امتیاز ۱ ستاره است',
        ],
        'rate-2' => [
            'required' => 'حداقل امتیاز ۱ ستاره است',
        ],
        'rate-3' => [
            'required' => 'حداقل امتیاز ۱ ستاره است',
        ],
        'rate-4' => [
            'required' => 'حداقل امتیاز ۱ ستاره است',
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

    'attributes' => [
        'name'          =>   'نام',
        'lastname'      =>   'نام خانوادگی',
        'email'         =>   'ایمیل',
        'password'      =>   'پسورد',
    ],

];
