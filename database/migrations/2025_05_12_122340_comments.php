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
        schema::create('comments' , function (Blueprint $table ){
            $table->id();
            $table->string('author');
            $table->string('author_email');
            $table->string('comment');
            $table->integer('organization_id');
            $table->integer('organization_score');
            $table->integer('likes_count');
            $table->integer('dislikes_count');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
