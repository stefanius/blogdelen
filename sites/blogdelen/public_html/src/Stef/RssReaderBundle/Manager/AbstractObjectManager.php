<?php

namespace Stef\RssReaderBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Entity;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractObjectManager {

    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * @param ObjectManager $om
     */
    function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * @param $entity
     */
    public function persist($entity) {
        $this->om->persist($entity);
    }

    /**
     * @param $entity
     */
    public function remove($entity) {
        $this->om->remove($entity);
    }

    public function flush() {
        $this->om->flush();
    }

    /**
     * @param $entity
     */
    public function persistAndFlush($entity) {
        $this->persist($entity);
        $this->flush();
    }

    /**
     * @param $entity
     */
    public function removeAndFlush($entity) {
        $this->remove($entity);
        $this->flush();
    }

    /**
     * Create, store (persist in database) return an Enity
     *
     * @param ParameterBag $data
     *
     * @return Entity
     */
    public function createAndStore(ParameterBag $data) {
        $entity = $this->create($data);
        $this->persistAndFlush($entity);

        return $entity;
    }

    /**
     * Create and return an Enity
     *
     * @param ParameterBag $data
     *
     * @return Entity
     */
    abstract public function create (ParameterBag $data);
}