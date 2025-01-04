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
        Schema::create('titles', function (Blueprint $table) {
            $table->integer('emp_no');
            $table->string('title', 50);
            $table->date('from_date');
            $table->date('to_date')->nullable();

            $table->primary(['emp_no', 'title', 'from_date']);
            $table->foreign('emp_no')->references('emp_no')->on('employees')->onDelete('cascade');

            $table->index(['emp_no', 'title', 'to_date'], 'emp_no_title_index');
            $table->index(['title', 'to_date'], 'title_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('titles', function (Blueprint $table) {
            $table->dropIndex('emp_no_title_index');
            $table->dropIndex('title_index');
        });

        Schema::dropIfExists('titles');
    }
};
