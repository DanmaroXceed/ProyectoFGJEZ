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
        Schema::create('extravios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nameDoc');
            $table->text('docDesc');
            $table->date('date');
            $table->string('place');
            $table->text('escDesc');
            $table->boolean('verif');
            $table->string('constancia')->nullable();
        });

        Schema::table('extravios', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->after('verif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extravios');
    }
};
