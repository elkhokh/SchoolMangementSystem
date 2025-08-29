<?php

use App\Models\Students;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Students::class)->constrained()->nullOnDelete()->nullable();
            $table->foreignId('student_id')->constrained('students')->nullOnDelete()->nullable();
            $table->enum('payment_type',['cash','paymob','myfatoorah','paypal'])->default('cash');
            $table->enum('payment_status',['paid','pending','unpaid'])->default('pending');
            $table->string('payment_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->decimal('amount_all',8,2)->default(0);
            $table->decimal('remaining',8,2)->default(0);
            $table->decimal('current_paid',8,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
