<?php

return [
    'vnp_TmnCode' => env('VNPAY_TMN_CODE', '2QXUI4J4'),
    'vnp_HashSecret' => env('VNPAY_HASH_SECRET', 'NRXFKVLPMQPHGKFKVJBVUCXINHDPTOEH'),
    'vnp_Url' => env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'vnp_ReturnUrl' => env('VNPAY_RETURN_URL', 'http://localhost:8000/vnpay-return'),
]; 