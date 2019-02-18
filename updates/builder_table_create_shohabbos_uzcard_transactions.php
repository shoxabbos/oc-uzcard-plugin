<?php namespace Shohabbos\Uzcard\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateShohabbosUzcardTransactions extends Migration
{
    public function up()
    {
        Schema::create('shohabbos_uzcard_transactions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('phone')->nullable();
            $table->string('card')->nullable();
            $table->integer('expire')->nullable();
            $table->integer('summa')->nullable();
            $table->string('uniques')->nullable();
            $table->string('trans_id')->nullable();
            $table->boolean('success')->nullable();
            $table->string('message')->nullable();
            $table->integer('owner_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shohabbos_uzcard_transactions');
    }
}
