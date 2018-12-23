<?php
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\components\parsers\FiveShop;
use app\models\interfaces\iDiscount;

/**
 * This is the model class for table "discount".
 *
 * @property int $id
 * @property int $categoryId
 * @property int $itemId
 * @property string $name
 * @property string $description
 * @property string $imageSmall
 * @property string $imageBig
 * @property int $paramId
 * @property string $specialPrice
 * @property string $regularPrice
 * @property string $discountPercent
 * @property int $dateStart
 * @property int $dateEnd
 * @property int $createdAt
 * @property int $updatedAt
 *
 * @property Category $category
 * @property string $preview
 */
class DiscountFiveShop extends \yii\db\ActiveRecord implements iDiscount
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discount_five_shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'categoryId',
                'itemId',
                'paramId',
                'dateStart',
                'dateEnd',
                'createdAt',
                'updatedAt',
            ], 'integer'],

            [[
                'description',
                'imageSmall',
                'imageBig',
            ], 'string'],

            [[
                'specialPrice',
                'regularPrice',
                'discountPercent',
            ], 'number'],

            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryId' => 'Категория',
            'itemId' => 'ID записи',
            'name' => 'Наименование',
            'description' => 'Описание',
            'preview' => 'Превью',
            'imageSmall' => 'Картинка уменьшенная',
            'imageBig' => 'Картинка большая',
            'paramId' => 'ID параметра',
            'specialPrice' => 'Спец. цена',
            'regularPrice' => 'Обычная цена',
            'discountPercent' => 'Процент скидки',
            'dateStart' => 'Дата начала',
            'dateEnd' => 'Дата окончания',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DiscountFiveShopQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DiscountFiveShopQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    /**
     * @return string
     */
    public function getPreview()
    {
        return FiveShop::SITE_URL . $this->imageSmall;
    }

    public function getRegularPrice()
    {
        return $this->regularPrice;
    }

    /**
     * @return string
     */
    public function getSpecialPrice()
    {
        return $this->specialPrice;
    }

    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }
}
