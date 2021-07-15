<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('process_id', 40)->unique();
            $table->string('type', 60);
            $table->string('input', 100);
            $table->string('output')->nullable();
            $table->string('status', 20);
            $table->timestamp("created_at")->nullable();
            $table->timestamp("started_at")->nullable();
            $table->timestamp("finished_at")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processes');
    }
}
