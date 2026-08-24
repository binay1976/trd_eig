@echo off

echo Deploying TRD EIG...

rsync -avz --progress ^
-e "ssh -i C:/Users/tc312/.ssh/etro_key" ^
"C:/Users/tc312/Desktop/trd_eig/" ^
bdts1022@10.3.184.218:/var/www/trd_eig/

echo.
echo Deployment completed.
pause