<?php

namespace RohitKundale\Reindex\Controller\Adminhtml\Indexer;

use Magento\Backend\App\Action;

/**
 * Class MassReindex
 *
 * @package RohitKundale_Reindex
 */
class MassReindex extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'RohitKundale_Reindex::reindexdata';

    /**
     * @var \Magento\Framework\Indexer\IndexerRegistry
     */
    protected $indexerRegistry;

    public function __construct(
        \Magento\Framework\Indexer\IndexerRegistry $indexerRegistry,
        Action\Context $context
    )
    {
        $this->indexerRegistry = $indexerRegistry;
        parent::__construct($context);
    }


    public function execute()
    {
        $indexerIds = $this->getRequest()->getParam('indexer_ids');
        if (!is_array($indexerIds)) {
            $this->messageManager->addErrorMessage(__('Please select indexers.'));
        } else {

            foreach ($indexerIds as $indexerId) {
            	try {
                    $indexer = $this->indexerRegistry->get($indexerId);
                    $indexer->reindexAll();
                } catch (\Magento\Framework\Exception\LocalizedException $e) {
	                $this->messageManager->addExceptionMessage(
                        $e,
                        'indexer process unknown error:'
                    );
	            } catch (\Exception $e) {
                    $this->messageManager->addExceptionMessage(
                        $e,
                        __("We couldn't reindex data because of an error.")
                    );
	            }
            }
            $this->messageManager->addSuccessMessage(
                __('Total of %1 index(es) have reindexed data.', count($indexerIds))
            );
        }
        $this->_redirect('indexer/indexer/list');
    }
}
