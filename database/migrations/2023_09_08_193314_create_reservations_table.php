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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id'); // foreign key untuk tabel vehicles
            $table->unsignedBigInteger('user_approval1_id'); // foreign key untuk user approval 1 (misalnya supervisor)
            $table->unsignedBigInteger('user_approval2_id'); // foreign key untuk user approval 2 (misalnya manager)
            $table->unsignedBigInteger('driver_id'); // foreign key untuk driver
            $table->date('start_date'); // tanggal mulai reservasi
            $table->date('end_date'); // tanggal akhir reservasi
            $table->enum('status', [
                'pending',
                'approved_by_supervisor',
                'approved',
                'rejected',
                'completed'
            ]); // status dari reservasi
            $table->text('message')->nullable(); // pesan atau catatan terkait reservasi
            $table->timestamps();

            // Definisi foreign keys
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('user_approval1_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_approval2_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
