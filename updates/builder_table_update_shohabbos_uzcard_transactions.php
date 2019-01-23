<?php namespace Shohabbos\Uzcard\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShohabbosUzcardTransactions extends Migration
{
    public function up()
    {
        Schema::table('shohabbos_uzcard_transactions', function($table)
        {
            $table->string('expire', 5)->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('shohabbos_uzcard_transactions', function($table)
        {
            $table->integer('expire')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
