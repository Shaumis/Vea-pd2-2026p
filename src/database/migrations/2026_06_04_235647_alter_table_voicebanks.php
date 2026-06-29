<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('songs', function (Blueprint $table) {
        // 1. Create the column first (after 'id' or at the end of the table)
        $table->unsignedBigInteger('voicebank_id')->after('id'); 
        
        // 2. Then assign the foreign key constraint to it
        $table->foreign('voicebank_id')->references('id')->on('voicebanks');
    });
}

public function down(): void
{
    Schema::table('songs', function (Blueprint $table) {
        // Drop the foreign key constraint first
        $table->dropForeign(['voicebank_id']);
        // Then drop the actual column
        $table->dropColumn('voicebank_id');
    });
}
};