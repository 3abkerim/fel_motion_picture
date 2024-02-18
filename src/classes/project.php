<?php
class project
{
    private $name;
    private $date;
    private $content;
    private $type;
    private $order;
    private $deleted;

    public function __construct($projectName, $projectDate, $projectContent, $projectType, $projectOrder, $isDeleted)
    {
        $this->name = $projectName;
        $this->date = $projectDate;
        $this->content = $projectContent;
        $this->type = $projectType;
        $this->order = $projectOrder;
        $this->deleted = $isDeleted;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getOrder()
    {
        return $this->order;
    }
    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    public function setOrder($order)
    {
        $this->order = $order;
    }
    public function setDelete($delete)
    {
        $this->deleted = $delete;
    }
}
