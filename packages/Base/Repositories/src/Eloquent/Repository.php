<?php

namespace Base\Repositories\Eloquent;

use Base\Repositories\Contracts\RepositoryInterface;
use Base\Repositories\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

/**
 * Repository
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var App
     */
    private $app;

    protected $model;

    /**
     * @throws RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract public function model();

    /**
     * Get all
     *
     * @param  array  $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        $results = $this->model->get($columns);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Eager loaded
     * Refer: https://laravel.com/docs/8.x/eloquent-relationships#eager-loading-multiple-relationships
     *
     * @return mixed
     */
    public function with(array $relations)
    {
        $this->model = $this->model->with($relations);

        return $this;
    }

    /**
     * Bulk Insertion data
     *
     * @return bool
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * Create data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update data
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id')
    {
        $results = $this->model->where($attribute, '=', $id)->update($data);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        $results = $this->model->updateOrCreate($attributes, $values);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Insert new records or update the existing ones.
     *
     * @param  array|string  $uniqueBy
     * @param  array|null  $update
     * @return int
     */
    public function upsert(array $values, $uniqueBy, $update = null)
    {
        $results = $this->model->upsert($values, $uniqueBy, $update);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Delete data
     *
     * @return mixed
     */
    public function delete($id)
    {
        $results = $this->model->destroy($id);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Truncate data
     *
     * @return mixed
     */
    public function truncate()
    {
        $this->model->truncate();
    }

    /**
     * Find by id
     *
     * @param  array  $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $results = $this->model->find($id, $columns);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Find by id
     *
     * @param  array  $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $results = $this->model->findOrFail($id, $columns);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Find all by field
     *
     * @param  array  $columns
     * @return mixed
     */
    public function findAllBy($field, $value, $columns = ['*'])
    {
        $results = $this->model->where($field, '=', $value)->get($columns);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Make Eloquent Model to instantiate
     *
     * @return Model
     *
     * @throws RepositoryException
     */
    private function makeModel()
    {
        $model = $this->app->make($this->model());

        if (! $model instanceof Model) {
            throw new RepositoryException(
                "Class {$model} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }

        return $this->model = $model;
    }

    /**
     * Reset model
     *
     * @return void
     *
     * @throws RepositoryException
     */
    public function resetModel()
    {
        $this->makeModel();
    }
}
