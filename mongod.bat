@echo off
set BIN=%PROGRAMFILES%\MongoDB\Server\3.2\bin

"%BIN%\mongod.exe" --dbpath mongo_database
