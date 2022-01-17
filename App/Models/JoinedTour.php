<?php

namespace App\Models;

use App\Core\Model;

class JoinedTour extends Model
{
    public function __construct(public int $id = 0,
                                public int $id_user = 0,
                                public int $id_tour = 0)
    {

    }

    static public function setDbColumns()
    {
        return ['id', 'id_user', 'id_tour'];
    }

    static public function setTableName()
    {
        return "joined_tours";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return int
     */
    public function getIdTour(): int
    {
        return $this->id_tour;
    }

    /**
     * @param int $id_tour
     */
    public function setIdTour(int $id_tour): void
    {
        $this->id_tour = $id_tour;
    }
}