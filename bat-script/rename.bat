ren C:\UPLOAD\EXAMPLE.csv EXAMPLE_%date:~4,2%-%date:~7,2%-%date:~10,4%.csv
IF %ERRORLEVEL% NEQ 0 (
  start http://example.com/notify.php?key=YOUR_SECRET_KEY_CHOICE^&type=bat-error^&body=The+batch+script+renameFile.bat+ren+command+has+experienced+error-code+%ERRORLEVEL%+while+executing
)