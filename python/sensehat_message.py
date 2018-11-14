#!/usr/bin/python
from sense_hat import SenseHat
import cgi, sys

arguments = cgi.FieldStorage()

print "Access-Control-Allow-Origin: *"
print "Content-Type: text/html;charset=\"utf-8\"\r\n"

message = arguments['text'].value

# SenseHat job
sense = SenseHat()
sense.clear()
sys.stdout.flush()

sense.show_message(message, text_colour=[255, 0, 0])

print "ok"