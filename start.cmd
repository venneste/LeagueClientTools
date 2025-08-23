@echo off
TITLE LeagueClientTools
cd /d %~dp0

set PHP_BINARY=

where /q php.exe
if %ERRORLEVEL%==0 (
	set PHP_BINARY=php
)

if exist bin\php\php.exe (
	set PHPRC=""
	set PHP_BINARY=bin\php\php.exe
)

if "%PHP_BINARY%"=="" (
	echo Couldn't find a PHP binary in system PATH or "%~dp0bin\php"
	pause
	exit 1
)

if exist start.php (
	set START_FILE=start.php
) else (
	echo start.php not found
	pause
	exit 1
)

%PHP_BINARY% %START_FILE% %*
pause >nul