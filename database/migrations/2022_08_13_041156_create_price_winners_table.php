<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_winners', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('draw_No')->unsigned();
            $table->foreignId('price_sl_id')
                   ->constrained('price_lists');
            $table->string('bond_number');
            $table->date('draw_date');
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
        Schema::dropIfExists('price_winners');
    }
}
