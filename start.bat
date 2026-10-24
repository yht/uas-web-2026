@echo off
setlocal
set "PHP_DIR=C:\Appz\php-8.2.34-Win32-vs16-x64"
set "APP_DIR=%~dp0"
if not exist "%PHP_DIR%\php.exe" (echo PHP tidak ditemukan.& pause& exit /b 1)
echo Menjalankan Laravel app di http://localhost:8001/
start "Laravel UAS" http://localhost:8001/
"%PHP_DIR%\php.exe" -c "%~dp0..\php.ini" -S localhost:8001 -t "%APP_DIR%public" "%APP_DIR%public\index.php"
endlocal
