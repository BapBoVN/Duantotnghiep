<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAmountColumnInCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change(); // Hoặc có thể dùng bigInteger
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->change(); // Khôi phục về kiểu cũ nếu cần
        });
    }
} 