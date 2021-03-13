<?php namespace Winter\Translate\Updates;

use Winter\Translate\Models\Locale;
use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddSortOrder extends Migration
{
    const TABLE_NAME = 'winter_translate_locales';

    public function up()
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            return;
        }

        if (!Schema::hasColumn(self::TABLE_NAME, 'found')) {
            Schema::table(self::TABLE_NAME, function($table)
            {
                $table->integer('sort_order')->default(0);
            });
        }

        $locales = Locale::all();
        foreach($locales as $locale) {
            $locale->sort_order = $locale->id;
            $locale->save();
        }
    }

    public function down()
    {
        if (!Schema::hasTable(self::TABLE_NAME)) {
            return;
        }

        if (Schema::hasColumn(self::TABLE_NAME, 'sort_order')) {
            Schema::table(self::TABLE_NAME, function($table)
            {
                $table->dropColumn(['sort_order']);
            });
        }
    }
}
