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
        Schema::create('personal_history_type', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id')->default(0)->nullable(); // Thuộc nhân viên nào
            $table->string('name_of_disease')->nullable(); // Tên bệnh
            $table->date('detect_year_1')->nullable(); // Phát hiện năm
            $table->string('occupational_disease_name')->nullable(); // Tên bệnh nghề nghiệp
            $table->date('detect_year_2')->nullable(); // Phát hiện năm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_history_type');
    }
};
