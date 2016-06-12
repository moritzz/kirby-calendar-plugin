<?php header('Content-type: text/calendar; charset=utf-8'); ?>
<?php header("Content-Disposition: inline; filename={$page->slug()}.ics"); ?>
BEGIN:VCALENDAR 
VERSION:2.0 
PRODID:-//<?php echo $site->url(); ?>//Kirby Calendar Plugin//<?php echo str::upper($site->language()->code()); ?> 
CALSCALE:GREGORIAN 
METHOD:PUBLISH 
<?php foreach ($page->siblings($self = false) as $key => $sibling): ?>
<?php if ($sibling->calendar()->isNotEmpty()): ?>
<?php $calendar = calendar($sibling->calendar()->yaml()); ?>
<?php foreach ($calendar->getAllEvents() as $event): ?>
BEGIN:VEVENT 
DTSTART:<?php echo gmdate('Ymd\THis\Z', $event->getBeginTimestamp()); ?> 
DTEND:<?php echo gmdate('Ymd\THis\Z', $event->getEndTimestamp()); ?> 
UID:<?php echo $sibling->hash() . '-' . base_convert(sprintf('%u', crc32($event->getBeginTimestamp())), 10, 36); ?> 
DTSTAMP:<?php echo gmdate('Ymd\THis\Z', $event->getBeginTimestamp()); ?> 
LOCATION:<?php echo $event->getField('location') ?> 
DESCRIPTION:<?php echo $event->getField('description') ?> 
SUMMARY:<?php echo $event->getField('summary') ?> 
END:VEVENT
<?php endforeach; ?>
<?php endif ?>
<?php endforeach; ?>
END:VCALENDAR
<?php die(); ?>