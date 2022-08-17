<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BondSeries;

class CreateBondSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bond_series', function (Blueprint $table) {
            $table->id();
            $table->text('series');
            $table->timestamps();
        });
         // Create a default one 
         $bondseries = new BondSeries();
         $bondseries->series = 'কক, কখ, কগ, কঘ';
         $bondseries->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bond_series');
    }
}
