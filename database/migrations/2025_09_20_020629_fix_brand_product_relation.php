<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1️⃣ امسح العمود الغلط من جدول brands
        Schema::table('brands', function (Blueprint $table) {
            if (Schema::hasColumn('brands', 'product_id')) {
                $table->dropForeign(['product_id']); // لو معمول له foreign key
                $table->dropColumn('product_id');
            }
        });

        // 2️⃣ ضيف العمود الصح في جدول products
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'brand_id')) {
                $table->foreignId('brand_id')->nullable()->constrained('brands')->cascadeOnDelete();
            }
        });
    }

    public function down()
    {
        // لو رجعنا rollback
        Schema::table('brands', function (Blueprint $table) {
            if (!Schema::hasColumn('brands', 'product_id')) {
                $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            }
        });

        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'brand_id')) {
                $table->dropForeign(['brand_id']);
                $table->dropColumn('brand_id');
            }
        });
    }
};
