<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement('create extension "uuid-ossp"');
        
        Schema::create('users', function (Blueprint $table) {
            $table->id('seq_id');
            $table->uuid('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        DB::statement('ALTER TABLE users ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
        
        Schema::create('scratch_cards', function (Blueprint $table) {
            $table->id('seq_id');
            $table->uuid('id');
            $table->decimal('scratch_card_amount',10,2);
            $table->date('expiry_date');
            $table->boolean('is_scratched')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        DB::statement('ALTER TABLE scratch_cards ALTER COLUMN id SET DEFAULT uuid_generate_v4();');

        Schema::create('transactions', function (Blueprint $table) {
            $table->id('seq_id');
            $table->uuid('id');
            $table->decimal('transaction_amount',10,2);
            $table->timestamp('transaction_date');
            $table->uuid('user_id');
            $table->uuid('scratch_card_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

           // $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('scratch_card_id')->references('id')->on('scratch_cards');
        });
        DB::statement('ALTER TABLE transactions ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scratch_cards');
    }
}
