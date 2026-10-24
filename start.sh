#!/usr/bin/env bash
set -euo pipefail

# Auto-detect PHP binary
PHP_BIN="${PHP_BIN:-$(command -v php)}"
if [[ ! -x "$PHP_BIN" ]]; then
  echo "PHP tidak ditemukan. Set PHP_BIN atau install php."
  exit 1
fi

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PHP_INI="${APP_DIR}/php.ini"
PUBLIC_DIR="${APP_DIR}/public"
PORT=8001
HOST="localhost"

if [[ ! -f "$PUBLIC_DIR/index.php" ]]; then
  echo "public/index.php tidak ditemukan di $PUBLIC_DIR"
  exit 1
fi

echo "Menjalankan Laravel app di http://${HOST}:${PORT}/"
echo "PHP: $PHP_BIN"
echo "Document root: $PUBLIC_DIR"

# Open browser (Linux)
if command -v xdg-open >/dev/null 2>&1; then
  xdg-open "http://${HOST}:${PORT}/" >/dev/null 2>&1 &
elif command -v firefox >/dev/null 2>&1; then
  firefox "http://${HOST}:${PORT}/" >/dev/null 2>&1 &
elif command -v chromium >/dev/null 2>&1; then
  chromium "http://${HOST}:${PORT}/" >/dev/null 2>&1 &
fi

# Start PHP built-in server
if [[ -f "$PHP_INI" ]]; then
  exec "$PHP_BIN" -c "$PHP_INI" -S "${HOST}:${PORT}" -t "$PUBLIC_DIR" "$PUBLIC_DIR/index.php"
else
  exec "$PHP_BIN" -S "${HOST}:${PORT}" -t "$PUBLIC_DIR" "$PUBLIC_DIR/index.php"
fi