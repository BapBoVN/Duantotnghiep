<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Đổi kiểu dữ liệu của cột amount thành bigInteger
            $table->bigInteger('amount')->change();
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Khôi phục về kiểu cũ nếu cần rollback
            $table->decimal('amount', 8, 2)->change();
        });
    }
}; 