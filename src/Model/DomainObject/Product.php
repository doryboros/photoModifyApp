<?php


namespace MyApp\Model\DomainObject;


class Product
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $tags;
    /**
     * @varstring
     */
    private $cameraSpecs;
    /**
     * @var string
     */
    private $captureDate;
    /**
     * @var string
     */
    private $thumbnailPath;
    /**
     * @var int
     */
    private $userId;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Product
     */
    public function setId($id):self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description):self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getTags(): string
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     * @return Product
     */
    public function setTags(string $tags):self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCameraSpecs()
    {
        return $this->cameraSpecs;
    }

    /**
     * @param mixed $cameraSpecs
     * @return Product
     */
    public function setCameraSpecs($cameraSpecs):self
    {
        $this->cameraSpecs = $cameraSpecs;
        return $this;
    }

    /**
     * @return string
     */
    public function getCaptureDate(): string
    {
        return $this->captureDate;
    }

    /**
     * @param string $captureDate
     * @return Product
     */
    public function setCaptureDate(string $captureDate):self
    {
        $this->captureDate = $captureDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailPath(): string
    {
        return $this->thumbnailPath;
    }

    /**
     * @param string $thumbnailPath
     * @return Product
     */
    public function setThumbnailPath(string $thumbnailPath):self
    {
        $this->thumbnailPath = $thumbnailPath;
        return $this;
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
     * @return Product
     */
    public function setUserId(int $userId):self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     *
     */
    public function getTiers()
    {
        
    }

}