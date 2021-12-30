<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('purchaser_id');
            $table->bigInteger('poem_id');
            $table->decimal('price_paid', 8, 2)->default(0.00);

            $table->string('name');
            $table->string('stripe_id');
            $table->integer('quantity')->default(0);
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();

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
        Schema::dropIfExists('purchases');
    }
}
