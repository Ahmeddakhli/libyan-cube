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
    "accepted" => "يجب قبول :attribute.",
    "active_url" => " :attribute ليست عنوان URL صالحًا.",
    "after" => "يجب أن يكون :attribute تاريخًا بعد التاريخ.",
    "after_or_equal" => "يجب أن يكون :attribute تاريخًا بعد أو يساوي date.",
    "alpha" => "لا يجوز أن تحتوي :attribute إلا على أحرف.",
    "alpha_dash" => "لا يجوز أن تحتوي :attribute إلا على أحرف وأرقام وشرطات وشرطات سفلية.",
    "alpha_num" => "لا يجوز أن تحتوي :attribute إلا على أحرف وأرقام.",
    "array" => "يجب أن تكون :attribute مصفوفة.",
    "before" => "يجب أن يكون :attribute تاريخًا قبل التاريخ.",
    "before_or_equal" => "يجب أن يكون :attribute تاريخًا يسبق أو يساوي",

    "between" => [
        "numeric" => "يجب أن يكون :attribute بين min و max.",
        "file" => "يجب أن تكون سمة بين min و max كيلوبايت.",
        "string" => "يجب أن يكون :attribute بين min و max حرفًا.",
        "array" => "يجب أن تحتوي :attribute على ما بين min و max items.",
    ],
    "boolean" => "يجب أن يكون حقل :attribute صحيحًا أو خطأ.",
    "confirmed" => "تأكيد :attribute غير متطابق.",
    "date" => " :attribute ليست تاريخًا صالحًا.",
    "date_equals" => "يجب أن يكون :attribute تاريخًا مساويًا لـ date.",
    "date_format" => " :attribute لا تتطابق مع التنسيق format.",
    "different" => "يجب أن يكون :attribute و الآخر مختلفين.",
    "digits" => "يجب أن يكون :attribute digits digits.",
    "digits_between" => " يجب أن تكون :attribute بين min و max digits.",
    "dimensions" => " :attribute لها أبعاد صورة غير صالحة.",
    "distinct" => "يحتوي حقل :attribute على قيمة مكررة.",
    "email" => "يجب أن يكون عنوان بريد إلكتروني صالحًا.",
    "exists" => ":attribute المحددة غير صالحة.",
    "file" => "يجب أن تكون :attribute ملفًا.",
    "filled" => "يجب أن يكون لحقل :attribute قيمة.",
    "gt" => [
        "numeric" => "يجب أن يكون :attribute أكبر من value.",
        "file" => "يجب أن يكون :attribute أكبر من value كيلوبايت.",
        "string" => "يجب أن يكون :attribute أكبر من value character.",
        "array" => "يجب أن تحتوي :attribute على أكثر من عناصر القيمة.",
    ],
    "gte" => [
        "numeric" => "يجب أن يكون :attribute أكبر من أو يساوي value.",
        "file" => "يجب أن يكون :attribute أكبر من أو يساوي value كيلوبايت.",
        "string" => "يجب أن يكون :attribute أكبر من أو يساوي value أحرف.",
        "array" => "يجب أن تحتوي :attribute على عناصر قيمة أو أكثر.",
    ],
    "image" => " :attribute يجب أن تكون صورة.",
    "in" => ":attribute المحددة غير صالحة.",
    "in_array" => " حقل :attribute غير موجود في أخرى.",
    "integer" => "يجب أن يكون :attribute عددًا صحيحًا.",
    "ip" => "يجب أن يكون :attribute عنوان IP صالحًا.",
    "ipv4" => "يجب أن يكون :attribute عنوان IPv4 صالحًا.",
    "ipv6" => "يجب أن يكون :attribute عنوان IPv6 صالحًا.",
    "json" => "يجب أن يكون :attribute سلسلة JSON صالحة.",
    "lt" => [
        "numeric" => "يجب أن يكون :attribute أقل من value.",
        "file" => "يجب أن تكون سمة أقل من value كيلوبايت.",
        "string" => "يجب أن يكون :attribute أقل من أحرف القيمة.",
        "array" => "يجب أن تحتوي :attribute على أقل من value items.",
    ],
    "lte" => [
        "numeric" => "يجب أن يكون :attribute أقل من أو يساوي value.",
        "file" => "يجب أن يكون :attribute أقل من أو يساوي value كيلوبايت.",
        "string" => "يجب أن تكون سمة أقل من أو تساوي أحرف القيمة.",
        "array" => "يجب ألا تحتوي :attribute على أكثر من value items.",
    ],
    "ماكس" => [
        "numeric" => "لا يجوز أن يكون :attribute أكبر من max.",
        "file" => "لا يجوز أن يكون :attribute أكبر من max كيلوبايت.",
        "string" => "لا يجوز أن يكون :attribute أكبر من max حرفًا.",
        "array" => "لا يجوز أن تحتوي :attribute على أكثر من max items.",
    ],
    "mimes" => "يجب أن يكون :attribute ملفًا من النوع القيم.",
    "mimetypes" => "يجب أن يكون :attribute ملفًا من النوع القيم.",
    "min" => [
        "numeric" => "يجب أن يكون :attribute على الأقل min.",
        "file" => "يجب أن يكون حجم :attribute على الأقل min كيلوبايت.",
        "string" => "يجب ألا يقل عدد :attribute عن min من الأحرف.",
        "array" => "يجب أن تحتوي :attribute على الأقل على min من العناصر.",
    ],
    "not_in" => ":attribute المحددة غير صالحة.",
    "not_regex" => "تنسيق :attribute غير صالح.",
    "numeric" => "يجب أن يكون :attribute رقمًا.",
    "present" => "يجب أن يكون حقل :attribute موجودًا.",
    "regex" => "تنسيق :attribute غير صالح.",
    "required" => " حقل :attribute مطلوب.",
    "required_if" => "يكون حقل :attribute مطلوبًا عندما الآخر هو القيمة.",
    "required_unless" => "حقل :attribute مطلوب إلا إذا كان الآخر في القيم.",
    "required_with" => "حقل :attribute مطلوب عندما القيم موجودة.",
    "required_with_all" => " حقل :attribute مطلوب عندما القيم موجودة.",
    "required_without" => "حقل :attribute مطلوب عندما القيم غير موجودة.",
    "required_without_all" => "حقل :attribute مطلوب في حالة عدم وجود أي من القيم.",
    "same" => "يجب أن يتطابق :attribute و الآخر.",
    "size" => [
        "numeric" => "يجب أن يكون :attribute size.",
        "file" => "يجب أن يكون :attribute الحجم بالكيلو بايت.",
        "string" => "يجب أن يكون :attribute حجم الأحرف.",
        "array" => "يجب أن تحتوي :attribute على size items.",
    ],
    "begin_with" => " يجب أن تبدأ :attribute بواحد مما يلي القيم",
    "string" => " :attribute يجب أن تكون سلسلة.",
    "timezone" => " يجب أن تكون :attribute منطقة صالحة.",
    "unique" => " :attribute مأخوذة بالفعل.",
    "uploaded" => " فشل تحميل :attribute.",
    "url" => "تنسيق :attribute غير صالح.",
    "uuid" => " :attribute يجب أن تكون UUID صالحًا.",
    "best_time_to_call_from" => "أفضل وقت للاتصال من",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for :attributes using the
    | convention ":attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given :attribute rule.
    |
    */

    "custom" => [
        ":attribute-name" => [
            "rule-name" => "رسالة مخصصة",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation :Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our :attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    ":attributes" => [
        'password' => 'كلمة السر'
    ],

    // Phone Validation
    "phone" => "يحتوي حقل :attribute على رقم غير صالح."
];
