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
        Schema::create('infantils', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name', 100);
            $table->text('description');
            $table->decimal('cost', 10, 2); // Agregamos el campo 'cost' como decimal con un máximo de 10 dígitos, 2 de ellos decimales.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infantils');
    }
};

