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
        Schema::create('our_cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('model_id');

            $table->integer('mileage')->nullable();
            $table->string('fuel_type', 50)->nullable()->default('Petrol');
            $table->string('transmission', 50)->nullable();
            $table->string('engine', 200)->nullable();
            $table->string('drive_type', 150)->nullable();
            $table->integer('person')->nullable()->default(5);
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->decimal('price', 12, 2)->index();

            $table->boolean('is_slider_banner')->nullable()->default(false);
            $table->string('slider_image_url')->nullable();

            $table->string('main_image_url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_cars');
    }
};
