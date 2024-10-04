<?php

namespace App\DataTables;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class PostsDataTableEditor extends DataTablesEditor
{
    protected $model = Post::class;

    /**
     * Get create action validation rules.
     */
    public function createRules(): array
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Get edit action validation rules.
     */
    public function editRules(Model $model): array
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Get remove action validation rules.
     */
    public function removeRules(Model $model): array
    {
        return [];
    }

    /**
     * Event hook that is fired after `creating` and `updating` hooks, but before
     * the model is saved to the database.
     */
    public function saving(Model $model, array $data): array
    {
        // Before saving the model, hash the password.

        return $data;
    }

    /**
     * Event hook that is fired after `created` and `updated` events.
     */
    public function saved(Model $model, array $data): Model
    {
        // do something after saving the model

        return $model;
    }
}
