<?php
namespace app\models;

use yii\db\ActiveQuery;

/**
 * Class DiscountQuery
 * @package app\models
 */
class DiscountQuery extends ActiveQuery
{
    /**
     * @param int $id
     * @return DiscountQuery
     */
    public function location(int $id): DiscountQuery
    {
        return $this->andWhere([
            'locationId' => $id
        ]);
    }

    /**
     * @return DiscountQuery
     */
    public function categorized(): DiscountQuery
    {
        return $this->active()->andWhere([
            'not', ['categoryId' => null]
        ]);
    }

    /**
     * @return DiscountQuery
     */
    public function noCategory(): DiscountQuery
    {
        return $this->active()->andWhere([
            'categoryId' => null,
        ]);
    }

    /**
     * Активные скидки
     * @return DiscountQuery
     */
    public function active(): DiscountQuery
    {
        return $this->andWhere([
            'status' => Discount::STATUS_ACTIVE
        ]);
    }

    /**
     * Архивированные скидки
     * @return DiscountQuery
     */
    public function archive(): DiscountQuery
    {
        return $this->andWhere([
            'status' => Discount::STATUS_ARCHIVE
        ]);
    }

    /**
     * @return DiscountQuery
     */
    public function actual() : DiscountQuery
    {
        return $this->andWhere([
            'and',
            ['<=', 'dateStart', time()],
            ['>=', 'dateEnd', time()],
        ]);
    }

    /**
     * {@inheritdoc}
     * @return Discount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Discount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
