<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id')->change();

            $table->foreign('vendor_id')
                ->references('id')
                ->on('vendors')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);

            $table->string('vendor_id')->change();
        });
    }
};
