@echo off
set INNO_COMD=%1
set INNO_VAL=%2
if not exist INNO_COMD (
goto DEFINED
)

:NOTDEFINED
echo Arguments not defined
echo ------------------------------------------
echo     %0 [-args-]
echo         gen-propel
echo         clr-propel [project-name]
echo        *insert-sql
echo ------------------------------------------ 
echo     * not yet implemented 
echo ------------------------------------------  
goto :EOF

:DEFINED
if "%INNO_COMD%" == "gen-propel" (
goto GEN_PROPEL
)
if "%INNO_COMD%" == "clr-propel" (
goto CLR_PROPEL_CONF
)
if "%INNO_COMD%" == "insert-sql" (
goto NOT_IMPLEMENTED
)


:NOT_IMPLEMENTED
echo ------------------------------------------
echo Wrong argument provided!
echo ------------------------------------------
goto NOTDEFINED

:NO_PROJ_NAME
echo ------------------------------------------
echo Project name not specified!
echo ------------------------------------------
goto :EOF

:NO_PROJ_EXIST
cd ..
echo ------------------------------------------
echo Project does not exist!
echo ------------------------------------------
goto :EOF

:GEN_PROPEL
echo GEN_PROPEL
echo PROJECT DIR : %CD%
cd /conf/propel/
echo CURRENT DIR: %CD%
call propel-gen
cd ..
cd ..
echo Propel Classes Generated!!
goto :EOF

:CLR_PROPEL_CONF
if "%INNO_VAL%" == "" (
goto NO_PROJ_NAME
)
cd /lib/classes/
if not exist %INNO_VAL% (
goto NO_PROJ_EXIST
)
cd ..
cd ..
echo CLR_PROPEL_CONF
echo PROJECT DIR : %CD%
cd /conf/propel/
del /F/Q %INNO_VAL%-classmap.php
del /F/Q %INNO_VAL%-conf.php
echo DELETED FILES: 
echo %INNO_VAL%-classmap.php
echo %INNO_VAL%-conf.php
cd ..
cd /sql/
del /F/Q *.*
echo CURRENT DIR: %CD%
cd ..
cd ..
cd /lib/classes/
rmdir /S/Q %INNO_VAL%
echo DELETED FILES: 
echo %INNO_VAL% - [dir]
cd ..
cd ..
echo Propel Classes Cleared!!
goto :EOF

:INSERT_SQL
echo INSERT_SQL
echo PROJECT DIR : %CD%
cd /lib/propel-conf
echo CURRENT DIR: %CD%
call propel-gen insert-sql
cd ..
cd ..
echo Inserted SQL to Database Complete!!
goto :EOF
