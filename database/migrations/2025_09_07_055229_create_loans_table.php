<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->date('loaned_at')->nullable();
            $table->date('returned_at')->nullable();
            $table->string('status')->default('pinjam'); // pinjam/kembali
            $table->timestamps();
    });
}


    public function down(): void
{
        Schema::dropIfExists('loans');
}
};