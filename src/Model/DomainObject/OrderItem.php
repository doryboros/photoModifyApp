<?php


namespace MyApp\Model\DomainObject;


class OrderItem
{

    /**
     * @var
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $tierId;
    /**
     * @var string
     */
    private $createdAt;

    /**
     * OrderItem constructor.
     * @param int $userId
     * @param int $tierId
     * @param string $createdAt
     */
    public function __construct(int $userId, int $tierId, int $id=null, string $createdAt=null)
    {
        $this->userId = $userId;
        $this->tierId = $tierId;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */



    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return OrderItem
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getTierId(): int
    {
        return $this->tierId;
    }

    /**
     * @param int $tierId
     * @return OrderItem
     */
    public function setTierId(int $tierId): self
    {
        $this->tierId = $tierId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return OrderItem
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }



}