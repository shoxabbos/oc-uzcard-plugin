<?php namespace Shohabbos\Uzcard\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShohabbosUzcardTransactions3 extends Migration
{
    public function up()
    {
        Schema::table('shohabbos_uzcard_transactions', function($table)
        {
            $table->integer('id')->unsigned()->change();
        });
    }
    
    public function down()
    {
        Schema::table('shohabbos_uzcard_transactions', function($table)
        {
            $table->integer('id')->unsigned(false)->change();
        });
    }
}
