echo off
set input=%1
set folder=%2
set filename=%3
set quality=%4
set content=%5
set bit_rate=1200
IF %quality% GEQ 720 (
	SET bit_rate=1200
) ELSE (
	IF %quality% GEQ 480 (
		SET bit_rate=1000
	) ELSE (
		IF %quality% GEQ 360 (
			SET bit_rate=800
		) ELSE (
			IF %quality% GEQ 240 (
				SET bit_rate=600
			) ELSE (
				SET bit_rate=400
			)
		)
		
	)
)
IF NOT EXIST %input% ( 
	echo File %input% khong ton tai
) ELSE (
	IF NOT EXIST %folder% (
		MD %folder%
	)
	echo %input% %folder% %filename% %quality% %content% %bit_rate%
	ffmpeg -y -i %input% -c:v libx264 -profile:v baseline -level 3.0 -c:a libvo_aacenc -b:v %bit_rate%k -bufsize %bit_rate%k -vf scale="trunc(oh*a/2)*2":%quality% %folder%/%filename%.mp4
	IF NOT EXIST data (
		MD data
	)
	IF NOT EXIST %folder%/%filename%.mp4 (
		echo ERROR > data/%RANDOM%.log
		echo ERROR
	)
	ELSE (
		echo %content% > data/%RANDOM%.log
		echo %content%
	)
)