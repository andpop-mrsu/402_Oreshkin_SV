@echo off

chcp 65001>nul

echo create table if not exists logger(User varchar(12), Date text default current_timestamp); | sqlite3 logger.db
echo insert into logger values('%USERNAME%', datetime('now', 'localtime')); | sqlite3 logger.db

echo Имя программы: %~nx0

echo|<nul set /p="Количество запусков: "
echo select count(*) from logger; | sqlite3 logger.db

echo|<nul set /p="Первый запуск: "
echo select Date from logger order by Date asc limit 1; | sqlite3 logger.db

echo select * from logger; | sqlite3 -table logger.db
pause