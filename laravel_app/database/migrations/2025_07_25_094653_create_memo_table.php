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
        Schema::create('memos', function (Blueprint $table) {
            $table->id();

            // 修正：user_id を unsignedBigInteger にして外部キー制約を追加
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // ユーザーが削除されたらメモも削除

            $table->string('content', 255)->nullable(false);
            $table->integer('invalid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memos');
    }
};
