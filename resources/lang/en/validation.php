<?php

return [
    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'active_url' => 'Trường :attribute không phải là một URL hợp lệ.',
    'after' => 'Trường :attribute phải là một ngày sau ngày :date.',
    'after_or_equal' => 'Trường :attribute phải là một ngày sau hoặc bằng ngày :date.',
    'alpha' => 'Trường :attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ có thể chứa chữ cái, số, dấu gạch ngang và gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ có thể chứa chữ cái và số.',
    'array' => 'Trường :attribute phải là một mảng.',
    'before' => 'Trường :attribute phải là một ngày trước ngày :date.',
    'before_or_equal' => 'Trường :attribute phải là một ngày trước hoặc bằng ngày :date.',
    'between' => [
        'numeric' => 'Trường :attribute phải nằm trong khoảng :min - :max.',
        'file' => 'Dung lượng tập tin :attribute phải từ :min - :max kB.',
        'string' => 'Trường :attribute phải từ :min - :max ký tự.',
        'array' => 'Trường :attribute phải có từ :min - :max phần tử.',
    ],
    'boolean' => 'Trường :attribute phải là true hoặc false.',
    'confirmed' => 'Xác nhận trường :attribute không khớp.',
    'date' => 'Trường :attribute không phải là định dạng của ngày-tháng.',
    'date_equals' => 'Trường :attribute phải là một ngày bằng với :date.',
    'date_format' => 'Trường :attribute không phù hợp với định dạng :format.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Trường :attribute phải là :digits chữ số.',
    'digits_between' => 'Trường :attribute phải từ :min đến :max chữ số.',
    'dimensions' => 'Trường :attribute có kích thước không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong những giá trị sau: :values',
    'exists' => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'file' => 'Trường :attribute phải là một tệp tin.',
    'filled' => 'Trường :attribute không được bỏ trống.',
    'gt' => [
        'numeric' => 'Trường :attribute phải lớn hơn :value.',
        'file' => 'Dung lượng tập tin :attribute phải lớn hơn :value kB.',
        'string' => 'Trường :attribute phải nhiều hơn :value ký tự.',
        'array' => 'Trường :attribute phải có nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => 'Trường :attribute phải lớn hơn hoặc bằng :value.',
        'file' => 'Dung lượng tập tin :attribute phải lớn hơn hoặc bằng :value kB.',
        'string' => 'Trường :attribute phải có từ :value ký tự trở lên.',
        'array' => 'Trường :attribute phải có :value phần tử trở lên.',
    ],
    'image' => 'Trường :attribute phải là định dạng hình ảnh.',
    'in' => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'in_array' => 'Trường :attribute không tồn tại trong :other.',
    'integer' => 'Trường :attribute phải là một số nguyên.',
    'ip' => 'Trường :attribute phải là một địa chỉ IP.',
    'ipv4' => 'Trường :attribute phải là một địa chỉ IPv4.',
    'ipv6' => 'Trường :attribute phải là một địa chỉ IPv6.',
    'json' => 'Trường :attribute phải là một chuỗi JSON.',
    'lt' => [
        'numeric' => 'Trường :attribute phải nhỏ hơn :value.',
        'file' => 'Dung lượng tập tin :attribute phải nhỏ hơn :value kB.',
        'string' => 'Trường :attribute phải ít hơn :value ký tự.',
        'array' => 'Trường :attribute phải có ít hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => 'Dung lượng tập tin :attribute phải nhỏ hơn hoặc bằng :value kB.',
        'string' => 'Trường :attribute phải có tối đa :value ký tự.',
        'array' => 'Trường :attribute không được có nhiều hơn :value phần tử.',
    ],
    'max' => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file' => 'Dung lượng tập tin :attribute không được lớn hơn :max kB.',
        'string' => 'Trường :attribute không được quá :max ký tự.',
        'array' => 'Trường :attribute không được có nhiều hơn :max phần tử.',
    ],
    'mimes' => 'Trường :attribute phải là một tập tin có định dạng: :values.',
    'mimetypes' => 'Trường :attribute phải là một tập tin có định dạng: :values.',
    'min' => [
        'numeric' => 'Trường :attribute phải tối thiểu là :min.',
        'file' => 'Dung lượng tập tin :attribute tối thiểu phải là :min kB.',
        'string' => 'Trường :attribute phải có tối thiểu :min ký tự.',
        'array' => 'Trường :attribute phải có tối thiểu :min phần tử.',
    ],
    'not_in' => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'not_regex' => 'Trường :attribute có định dạng không hợp lệ.',
    'numeric' => 'Trường :attribute phải là một số.',
    'password' => 'Mật khẩu không đúng.',
    'present' => 'Trường :attribute phải được cung cấp.',
    'regex' => 'Trường :attribute có định dạng không hợp lệ.',
    'required' => 'Trường :attribute không được bỏ trống.',
    'required_if' => 'Trường :attribute không được bỏ trống khi trường :other là :value.',
    'required_unless' => 'Trường :attribute không được bỏ trống trừ khi :other là :values.',
    'required_with' => 'Trường :attribute không được bỏ trống khi trường :values có giá trị.',
    'required_with_all' => 'Trường :attribute không được bỏ trống khi tất cả :values có giá trị.',
    'required_without' => 'Trường :attribute không được bỏ trống khi trường :values không có giá trị.',
    'required_without_all' => 'Trường :attribute không được bỏ trống khi tất cả :values không có giá trị.',
    'same' => 'Trường :attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => 'Trường :attribute phải bằng :size.',
        'file' => 'Dung lượng tập tin :attribute phải bằng :size kB.',
        'string' => 'Trường :attribute phải chứa :size ký tự.',
        'array' => 'Trường :attribute phải chứa :size phần tử.',
    ],
    'starts_with' => 'Trường :attribute phải bắt đầu bằng một trong những giá trị sau: :values',
    'string' => 'Trường :attribute phải là một chuỗi.',
    'timezone' => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique' => 'Trường :attribute đã có trong hệ thống.',
    'uploaded' => 'Trường :attribute tải lên thất bại.',
    'url' => 'Trường :attribute không đúng định dạng URL.',
    'uuid' => 'Trường :attribute phải là một UUID hợp lệ.',


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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
