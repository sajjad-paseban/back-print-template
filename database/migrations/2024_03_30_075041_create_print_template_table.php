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
        Schema::create('print_template', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);

            $table->string('temp_size',255);

            $table->boolean('small_temp')
            ->nullable(true)
            ->default(false);

            $table->boolean('header_temp')
            ->nullable(true)
            ->default(false);

            $table->boolean('footer_temp')
            ->nullable(true)
            ->default(false);

            $table->string('model_variable',255)
            ->nullable(true);

            $table->text('temp_value');

            $table->foreignId('print_template_group')
            ->references('id')
            ->on('print_template_group')
            ->onDelete('cascade');

            $table->unique(['name', 'print_template_group']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_template');
    }
};
