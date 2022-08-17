<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bonds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lot_number')
            ->constrained('lots')
            ->onDelete('cascade');
            $table->foreignId('series_no')
            ->constrained('bond_series')
            ->onDelete('cascade');
            $table->string('bond_number');
            $table->string('price');
            $table->string('status', 3)->default('p');
            $table->date('date');
            $table->softDeletes();
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
        Schema::dropIfExists('user_bonds');
    }
}
