<?php
use App\Models\User;
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
        Schema::create('points', function (Blueprint $table) {
            $table->id(); // Primary key untuk points
            $table->foreignId('user_id') // Menyimpan ID dari user
                  ->constrained('users') // Mengacu ke tabel users
                  ->cascadeOnDelete(); // Jika user dihapus, point juga dihapus
            $table->integer('point')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
