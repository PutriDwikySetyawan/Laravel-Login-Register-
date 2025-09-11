<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
{
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->integer('stock')->default(0);
            $table->string('isbn')->nullable();
            $table->timestamps();
        });
}


    public function down(): void
{
        Schema::dropIfExists('books');
}
};