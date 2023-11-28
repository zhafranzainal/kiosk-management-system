<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kiosks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('business_type_id')->nullable();
            $table->string('name');
            $table->string('location');
            $table->enum('suggested_action', ['No Action', 'Terminate', 'Suspend', 'Reassign'])->default('No Action')->nullable();
            $table->string('comment')->nullable();
            $table->enum('status', ['Inactive', 'Active', 'Warning', 'Repair'])->default('Inactive');

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
        Schema::dropIfExists('kiosks');
    }
};
