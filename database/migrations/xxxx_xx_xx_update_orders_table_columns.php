<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableColumns extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Đảm bảo các cột số tiền có thể chứa giá trị lớn
            $table->decimal('sub_total', 15, 2)->change();
            $table->decimal('total_amount', 15, 2)->change();
            
            // Cập nhật kiểu dữ liệu của quantity nếu cần
            $table->integer('quantity')->change();
            
            // Thêm các cột mới nếu cần
            // $table->string('new_column')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Khôi phục lại kiểu dữ liệu cũ nếu cần
            $table->decimal('sub_total', 10, 2)->change();
            $table->decimal('total_amount', 10, 2)->change();
            $table->integer('quantity')->change();
        });
    }
} 