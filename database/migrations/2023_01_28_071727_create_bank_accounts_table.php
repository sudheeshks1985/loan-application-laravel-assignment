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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('borrower_id', 20)->nullable(false); // borrower table foreign key
            $table->string('bank_name', 100)->nullable(); // bank name
            $table->enum('account_type', ['checking', 'savings'])->default('checking'); //account type
            $table->float('balance_amount', 10,2)->nullable(); // balance amount
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
        Schema::dropIfExists('bank_accounts');
    }
};
