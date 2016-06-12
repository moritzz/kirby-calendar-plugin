<?php if(!defined('KIRBY')) exit ?>

title: iCalendar Stream
pages: false
files: false
icon: calendar
fields:
  title:
    label: Title
    type:  text
  date:
    label Date
    type: date
  info:
    label: Info
    type: info
    text: >
      Use this page type to create an 
      iCal stream for all sibing events. 
      If you want to extend other pages types 
      to support calendar events, feel free to 
      copy the calendars field to your blueprints.