#!/usr/bin/env bash
# BEYOND 2026 — deploy-manifest.txt に列挙したファイルだけ本番へ scp
set -euo pipefail

SITE_DIR="$(cd "$(dirname "$0")/.." && pwd)"
MANIFEST="$SITE_DIR/deploy-manifest.txt"
PEM="${SSSLAB_PEM:-$HOME/Downloads/sslab.pem}"
HOST="${RSLAB_SSH_HOST:-ec2-user@54.178.41.148}"
REMOTE_BASE="${RSLAB_THEME_PATH:-/var/www/vhosts/i-046a907125b8755b9/wp-content/themes/beyond2026}"

if [[ ! -f "$PEM" ]]; then
  echo "❌ 秘密鍵が見つかりません: $PEM" >&2
  exit 1
fi

map_remote_path() {
  local rel="$1"
  case "$rel" in
    images/*)
      echo "$REMOTE_BASE/assets/$rel"
      ;;
    style.css|script.js)
      echo "$REMOTE_BASE/assets/$rel"
      ;;
    wp-theme/beyond2026/*)
      echo "$REMOTE_BASE/${rel#wp-theme/beyond2026/}"
      ;;
    *)
      echo "$REMOTE_BASE/$rel"
      ;;
  esac
}

files=()
while IFS= read -r line || [[ -n "$line" ]]; do
  line="${line%%#*}"
  line="${line// /}"
  [[ -z "$line" ]] && continue
  if [[ ! -f "$SITE_DIR/$line" ]]; then
    echo "❌ ファイルがありません: $SITE_DIR/$line" >&2
    exit 1
  fi
  files+=("$line")
done < "$MANIFEST"

if [[ ${#files[@]} -eq 0 ]]; then
  echo "✅ deploy-manifest.txt が空です。本番反映待ちはありません。"
  exit 0
fi

chmod 600 "$PEM"
echo "== 本番へアップロード（${#files[@]} ファイル） =="
echo "   ホスト: $HOST"

for rel in "${files[@]}"; do
  remote="$(map_remote_path "$rel")"
  echo "   → $rel"
  scp -i "$PEM" -o StrictHostKeyChecking=accept-new \
    "$SITE_DIR/$rel" \
    "$HOST:$remote"
done

echo ""
echo "✅ 完了。https://rslab.tokyo/beyond-2026/ を確認してください。"
echo "   問題なければ PENDING_DEPLOY.md を更新し、deploy-manifest.txt を空にしてください。"
