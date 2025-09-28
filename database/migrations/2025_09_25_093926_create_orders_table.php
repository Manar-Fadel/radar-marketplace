<?php

use App\Managers\Constants;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->index(); // رقم الطلب
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->index();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->text('description');
            $table->enum('status', [Constants::PENDING, Constants::ACCEPTED, Constants::REJECTED])->default(Constants::PENDING)->index();

            $table->index(['brand_id', 'created_at']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
