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
            $table->foreignId('lot_id')
                ->constrained('lots')
                ->onDelete('cascade');
            $table->foreignId('series_id')
                ->constrained('bond_series')
                ->onDelete('cascade');
            $table->string('bond_number');
            $table->string('price');
            $table->foreignId('source_id')
                ->nullable()
                ->constrained('sources');
            $table->char('status', 1)->default('a');
            $table->date('sold_date')->nullable();
            $table->date('purchase_date');
            $table->foreignId('client_id')
                ->nullable()
                ->constrained('clients');
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
