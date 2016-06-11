<?php foreach ($calendar->getAllEvents() as $event): ?>
BEGIN:VEVENT
DTSTART:<?php echo gmdate('Ymd\THis\Z', $event->getBeginTimestamp()); ?> 
DTEND:<?php echo gmdate('Ymd\THis\Z', $event->getEndTimestamp()); ?> 
SUMMARY:<?php echo $event->getField('summary') ?> 
DESCRIPTION:<?php echo $event->getField('description') ?> 
LOCATION:<?php echo $event->getField('location') ?> 
END:VEVENT
<?php endforeach; ?>
END:VCALENDAR