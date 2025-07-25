@echo off
cd C:\Users\user\Documents\prodemia\Lesson13_Laravel\share_memo
docker-compose up -d
pause
cd C:\Users\user\Documents\prodemia\Lesson13_Laravel\share_memo\laravel_app
npm run dev
pause
