#!/usr/bin/python
import pifacedigitalio as p
import cgi
import time
import requests


print "Access-Control-Allow-Origin: *"
print "Content-Type: text/html;charset=\"utf-8\"\r\n"
 
# DB vga - jack - hdmi - dvi - usb

jack = 8
usb = 2
hdmi = 4
vga = 16
dvi = 32

cables = [ 0, vga, jack, hdmi, dvi, usb ]

# expectedValue = math.pow(2,int(cable1Value) - 1) + math.pow(2,int(cable2Value) - 1) + math.pow(2,int(cable3Value) - 1)
arguments = cgi.FieldStorage()

first = arguments['first'].value
second = arguments['second'].value
third = arguments['third'].value

but = cables[int(first)] + cables[int(second)] + cables[int(third)]

# but = cables[int(1)] + cables[int(2)] + cables[int(3)]

piface = p.PiFaceDigital()

piface.leds[0].turn_off()
piface.leds[1].turn_off()
# time.sleep(1)
piface.leds[0].turn_on()
piface.leds[1].turn_on()


portValue = piface.input_port.value
while but != portValue:
    portValue = piface.input_port.value
    time.sleep(0.25)
     # print portValue

piface.leds[0].turn_off()
piface.leds[1].turn_off()


r = requests.get('http://192.168.123.242/webdispatcher/step1.php')
print "ok\r\n";
