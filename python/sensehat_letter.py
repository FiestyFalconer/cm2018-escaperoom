#!/usr/bin/python
from sense_hat import SenseHat
import cgi, sys

arguments = cgi.FieldStorage()

print "Access-Control-Allow-Origin: *"
print "Content-Type: text/html;charset=\"utf-8\"\r\n"

letter = arguments['letter'].value

sense = SenseHat()
sense.clear()

sys.stdout.flush()

sense.show_letter(letter, text_colour=[0, 255,  0])

print "ok"