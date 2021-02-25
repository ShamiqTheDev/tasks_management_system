<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', [ 'Logged', 'Under Development', 'Completed' ])->default('Logged');
            $table->dateTime('deadline');

            $table->timestamps();
        });

        Schema::create('users_tasks', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->integer('task_id');

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
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('users_tasks');
    }
}
