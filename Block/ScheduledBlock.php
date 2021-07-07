<?php /** @noinspection PhpUnused */

namespace BeeBots\ScheduledCmsBlock\Block;

use DateTime;
use DateTimeZone;
use Exception;
use Magento\Cms\Block\Block;
use Magento\Framework\View\Element\AbstractBlock;

/**
 * Class ScheduledBlock
 *
 * @package BeeBots\ScheduledCmsBlock\Block
 */
class ScheduledBlock extends AbstractBlock
{
    /**
     * Function: _toHtml
     *
     * @return string
     */
    public function _toHtml(): string
    {
        //Block Identifier ex. "home-banner-2021-05-22"
        $blockId = $this->getData('id');

        //If there is no start date set the start date to now
        $startDateString = $this->getData('startDate') ?? 'now';
        //If there is no stop date set the stop date to distant future date
        $stopDateString = $this->getData('stopDate') ?? '2100-12-30';

        $timeZone = new DateTimeZone('America/Los_Angeles');
        try {
            $startDate = new DateTime($startDateString, $timeZone);
            $stopDate = $stopDateString ? new DateTime($stopDateString, $timeZone) : null;
            $currentDate = new DateTime('now', $timeZone);

            //Used to override current date from query string
            //Use site.com?block-time=2021-05-30 to preview block
            $dateParameter = $this->_request->getParam('block-time');
            if ($dateParameter) {
                $currentDate = new DateTime((string)$dateParameter, $timeZone);
            }

            if ($currentDate >= $startDate && $currentDate <= $stopDate) {
                /** @noinspection PhpPossiblePolymorphicInvocationInspection */
                return $this->getLayout()
                    ->createBlock(Block::class)
                    ->setData('block_id', $blockId)
                    ->toHtml();
            }
        } catch (Exception $exception) {
            $this->_logger->error('An error occurred with scheduled block ' . $blockId);
        }
        return "";
    }
}
