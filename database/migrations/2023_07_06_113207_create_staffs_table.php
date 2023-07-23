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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->string('gender')->nullable(); // Giới tính
            $table->date('birth_date')->nullable(); // Ngày sinh

            $table->string('identity_number')->nullable(); // Số chứng minh nhân dân

            $table->date('dentity_date')->nullable(); // Ngày cấp cmnd
            
            $table->string('dentity_address')->nullable(); // Nơi cấp cmnd Permanent Residence

            $table->string('place_residence')->nullable(); // Hộ khẩu thường trú

            $table->string('current_residence')->nullable(); // Chỗ ở hiện tại

            $table->string('career')->nullable(); // Nghề nghiệp

            $table->string('work_place')->nullable(); // Nơi công tác, học tập Date start work

            $table->date('date_start_work')->nullable(); // Ngày bắt đầu làm việc Previous work

            $table->string('previous_work')->nullable(); // Mô tả công việc trước đây

            $table->string('family_medical_history')->nullable(); // Tiểu sử bệnh tật của gia đình

            $table->integer('department_id')->default(0)->nullable(); // Thuộc phòng ban nào?

            $table->string('staff_code')->nullable(); // Mã nhân viên


            // Nơi ở thường trú
            $table->integer('province_id_residence')->default(0)->nullable();
            $table->integer('district_id_residence')->default(0)->nullable();
            $table->integer('ward_id_residence')->default(0)->nullable();

            // Nơi ở hiện tại
            $table->integer('province_id_current')->default(0)->nullable();
            $table->integer('district_id_current')->default(0)->nullable();
            $table->integer('ward_id_current')->default(0)->nullable();

            $table->string('email')->nullable();
            $table->string('position')->nullable(); // Chức vụ
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();

            $table->string('slug')->nullable()->unique();

           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
