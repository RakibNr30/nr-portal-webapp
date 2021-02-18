<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\ArticleRepository;
use Modules\Ums\Repositories\UserPersonalInfoRepository;

class ArticleService
{
    /**
     * @var $articleRepository
     */
    protected $articleRepository;

    /**
     * Constructor
     *
     * @param ArticleRepository $articleRepository
     * @param UserPersonalInfoRepository $userPersonalInfoRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Get all data
     *
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 0)
    {
        return $this->articleRepository->paginate($limit);
    }

    /**
     * Get all data
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->articleRepository->create($data);
    }

    /**
     * Find data
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->articleRepository->find($id);
    }

    /**
     * Update data
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->articleRepository->update($data, $id);
    }

    /**
     * Delete data
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->articleRepository->delete($id);
    }

    /**
     * Find data
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findBy($attribute, $value)
    {
        $article = $this->articleRepository->findBy($attribute, $value);

        if ($article) {
            $previous = $this->articleRepository->model
                ->where([
                    ['id', '<', $article->id]
                ])->orderBy('id', 'desc')->first();

            $next = $this->articleRepository->model
                ->where([
                    ['id', '>', $article->id]
                ])->orderBy('id', 'asc')->first();

            if ($previous) {
                $article['previous_slug'] = $previous->slug;
            }

            if ($next) {
                $article['next_slug'] = $next->slug;
            }
        }

        return $article;
    }

    /**
     * Find data
     *
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function articleByAuthor($attribute, $value)
    {
        return $this->articleRepository->findAllBy($attribute, $value);
    }
}
