<?php

class Article
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function createArticle(): string
    {
        return $this->title;
    }
}
