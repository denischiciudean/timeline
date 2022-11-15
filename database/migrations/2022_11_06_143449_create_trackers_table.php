<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id');
            $table->bigInteger('user_id');
            // the unique slug in registry of all trackers
            $table->string('slug')->unique();
            // the key of the tracker
            $table->string('tkey');
            // the type the data should be casted to (should be already known and disabled shown to user)
            $table->string('type');
            // value to be casted to above type
            $table->string('value');
            $table->string('tracker_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackers');
    }
};
