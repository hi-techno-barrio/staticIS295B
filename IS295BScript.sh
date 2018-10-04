#!/bin/bash

RESOLUTION="960x720"
FRAMERATE="15"
IS295BPATH="/var/www/html/staticIS295B"
videoStream="/includes/main/mjpg-streamer/www"
termulator="/includes/main/termulator/app.js -p 777"
clientNode="/clientNode/is295UDP.js"
noVNC="/includes/main/vnc/utils/launch.sh --vnc localhost:5901"
executeVNC= "vncserver :1" 
PORT="8050"

#kill and refresh
killall mjpg_streamer
pkill node
vncserver -kill :1
 pkill Xtightvnc

#TERMULATOR
echo "robook1234" | sudo -S node $IS295BPATH$clientNode &
echo "robook1234" | sudo -S node $IS295BPATH$termulator & 
echo "robook1234" | su robook -c  'vncserver :1'  &
echo "robook1234" | sudo -S sh  $IS295BPATH$noVNC &
echo "robook1234" | sudo -S mjpg_streamer -i "input_uvc.so -d /dev/video0 -f $FRAME_RATE -r $RESOLUTION -y -n" -o "output_http.so -w $IS295BPATH$videoStream -p $PORT"


