<?php namespace Shohabbos\Uzcard\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShohabbosUzcardTransactions4 extends Migration
{
    public function up()
    {
        Schema::table('shohabbos_uzcard_transactions', function($table)
        {
            $table->dropColumn('id');
        });
    }
    
    public function down()
    {
        Schema::table('shohabbos_uzcard_transactions', function($table)
        {
            $table->integer('id')->unsigned();
        });
    }
}
