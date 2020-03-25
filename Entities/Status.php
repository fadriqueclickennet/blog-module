<?php

namespace Modules\Blog\Entities;

/**
 * Class Status
 * @package Modules\Blog\Entities
 */
class Status
{
    const DRAFT = 0;
    const PENDING = 1;
    const PUBLISHED = 2;
    const UNPUBLISHED = 3;
    const PROGRAMED = 4;

    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::DRAFT => trans('blog::status.draft'),
            self::PENDING => trans('blog::status.pending review'),
            self::PUBLISHED => trans('blog::status.published'),
            self::UNPUBLISHED => trans('blog::status.unpublished'),
            self::PROGRAMED => trans('blog::status.programed'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::DRAFT];
    }
}
