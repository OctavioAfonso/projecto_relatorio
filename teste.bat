ECHO OFF
ECHO Ola Mundo
CD C:\wkhtmltopdf\bin

DIR

wkhtmltopdf %2?id=%3"&"evaluee_id=%4  C:\xampp\htdocs\testePDF\relatorios\%1.pdf

PAUSE

REM http://localhost/testePDF/index.php  "&"evaluee_id=%5?

