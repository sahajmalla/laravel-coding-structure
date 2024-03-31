<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new spatie query builder instance for the model's table for filtering and sorting
     *
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return QueryBuilder::for($this->model);
    }

    /**
     * Get all records from the repository.
     *
     * @param array $columns
     *
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    /**
     * Find a record by its primary key or throw an exception.
     *
     * @param int   $id
     * @param array $columns
     * @param bool  $withTrashed
     *
     * @return Model
     */
    public function find(int $id, array $columns = ['*'], bool $withTrashed = false): mixed
    {
        if ( $withTrashed ) {
            return $this->model->withTrashed()
                               ->findOrFail($id, $columns);
        }

        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Find a record by a specific column value or throw an exception.
     *
     * @param string $column
     * @param mixed  $value
     * @param array  $columns
     * @param bool   $withTrashed
     *
     * @return Model
     */
    public function findByColumn(string $column, $value, array $columns = ['*'], bool $withTrashed = false): mixed
    {
        if ( $withTrashed ) {
            return $this->model->withTrashed()
                               ->where($column, $value)
                               ->firstOrFail($columns);
        }

        return $this->model->where($column, $value)
                           ->firstOrFail($columns);
    }

    /**
     * Create a new record in the database.
     *
     * @param array $data
     *
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param int   $id
     * @param array $data
     * @param bool  $withTrashed
     *
     * @return mixed
     */
    public function update(int $id, array $data, bool $withTrashed = false): mixed
    {
        $model = $this->find($id, ['*'], $withTrashed);
        $model->update($data);

        return $model;
    }

    /**
     * @param int  $id
     * @param bool $force
     *
     * @return mixed
     */
    public function delete(int $id, bool $force = false): mixed
    {
        $model = $this->find($id);

        if ( $force ) {
            return $model->forceDelete();
        }

        return $model->delete();
    }

    /**
     * @param int  $id
     * @param bool $withTrashed
     *
     * @return mixed
     */
    public function restore(int $id, bool $withTrashed = false): mixed
    {
        $model = $this;
        if ( $withTrashed ) {
            $model = $this->withTrashed();
        }
        $model = $model->find($id);
        $model->restore();

        return $model;
    }

    /**
     * Count the total number of records matching the query.
     *
     * @param bool $withTrashed
     *
     * @return int
     */
    public function count(bool $withTrashed = false): int
    {
        if ( $withTrashed ) {
            return $this->model->withTrashed()
                               ->count();
        }

        return $this->model->count();
    }

    /**
     * Check if a record exists based on certain criteria.
     *
     * @param array $criteria
     * @param bool  $withTrashed
     *
     * @return bool
     */
    public function exists(array $criteria, bool $withTrashed = false): bool
    {
        $query = $this->model->where($criteria);

        if ( $withTrashed ) {
            $query->withTrashed();
        }

        return $query->exists();
    }

    /**
     * Update a record if it exists, or create a new one if it doesn't.
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []): mixed
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * Find multiple records by their IDs, or throw an exception if any are not found.
     *
     * @param array $ids
     * @param array $columns
     * @param bool  $withTrashed
     *
     * @return mixed
     */
    public function findManyOrFail(array $ids, array $columns = ['*'], bool $withTrashed = false): mixed
    {
        if ( $withTrashed ) {
            return $this->model->withTrashed()
                               ->findOrFail($ids, $columns);
        }

        return $this->model->findOrFail($ids, $columns);
    }

    /**
     * Paginate the query results.
     *
     * @param int   $perPage
     * @param array $columns
     * @param bool  $withTrashed
     *
     * @return mixed
     */
    public function paginate(int $perPage = 15, array $columns = ['*'], bool $withTrashed = false): mixed
    {
        $query = $this->model;

        if ( $withTrashed ) {
            $query = $query->withTrashed();
        }

        return $query->paginate($perPage, $columns);
    }
}
