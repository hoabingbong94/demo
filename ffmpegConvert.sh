#!/bin/bash
#updated ffmpeg progress indicator
#by Rupert Plumridge
#for updates visit www.prupert.co.uk
#Creative Commons Attribution-Non-Commercial-Share Alike 2.0 UK: England & Wales Licence
# Based on the ffmpegprogress bar from: http://handybashscripts.blogspot.com/2011/01/ffmpeg-with-progress-bar-re-work.html
# which was based on my initital progress script - circle of life and all that ;)
# version 2.0
# 07.04.2011
# now uses apparently better progress detection, based on duration of overall video and progress along the conversion
####################################################################################
# USAGE #
# 1) Run the script with the name of the file to be converted after the name of the script (e.g. ./ffmpeg-progress.sh "My Awesome Video.mpg)
###################################################################################
# Please adjust the following variables as needed. 
# It is recommended you at least adjust the first variable, the name of the script
SCRIPT=ffmpegConvert.sh
UNIQUE=$(date +%N)
LOG=$HOME/ffmpegprog.log
LOG_OK=data/$UNIQUE.log
CONTENT=$5;
QUALITY=$4;	
BIT_RATE=1200;	
if [ "$QUALITY" -ge 720 ]; then
	BIT_RATE=1200;
	else 
		if [ "$QUALITY" -ge 480 ]; then 
			BIT_RATE=1000;
		else 
			if [ "$QUALITY" -ge 360 ]; then
					BIT_RATE=800;
				else 
					if [ "$QUALITY" -ge 240 ]; then
					BIT_RATE=600;
					else BIT_RATE=400;
					fi
				fi
		fi
	fi			
display () # Calculate/collect progress 
{
START=$(date +%s); FR_CNT=0; ETA=0; ELAPSED=1;PERCENTAGE=0
while [ -e /proc/$PID ]; do                         # Is FFmpeg running?
    sleep 2
    VSTATS=$(awk '{gsub(/frame=/, "")}/./{line=$1-1} END{print line}' \
    /tmp/vstats$UNIQUE)                                  # Parse vstats file.
    if [ $VSTATS -gt $FR_CNT ]; then                # Parsed sane or no?
        FR_CNT=$VSTATS
        PERCENTAGE=$(( 100 * FR_CNT / TOT_FR ))     # Progbar calc.
        ELAPSED=$(( $(date +%s) - START )); echo $ELAPSED > /tmp/elapsed.value
        ETA=$(date -d @$(awk 'BEGIN{print int(('$ELAPSED' / '$FR_CNT') *\
        ('$TOT_FR' - '$FR_CNT'))}') -u +%H:%M:%S)   # ETA calc.
    fi
    #echo -ne "\rFrame:$FR_CNT of $TOT_FR Time:$(date -d @$ELAPSED -u +%H:%M:%S) ETA:$ETA Percent:$PERCENTAGE"                # Text for stats output.	
done
if [ -f "$2/$3.mp4" ]; then 
		mkdir -p data		
		echo "$CONTENT"
		echo "$CONTENT" > $LOG_OK
	else
		echo "ERROR"
		echo "ERROR" > $LOG_OK
	fi
}
#trap "killall ffmpeg $SCRIPT; rm -f "$RM/vstats*"; exit" \
#INT TERM EXIT                                       # Kill & clean if stopped.
# Get duration and PAL/NTSC fps then calculate total frames.
    FPS=$(ffprobe "$1" 2>&1 | sed -n "s/.*, \(.*\) tbr.*/\1/p")
    DUR=$(ffprobe "$1" 2>&1 | sed -n "s/.* Duration: \([^,]*\), .*/\1/p")
    HRS=$(echo $DUR | cut -d":" -f1)
    MIN=$(echo $DUR | cut -d":" -f2)
    SEC=$(echo $DUR | cut -d":" -f3)
    TOT_FR=$(echo "($HRS*3600+$MIN*60+$SEC)*$FPS" | bc | cut -d"." -f1)
    if [ ! "$TOT_FR" -gt "0" ]; then echo error; exit; fi
    # Re-code with it.
	# $1 is input, $2 is folder output $3 is videoname without extention
	mkdir -p $2
	nice -n 15 ffmpeg -deinterlace -vstats_file /tmp/vstats$UNIQUE -y -i "$1"\
	-c:v libx264 -profile:v baseline -level 3.0 -c:a libfaac -b:v $BIT_RATE"k" -bufsize $BIT_RATE"k" -vf scale='trunc(oh*a/2)*2':"$QUALITY" "$2/$3.mp4" 2>/dev/null &  # CHANGE THIS FOR YOUR FFMPEG COMMAND.
	#-c:v libx264 -profile:v baseline -level 3.0 -c:a libfaac -vf scale='trunc(oh*a/2)*2':360 "$2/$3_360.mp4" \
	#-c:v libx264 -profile:v baseline -level 3.0 -c:a libfaac -vf scale='trunc(oh*a/2)*2':240 "$2/$3_240.mp4"\
	#-c:v libx264 -profile:v baseline -level 3.0 -c:a libfaac -vf scale='trunc(oh*a/2)*2':144 "$2/$3_144.mp4" 2>/dev/null &  # CHANGE THIS FOR YOUR FFMPEG COMMAND.
        PID=$! && 
	#echo "ffmpeg PID = $PID"
	#echo "Length: $DUR - Frames: $TOT_FR  "
	display                               # Show progress.
        rm -f /tmp/vstats$UNIQUE*                             # Clean up tmp files.

    # Statistics for logfile entry.
    ((BATCH+=$(cat /tmp/elapsed.value)))                # Batch time totaling.
    ELAPSED=$(cat /tmp/elapsed.value)                   # Per file time.
    echo "\nDuration: $DUR - Total frames: $TOT_FR" >> $LOG
    AV_RATE=$(( TOT_FR / ELAPSED ))
    echo -e "Re-coding time taken: $(date -d @$ELAPSED -u +%H:%M:%S)"\
    "at an average rate of $AV_RATE""fps.\n" >> $LOG

exit