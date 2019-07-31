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
     * @var
     */
    private $tags;

    /**
     * Product constructor.
     * @param int $id
     * @param string $title
     * @param string $description
     * @param string $cameraSpecs
     * @param string $captureDate
     * @param string $thumbnailPath
     * @param int $userId
     * @param $tags
     */
    public function __construct(string $title, string $description, string $cameraSpecs, string $captureDate, string $thumbnailPath, $tags, int $userId = null, int $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->cameraSpecs = $cameraSpecs;
        $this->captureDate = $captureDate;
        $this->thumbnailPath = $thumbnailPath;
        $this->userId = $userId;
        $this->tags = $tags;
    }


    public static function createFromRow(array $row)
    {
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $cameraSpecs = $row['cameraSpecs'];
        $captureDate = $row['captureDate'];
        $thumbnailPath = $row['thumbnailPath'];
        $tags=$row['tags'];
        $userId = $row['userId'];

        $object = new self($title, $description, $cameraSpecs, $captureDate, $thumbnailPath, $tags, $userId, $id);

        return $object;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * @param array
     * @return Product
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

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