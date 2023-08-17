<?php

namespace Base\Repositories\Contracts;

/**
 * RepositoryInterface
 */
interface RepositoryInterface
{
    /**
     * Get all
     *
     * @param  array  $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * Eager loaded
     * Refer: https://laravel.com/docs/8.x/eloquent-relationships#eager-loading-multiple-relationships
     *
     * @return void
     */
    public function with(array $relations);

    /**
     * Bulk Insertion data
     *
     * @return bool
     */
    public function insert(array $data);

    /**
     * Create data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update data
     *
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * Delete data
     *
     * @return mixed
     */
    public function delete($id);

    /**
     * Truncate data
     *
     * @return mixed
     */
    public function truncate();

    /**
     * Find by id
     *
     * @param  array  $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * Find all by field
     *
     * @param  array  $columns
     * @return mixed
     */
    public function findAllBy($field, $value, $columns = ['*']);
}
