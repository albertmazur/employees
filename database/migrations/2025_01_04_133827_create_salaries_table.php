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
        Schema::create('salaries', function (Blueprint $table) {
            $table->integer('emp_no');
            $table->integer('salary');
            $table->date('from_date');
            $table->date('to_date');

            $table->primary(['emp_no', 'from_date']);
            $table->foreign('emp_no')->references('emp_no')->on('employees')->onDelete('cascade');

            $table->index(['emp_no', 'salary', 'to_date'], 'emp_no_salary_index');
            $table->index(['salary', 'to_date'], 'salary_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->dropIndex('emp_no_salary_index');
            $table->dropIndex('salary_index');
        });

        Schema::dropIfExists('salaries');
    }
};
