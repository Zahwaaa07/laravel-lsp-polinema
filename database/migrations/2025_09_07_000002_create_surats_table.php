<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('judul');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('file_path');
            $table->date('tanggal_upload');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
