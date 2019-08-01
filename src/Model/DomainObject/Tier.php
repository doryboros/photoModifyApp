<?php


namespace MyApp\Model\DomainObject;


/**
 * Class Tier
 * @package MyApp\Model\DomainObject
 */
class Tier
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string (S,M,L)
     */
    private $size;
    /**
     * @var float
     */
    private $price;
    /**
     * @var string
     */
    private $pathWithWatermark;
    /**
     * @var string
     */
    private $pathWithoutWatermark;
    /**
     * @var int
     */
    private $productId;

    /**
     * Tier constructor.
     * @param int $id
     * @param string $size
     * @param float $price
     * @param string $pathWithWatermark
     * @param string $pathWithoutWatermark
     * @param int $productId
     */
    public function __construct(string $size, float $price, string $pathWithWatermark, string $pathWithoutWatermark, int $productId, int $id=null)
    {
        $this->id = $id;
        $this->size = $size;
        $this->price = (float)$price;
        $this->pathWithWatermark = $pathWithWatermark;
        $this->pathWithoutWatermark = $pathWithoutWatermark;
        $this->productId = $productId;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     * @return Tier
     */
    public function setSize(string $size):self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Tier
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getPathWithWatermark(): string
    {
        return $this->pathWithWatermark;
    }

    /**
     * @param string $pathWithWatermark
     * @return Tier
     */
    public function setPathWithWatermark(string $pathWithWatermark): self
    {
        $this->pathWithWatermark = $pathWithWatermark;
        return $this;
    }

    /**
     * @return string
     */
    public function getPathWithoutWatermark(): string
    {
        return $this->pathWithoutWatermark;
    }

    /**
     * @param string $pathWithoutWatermark
     * @return Tier
     */
    public function setPathWithoutWatermark(string $pathWithoutWatermark): self
    {
        $this->pathWithoutWatermark = $pathWithoutWatermark;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return Tier
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     *
     */
    public function getOrders()
    {

    }
}