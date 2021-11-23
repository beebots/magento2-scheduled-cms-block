# Schedule Block
Schedule Block is a very simple Magento Module enabling you to schedule the pseudo "publish" date of a CMS block. Allowing it to render
within a start time and end time window.

Especially helpful for scheduling the publishing of banners, sales, etc.

Can be used in conjunction with the BeeBots Scheduled Cache Flush module to automatically flush your cache on specific dates/times. 
This is helpful if you have full page caching or block caching enabled.
You can schedule a CMS block rendering and Cache Flush for the same date and time.
    
See optional: https://github.com/beebots/magento2-scheduled-cache-flush

## Installation
    composer require "beebots/magento2-scheduled-cms-block"


## Usage
- Create a CMS block and note the block identifier example: my-block-123
- Open the CMS block or CMS page that you want to render your above block in, for example your home page.
- Invoke your new block using the Schedule Block type. Pass in the startDate and endDate parameters.



    {{block
        class='BeeBots\\ScheduledCmsBlock\\Block\\ScheduledBlock'
        startDate='2021-05-01T16:59'
        stopDate='2021-05-31T12:00'
        id='my-block-123'
    }}

- On your home page, my-block-123 will now render if the current date is within the window you provided.

## Preview
You may want to schedule the publishing of multiple blocks on a page and preview them. 
You can preview a block by using a block-time query parameter to override todays current date.

Example:
https://yoursite.com/?block-time=2021-05-15

This will load your homepage and render any schedule blocks where 2021-05-15 falls within the time window.