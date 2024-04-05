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
        Schema::create('print_template_group', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);

            $table->foreignId('parent')
            ->nullable(true)
            ->references('id')
            ->on('print_template_group')
            ->onDelete('cascade');

            $table->unique(['name','parent']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_template_group');
    }
};
