<?php

use Brucelwayne\AI\Models\AiLogModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration {

    protected $connection = 'mongodb';

    public function up(): void
    {
        Schema::create(AiLogModel::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('big_model_name')->index()->comment('大模型的名称');
            $table->morphs('model');
            $table->longText('response');
            $table->timestamps();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    public function down(): void
    {
        Schema::drop(AiLogModel::TABLE);
    }
};
