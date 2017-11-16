<?php

namespace App\Repositories;

use App\Repositories\Contracts\MessageRepository;
use Illuminate\Database\Eloquent\Model;
use App\Message;

class EloquentMessageRepository implements MessageRepository
{
    /**
     * Constructor 
     */
    public function __construct()
    {
        $this->model = new Message;
    }

    /**
     * @inheritdoc
     */
    public function findOne($id)
    {
        return $this->findOneBy(['uid' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(array $criteria)
    {
        return $this->model->where($criteria)->first();
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria = [])
    {
        $limit = !empty($criteria['per_page']) ? (int) $criteria['per_page'] : env('PAGE_LIMIT');

        $queryBuilder = $this->model->where(function ($query) use ($criteria) {
            $this->buildSeaerchCriteriaForQueryBuilder($query, $criteria);
        });

        return $queryBuilder->paginate($limit);
    }


    /**
     * Apply condition on query builder based on search criteria
     *
     * @param Object $queryBuilder
     * @param array $criteria
     * @return mixed
     */
    protected function buildSeaerchCriteriaForQueryBuilder($queryBuilder, array $criteria = [])
    {
        foreach ($criteria as $key => $value) {
            // Skip pagination query params
            if (in_array($key, ['page', 'per_page'])) {
                continue;
            }

            $queryBuilder->where($key, $value);
        }

        return $queryBuilder;
    }

    /**
     * @inheritdoc
     */
    public function update(Model $message, array $data)
    {
        foreach ($data as $key => $value) {
                $message->$key = $value;
        }

        // Update the model
        $message->save();

        // Getting model after saving
        $message = $this->findOne($message->uid);

        return $message;
    }
}