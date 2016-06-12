<?php if(!defined('KIRBY')) exit ?>

title: Calendar Link
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
    help: Used to allow mixing in a Calendar Link into a Blog stream.
  calendar_headline:
    label: Calendar Settings
    type: headline
  calendar_color:
    label: Color
    type: color
    default: 1BADF8
  info:
    label: Info
    type: info
    text: >
      Use this page type to create an 
      iCal stream for all sibing events. 
      If you want to extend other pages types 
      to support calendar events, feel free to 
      copy the calendars field to your blueprints.