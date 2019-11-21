<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('pic')->nullable();
            $table->Integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_address')->nullable();
            $table->string('from_phone')->nullable();
            $table->string('from_business_num')->nullable();
            $table->string('invoice_num')->nullable();
            $table->string('date')->nullable();
            $table->string('terms')->nullable();
            $table->string('to_name')->nullable();
            $table->string('to_email')->nullable();
            $table->string('to_address')->nullable();
            $table->string('to_phone')->nullable();
            $table->string('notes')->nullable();
            $table->float('discount')->nullable();
            $table->float('tax')->nullable();
            $table->float('total')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
