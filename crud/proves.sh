curl -X PUT -d "hola" http://localhost/ivan/crud/crud.php?id=1
curl -X GET http://localhost/ivan/crud/crud.php?id=1
curl -X PUT -d "hola2" http://localhost/ivan/crud/crud.php?id=2
curl -X PUT -d "hola3" http://localhost/ivan/crud/crud.php?id=3
curl -X PUT -d "hola4" http://localhost/ivan/crud/crud.php?id=4
curl -X POST -d "Adios2" http://localhost/ivan/crud/crud.php?id=2
curl -X POST -d "Adios1" http://localhost/ivan/crud/crud.php?id=1
curl -X GET http://localhost/ivan/crud/crud.php?id=4
curl -X DELETE http://localhost/ivan/crud/crud.php?id=1
curl -X DELETE http://localhost/ivan/crud/crud.php?id=10
curl -X PUT -d @proves.sh http://localhost/ivan/crud/crud.php?id=11
