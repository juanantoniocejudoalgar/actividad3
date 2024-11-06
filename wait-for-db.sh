#!/bin/bash
# Espera hasta que MySQL esté listo
until nc -z -v -w30 db 3306; do
  echo "Esperando a que la base de datos MySQL esté disponible..."
  sleep 5
done
echo "Base de datos MySQL disponible"
exec "$@"
