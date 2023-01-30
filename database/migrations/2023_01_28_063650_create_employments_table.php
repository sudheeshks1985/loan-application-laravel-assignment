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
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->string('borrower_id', 20)->nullable(false); // borrower table foreign key
            $table->string('employer_name', 100)->nullable(); // employer name
            $table->string('employer_address', 200)->nullable(); //employer address
            $table->float('annual_income', 10,2)->nullable(); // total income per year
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
        Schema::dropIfExists('employments');
    }
};
