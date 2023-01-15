<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbuseDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbuse_detail', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reimbuse_id')->constrained('reimbuse')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nomor_akun')->nullable();
            $table->string('nama')->nullable();
            $table->integer('harga')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reimbuse_detail');
    }
}
