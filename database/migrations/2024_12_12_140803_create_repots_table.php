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
        Schema::create('repots', function (Blueprint $table) {
            $table->id();
            $table->string('keluhan');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('desa');
            $table->json('voting')->default(json_encode([]));;
            $table->integer('viewers')->default(0);
            $table->string('image')->nullable();
            $table->boolean('statment')->default(false);
            $table->enum('type', ['KEJAHATAN','PEMBANGUNAN','SOSIAL']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('respon_status')->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repots');
    }
};
