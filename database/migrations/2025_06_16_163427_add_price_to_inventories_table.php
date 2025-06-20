<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceToInventoriesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('inventories', 'price')) {
            Schema::table('inventories', function (Blueprint $table) {
                $table->decimal('price', 10, 2)->default(0)->after('quantity');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('inventories', 'price')) {
            Schema::table('inventories', function (Blueprint $table) {
                $table->dropColumn('price');
            });
        }
    }
}
