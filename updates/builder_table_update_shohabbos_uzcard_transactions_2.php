<?php namespace Shohabbos\Uzcard\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShohabbosUzcardTransactions2 extends Migration
{
    public function up()
    {
        Schema::table('shohabbos_uzcard_transactions', function($table)
        {
            $table->renameColumn('summa', 'amount');
        });
    }
    
    public function down()
    {
        Schema::table('shohabbos_uzcard_transactions', function($table)
        {
            $table->renameColumn('amount', 'summa');
        });
    }
}
