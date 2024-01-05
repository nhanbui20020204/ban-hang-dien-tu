<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->string('ho');
            $table->string('dem')->nullable();
            $table->string('ten');
            $table->date('ngay_sinh');
            $table->integer('status')->default(1)->comment('0 tạm tắt | 1 hoạt động | 2 khóa');
            $table->string('hash_reset')->nullable();
            $table->string('ly_do_block')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
