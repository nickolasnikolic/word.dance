<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patron_id');

            $table->bigInteger('payee_id');
            $table->decimal('pledge',8,2)->default(0.00);
            $table->string('cycle')->default('monthly');

            $table->string('name')->nullable();
            $table->string('stripe_id');
            $table->string('stripe_plan');
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
        Schema::dropIfExists('sponsorships');
    }
}
