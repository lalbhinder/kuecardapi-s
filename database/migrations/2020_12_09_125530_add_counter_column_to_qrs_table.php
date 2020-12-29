<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCounterColumnToQrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qrs', function (Blueprint $table) {
            //
            $table->text('scan_counter')->default('0');
            $table->text('appointment_counter')->default('0');
            $table->text('held_appointment_counter')->default('0');
            $table->text('conversation_counter')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qrs', function (Blueprint $table) {
            //
            $table->dropColumn('scan_counter');
            $table->dropColumn('appointment_counter');
            $table->dropColumn('held_appointment_counter');
            $table->dropColumn('conversation_counter');
        });
    }
}
