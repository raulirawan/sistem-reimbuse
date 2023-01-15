<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbuseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbuse', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('keuangan_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('partner_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('sekretaris_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->date('tanggal_pengajuan')->nullable();
            $table->integer('total_reimbuse')->nullable();
            $table->string('bukti_nota')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->longText('catatan_keuangan')->nullable();
            $table->longText('catatan_partner')->nullable();
            $table->longText('catatan_sekretaris')->nullable();
            $table->boolean('status_keuangan')->nullable();
            $table->boolean('status_partner')->nullable();
            $table->boolean('status_sekretaris')->nullable();
            $table->boolean('tolak_keuangan')->nullable();
            $table->boolean('tolak_pegawai')->nullable();
            $table->string('status')->nullable();
            $table->string('tipe')->nullable();
            $table->string('payment_to')->nullable();
            $table->string('says')->nullable();
            $table->string('cheque')->nullable();
            $table->string('account_no')->nullable();
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
        Schema::dropIfExists('reimbuse');
    }
}
