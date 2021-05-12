echo off
cls
echo ----------------------ARCHIVO CREADO POR--------------------------------

echo ********************** Jorge Edu ***************************************
echo https://youtu.be/Q-W7_ssbGyQ
echo  Gracias por ver el video
echo  Dale like y suscribete
echo !! No olvides ejecutar como administrador !! =D 

secedit /configure /cfg %windir%\inf\defltbase.inf /db defltbase.sdb /verbose

RD /S /Q "%WinDir%\System32\GroupPolicyUsers"

RD /S /Q "%WinDir%\System32\GroupPolicy"

gpupdate /force

REG ADD "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Policies\System" /V EnableLUA /T REG_DWORD /D 0 /F

REG DELETE "HKEY_LOCAL_MACHINE\SOFTWARE\Policies\Microsoft\Windows Defender Security Center" /F

REG DELETE  "HKEY_LOCAL_MACHINE\SOFTWARE\Policies\Microsoft\Windows Advanced Thread Protection" /F

REG DELETE "HKEY_LOCAL_MACHINE\SOFTWARE\Policies\Microsoft\Windows Defender" /F

shutdown.exe -r -f -t 0