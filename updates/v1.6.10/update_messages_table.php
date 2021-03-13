<?php namespace Winter\Translate\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class UpdateMessagesTable extends Migration
{
    const TABLE_NAME = 'winter_translate_messages';

    public function up()
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            return;
        }

        if (!Schema::hasColumn(self::TABLE_NAME, 'found')) {
            Schema::table(self::TABLE_NAME, function($table)
            {
                $table->boolean('found')->default(1);
            });
        }
    }

    public function down()
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            return;
        }

        if (Schema::hasColumn(self::TABLE_NAME, 'found')) {
            Schema::table(self::TABLE_NAME, function($table)
            {
                $table->dropColumn(['found']);
            });
        }
    }
}
