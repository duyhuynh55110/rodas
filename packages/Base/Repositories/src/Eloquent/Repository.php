<?php

namespace Base\Repositories\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use Base\Repositories\Contracts\RepositoryInterface;
use Base\Repositories\Exceptions\RepositoryException;

/**
 * Repository
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @param App $app
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
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
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
     * @param array $relations
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
     * @param array $data
     * @return bool
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * Create data
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update data
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $results = $this->model->where($attribute, '=', $id)->update($data);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
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
     * @param  array  $values
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
     * @param $id
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
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $results = $this->model->find($id, $columns);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Find by id
     *
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = array('*'))
    {
        $results = $this->model->findOrFail($id, $columns);

        // reset model
        $this->resetModel();

        return $results;
    }

    /**
     * Find all by field
     *
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($field, $value, $columns = array('*'))
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
     * @throws RepositoryException
     */
    private function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException(
                "Class {$model} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }

        return $this->model = $model;
    }

    /**
     * Reset model
     *
     * @throws RepositoryException
     * @return void
     */
    public function resetModel()
    {
        $this->makeModel();
    }
}
