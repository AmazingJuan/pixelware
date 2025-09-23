<?php

/*
 * BaseRepository.php
 * Abstract base repository providing common CRUD operations with eager loading.
 * Author: Juan Avendaño
*/

namespace App\Repositories;

// Laravel / Illuminate classes
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * Repository model.
     */
    protected string $model;

    /**
     * Relationships to eager load.
     */
    protected array $with = [];

    /**
     * Base query with eager loading.
     */
    protected function query()
    {
        return ($this->model)::with($this->with);
    }

    /**
     * Search by ID.
     */
    public function find($id): ?Model
    {
        return $this->query()->find($id);
    }

    /**
     * List all.
     */
    public function all(): Collection
    {
        return $this->query()->get();
    }

    /**
     * Create a new record.
     */
    public function create(array $data): Model
    {
        return ($this->model)::create($data)->fresh($this->with);
    }

    /**
     * Refresh a model instance with the latest data from the database.
     */
    public function refresh(Model $entity): ?Model
    {
        return $entity->fresh($this->with);
    }

    /**
     * Update a record by ID or Model.
     */
    public function update(array $data, ?Model $entity = null, $id = null): ?Model
    {
        // Search by ID if Model not provided.
        if (! $entity && $id !== null) {
            $entity = $this->find($id);
        }

        if ($entity) {
            $entity->update($data);

            return $this->refresh($entity);
        }

        return null;
    }

    /**
     * Delete a record by ID or Model.
     */
    public function delete(?Model $entity = null, $id = null): ?Model
    {
        if (! $entity && $id !== null) {
            $entity = $this->find($id);
        }

        if ($entity) {
            $entity->delete();
        }

        return $entity;
    }

    /**
     * Save an existing model.
     */
    public function save(Model $entity): Model
    {
        $entity->save();

        return $this->refresh($entity);
    }
}
