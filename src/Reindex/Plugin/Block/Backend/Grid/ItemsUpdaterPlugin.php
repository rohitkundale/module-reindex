<?php

namespace RohitKundale\Reindex\Plugin\Block\Backend\Grid;

/**
 * Class ItemsUpdaterPlugin
 *
 * @package RohitKundale_Reindex
 */
class ItemsUpdaterPlugin {

    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    protected $authorization;

    /**
     * @param \Magento\Framework\AuthorizationInterface $authorization
     */
    public function __construct(
        \Magento\Framework\AuthorizationInterface $authorization
    )
    {
        $this->authorization = $authorization;
    }

    /**
     * Remove massaction items in case they disallowed for user
     *
     * @param mixed $argument
     * @return mixed
     */
    public function aroundUpdate(
        \Magento\Indexer\Block\Backend\Grid\ItemsUpdater $itemsUpdater,
        \Closure $proceed,
        $argument
    )
    {
        if (false === $this->authorization->isAllowed('RohitKundale_Reindex::reindexdata')) {
            unset($argument['change_mode_reindex']);
        }
        return $argument;
    }

}